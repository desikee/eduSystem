<?php
namespace App\Repositories\Promotion;

use App\Model\Admin\Role;
use App\Model\Admin\RoleUser;
use App\Model\Admin\User;
use App\Model\Admin\UserGame;
use App\Model\MagicInstall\Config;
use App\Repositories\Admin\UserRepository;
use App\Repositories\Contracts\AbstractRepository;
use Illuminate\Support\Facades\Auth;

class PromotionCompanyRepository extends UserRepository {
	
	protected $model;

    public function __construct(User $model = null)
	{
		$model || $model = new User();
		$this->model = $model;
	}

	public function getChannels(){
	    return Config::where(['game_id' => 11828])->groupBy('channel_id')->orderBy('id', 'desc')->get();
    }

	public function getList($query = [], $perpage, $page) {
		$role = Role::where(['name' => 'company'])->first();
		if (empty($role)) {
			$this->error_message = '没有找到该角色';
			return false;
		}
		$role_user_ids = RoleUser::where(['role_id' => $role->id])->get()->pluck('user_id');
		if (empty($query)) {
			$users = User::whereIn('id', $role_user_ids)->orderBy('id', 'desc')->get();
		} else {
			$users = User::whereIn('id', $role_user_ids)
				->where('username', 'like', '%' . $query['usernameSearch'] . '%')
                ->orderBy('id', 'desc')
				->get();
		}
		$users = $users->toArray();
		foreach ($users as $key => $value) {
		    $user_game = UserGame::where(['user_id' => $value['id']])->first();
		    $users[$key]['channel_id'] = $user_game ? $user_game->channel_id : '';
        }

		return $this->paginate($users, $perpage, $page);
	}

	public function add($params, $rules = []) {
		$role = Role::where(['name' => 'company'])->first();
		if (empty($role)) {
			$this->error_message = '没有找到该角色';
			return false;
		}
		$user = new User();
		$user->username = $params['username'];
		$user->email = $params['email'];
		$user->password = bcrypt('idreamsky');
		$user->company = $params['company'];
		$user->avatar = 'http://dl.uu.cc/plugin/user/rumi.jpg';
		if (!$user->save()) {
			$this->error_message = '创建用户失败';
			return false;
		}
		// 绑定角色关系
		RoleUser::create([
			'role_id' => $role->id,
			'user_id' => $user->id
		]);
		// 绑定游戏
		UserGame::create([
		    'user_id' => $user->id,
            'game_id' => 11828,
			'appid' => 203,
            'channel_id' => $params['channel_id']
        ]);
		return true;
	}

    public function edit($params, $rules = [])
    {
        if (!isset($params['id']))
        {
            $this->error_message = '没有查到该记录';
            return false;
        }
        $up = $this->find($params['id']);
        $column_list = $this->getColumnList();
        $rules = $rules ?? $column_list;
        foreach ($params as $key => $value)
        {
            if (array_key_exists($key, $rules) && in_array($key, $column_list))
            {
                $up->$key = $value;
            }
        }
        $up->save();
        $user_game = UserGame::where(['user_id' => $up->id, 'game_id' => $params['game_id']])->first();
        if (empty($user_game)) {
            UserGame::create([
                'user_id' => $up->id,
                'game_id' => $params['game_id'],
                'channel_id' => $params['channel_id']
            ]);
            return true;
        }
        $user_game->channel_id = $params['channel_id'];
        return $user_game->save();
    }

	public function reset($id) {
		$user = $this->model->find($id);
		if (empty($user)) {
			$this->error_message = '没有找到该用户';
			return false;
		}
		$user->password = bcrypt('idreamsky');
		return $user->save();
	}

	public function delete($id) {
		$user = $this->model->find($id);
		if (empty($user)) {
			$this->error_message = '没有找到该用户';
			return false;
		}
		if (!$user->forceDelete()) {
			$this->error_message = '删除用户失败';
			return false;
		}
		return RoleUser::where(['user_id' => $id])->delete();
	}
}
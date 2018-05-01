<?php
namespace App\Repositories\Promotion;

use App\Facades\Admin;
use App\Model\Admin\RoleUser;
use App\Model\Admin\User;
use App\Model\Admin\UserGame;
use App\Model\MagicInstall\Config;
use App\Repositories\Admin\UserRepository;
use Illuminate\Support\Facades\Auth;

class PromotionCompanyRepository extends UserRepository {
	
	protected $model;

    public function __construct(User $model = null)
	{
		$model || $model = new User();
		$this->model = $model;
	}

	/**
	 * 获取列表搜索选择
	 * @return array
	 */
	public function getSearchSelect()
	{
		$search_select = [];
		$direct_down_users = Admin::getDirectDownUsers();
		// 直接下级用户的所有可能公司
		$search_select['company'] = $direct_down_users->pluck('company')->unique();
		// 直接下级用户的可能渠道号
		$search_select['channel_id'] = UserGame::whereIn('user_id', $direct_down_users->pluck('id'))
			->groupBy('channel_id')->get(['channel_id']);
		$search_select['can_channel'] = Config::where(['game_id' => 11828])->groupBy('channel_id')->get(['channel_id']);
		return $search_select;
	}

	/**
	 * @param $game_id
	 */
	public function getChannel($game_id)
	{
		return Config::where(['game_id' => $game_id])->groupBy('channel_id')->pluck('channel_id')->unique();
	}

	public function getList($query = [], $perpage, $page)
	{
		// 获取当前用户的所有直接子用户列表
		$down_users = Admin::getDirectDownUsers()->toArray();
		// 按照查询条件过滤
		foreach ($down_users as $key => $down_user) {
			$user_game = UserGame::where(['user_id' => $down_user['id']])->first();
			$down_users[$key]['channel_id'] = $user_game ? $user_game->channel_id : '';
			if (isset($query['channel_id']) && $down_users[$key]['channel_id'] != $query['channel_id']) {
				unset($down_users[$key]);
			} elseif (isset($query['company']) && $down_user['company'] != $query['company']) {
				unset($down_users[$key]);
			} elseif (isset($query['usernameSearch'])
				&& stripos($down_user['username'], $query['usernameSearch']) === false) {
				unset($down_users[$key]);
			}
//			$down_users[$key]['a_ratio'] = $user_game['a_ratio'];
//			$down_users[$key]['s_ratio'] = $user_game['s_ratio'];
		}

		return $this->paginate($down_users, $perpage, $page);
	}

	public function add($params, $rules = [])
	{
		// 可创建下级角色id
		$down_role = Admin::getDirectDownRole();
		$user = new User();
		$user->username = $params['username'];
		$user->email = $params['email'];
		$user->password = bcrypt($params['username'] . '2018');
		$user->company = $params['company'];
		$user->parent_id = Admin::user()->id;
		$user->avatar = 'http://dl.uu.cc/plugin/user/rumi.jpg';
		if (!$user->save()) {
			$this->error_message = '创建用户失败';
			return false;
		}
		// 绑定角色关系
		RoleUser::create([
			'role_id' => $down_role->id,
			'user_id' => $user->id
		]);
		$current_user_game = UserGame::where(['user_id' => Admin::user()->id])->first();
		// 绑定游戏
		UserGame::create([
		    'user_id' => $user->id,
            'game_id' => 11828,
			'appid' => 203,
//			'a_ratio' => $params['a_ratio'] ?? 0,
//			's_ratio' => $params['s_ratio'] ?? 0,
            'channel_id' => $params['channel_id'] ?? $current_user_game->channel_id
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
	    $current_user_game = UserGame::where(['user_id' => Admin::user()->id])->first();
        if (empty($user_game)) {
            UserGame::create([
                'user_id' => $up->id,
                'game_id' => $params['game_id'],
	            'appid' => 203,
//	            'a_ratio' => $params['a_ratio'] ?? 0,
//	            's_ratio' => $params['s_ratio'] ?? 0,
	            'channel_id' => $params['channel_id'] ?? $current_user_game->channel_id
            ]);
            return true;
        }
        $user_game->channel_id = $params['channel_id'];
        return $user_game->save();
    }

	/**
	 * 重置密码
	 * @param $id
	 * @return bool
	 */
	public function reset($id)
	{
		$user = $this->model->find($id);
		if (empty($user)) {
			$this->error_message = '没有找到该用户';
			return false;
		}
		$user->password = bcrypt('idreamsky');
		return $user->save();
	}

	/**
	 * 删除用户
	 * @param int $id
	 * @return bool
	 */
	public function delete($id)
	{
		$user = $this->model->find($id);
		if (empty($user)) {
			$this->error_message = '没有找到该用户';
			return false;
		}
		if (!$user->forceDelete()) {
			$this->error_message = '删除用户失败';
			return false;
		}
		// 删除管理角色表
		RoleUser::where(['user_id' => $id])->delete();
		// 删除关联用户游戏表
		UserGame::where(['user_id' => $id])->delete();
		return true;
	}
}
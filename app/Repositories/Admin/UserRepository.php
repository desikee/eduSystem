<?php
namespace App\Repositories\Admin;

use App\Facades\Admin;
use App\Model\Admin\User;
use App\Repositories\Contracts\AbstractRepository;

class UserRepository extends AbstractRepository{

    protected $model;

    public function __construct(User $model = null)
    {
        $model || $model = new User();
        $this->model = $model;
    }

	public function getList($query = [], $perpage, $page){
		$role = $query['role'] ?? '';
		unset($query['role']);
		$users = $this->model->where($query)->orderBy('id', 'desc')->get();
		if ($role) {
			// 过滤掉非查询角色的用户
			$users = $users->filter(function($item) use($role){
				if ($item->hasRole($role))
				{
					return true;
				}
				return false;
			})->all();
		}
		return $this->paginate(
			$users,
			$perpage, $page
		);
	}

	/**
	 * 获取列表搜索选择
	 * @return array
	 */
	public function getSearchSelect() {
		$search_select = [];
		$search_select['role'] = Admin::getCanRoles()->toArray();
		$search_select['company'] = User::where([])->groupBy('company')->get(['company'])->toArray();
		$search_select['parent'] = User::whereIn('parent_id',
			User::where([])->groupBy('parent_id')->get(['parent_id']))->get(['id', 'username'])->toArray();
		return $search_select;
	}

	public  function getUserIDByUsername($username){
       $user =  $this->model->where(['username' => $username])->get();
        return $user->id;
    }
    public function hasUser($username){
	    return $this->model->where(['username'=> $username])->get() ? true : false;
    }
    public function getBackground($userID){
	    $user = $this->model->where(['id'=> $userID])->get();
	    $background = [];
	    $background['paper'] = $user->paper;
	    $background['research'] = $user->research;
	    $background['advance'] = $user->advance;
	    return $background;
    }
}
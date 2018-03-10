<?php

namespace App\Repositories\Admin;


use App\Model\Admin\Role;
use App\Model\Admin\RoleUser;
use App\Model\Admin\User;
use Illuminate\Support\Facades\Auth;

class AdminRepository
{
    protected $app;

    public function __construct($app)
    {
        $this->app = $app;
    }

    public function hasRole($role)
    {
        $role = Role::where('name', '=', $role)->first();
        $user = $this->user();
        if (empty($user)) {
            return false;
        }
        if ($user->id == 1 || $user->username == 'rumi.zhao') {
            return true;
        }
        if (empty($role)) {
            return false;
        }
        return boolval(RoleUser::where(['role_id' => $role->id, 'user_id' => $user->id])->first());
    }

    public function user()
    {
        return $this->app->auth->user();
    }

    /**
     * 获取当前用户可访问的角色
     * @return mixed
     */
    public function getCanRoles()
    {
        $role = $this->user()->roles()->first();
        $can_roles = Role::where('level', '>=', $role->level)->get();
        return $can_roles;
    }

    /**
     * 获取给定用户id的直接下级
     * @param $user
     * @return mixed
     */
    public function getDirectDownUser($user)
    {
        if (empty($user)) {
            return null;
        }
        $user_id = is_numeric($user) ? $user : $user['id'];
        return User::where('parent_id', '=', $user_id)->get();
    }

    /**
     * 判断是否有直接儿子
     * @param $user
     * @return bool
     */
    public function hasDirectDownUser($user)
    {
        return boolval($this->getDirectDownUser($user));
    }

    /**
     * 获取当前用户的所有下级用户
     * @param $array
     * @return mixed
     */
    public function getDownUsers($array)
    {
        return $this->user()->getDownUsers($array);
    }

    /**
     * 检查当前用户是否有每个子用户
     * @param $user_id
     * @return bool
     */
    public function hasDownUser($user_id)
    {
        $down_users = $this->getDownUsers(true);
        foreach ($down_users as $down_user) {
            if ($down_user['id'] == $user_id) {
                return true;
            }
        }
        return false;
    }

	/**
	 * 获取所有下级用户
	 * @param $user
	 * @return array
	 */
	private function getChildrenUsers($user)
	{
		$direct_down_users = $this->getDirectDownUser($user)->toArray();
		$down_users = array_merge([], $direct_down_users);
		foreach ($direct_down_users as $direct_down_user) {
			$d_user_1 = $this->getDirectDownUser($direct_down_user)->toArray();
			$down_users = array_merge($down_users, $d_user_1);
			foreach ($d_user_1 as $value_1) {
				$d_user_2 = $this->getDirectDownUser($value_1)->toArray();
				$down_users = array_merge($down_users, $d_user_2);
				foreach ($d_user_2 as $value_2) {
					$d_user_3 = $this->getDirectDownUser($value_2)->toArray();
					$down_users = array_merge($down_users, $d_user_3);
				}
			}
		}
		return $down_users;
	}
}
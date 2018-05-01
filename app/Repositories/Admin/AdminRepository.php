<?php

namespace App\Repositories\Admin;


use App\Model\Admin\Role;
use App\Model\Admin\RoleUser;
use App\Model\Admin\User;
use App\Model\Admin\UserGame;
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
	 * 获取当前用户的指定游戏id的可用渠道id
	 * @param $game_id
	 * @return string
	 */
	public function getChannelIdByGame($game_id)
	{
		$user_game = UserGame::where(['user_id' => $this->user()->id, 'game_id' => $game_id])->first();
		if ($user_game) {
			return $user_game->channel_id;
		} else {
			return '';
		}
	}

	/**
	 * 获取当前用户的角色
	 * @return mixed
	 */
	public function getRole()
	{
		return $this->user()->roles()->first();
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
	 * 获取当前用户的直接下级角色
	 * @return mixed
	 */
	public function getDirectDownRole()
	{
		$role = $this->user()->roles()->first();
		$can_roles = Role::where('level', '>', $role->level)->first();
		return $can_roles;
	}

    /**
     * 获取当前用户的直接下级
     * @return mixed
     */
    public function getDirectDownUsers()
    {
	    return $this->user()->getDirectDownUsers();
    }

    /**
     * 判断是否有直接儿子
     * @return bool
     */
    public function hasDirectDownUser()
    {
        return boolval($this->user()->getDirectDownUser());
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
}
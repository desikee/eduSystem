<?php

namespace App\Model\Admin;

use Illuminate\Notifications\Notifiable;
use Illuminate\Cache\TaggableStore;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'company', 'parent_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

	protected $appends = [
		'role_name', 'parent_user'
	];

	/**
	 * 添加获取角色名属性
	 */
	public function getRoleNameAttribute()
	{
		$roles = $this->roles()->get(['name']);
		$role_names = '';
		foreach ($roles as $role) {
			$role_names .= $role['name'];
		}
		return $role_names;
	}

	/**
	 * 添加获取上级用户角色名
	 * @return string
	 */
	public function getParentUserAttribute()
	{
		return $this->parent()->username ?? 'None';
	}

	/**
	 * 获取直接上级
	 * @return string
	 */
	public function parent()
	{
		if ($this->parent_id > 0) {
			return $this->find($this->parent_id);
		} else {
			return null;
		}
	}

	/**
	 * 获取直接下级用户列表
	 */
	public function getDirectDownUsers()
	{
		return $this->where('parent_id', '=', $this->id)->get();
	}

    /**
     * 获取当前用户的所有下级用户
     * @param bool $array 是否返回array格式
     * @return array
     */
	public function getDownUsers($array = false)
    {
        $queue = [$this];
        $down_users = [];
        // 使用广度优先算法遍历当前用户的所有下级用户
        while($queue) {
            // 当前节点出队列
            $current_user = array_shift($queue);
            if ($current_user) {
                // 保存所有遍历过的节点
                if ($array) {
                    array_push($down_users, $current_user->toArray());
                } else {
                    array_push($down_users, $current_user);
                }
                // 获取当前节点的所有子节点
                $current_down_users = $current_user->getDirectDownUsers();
                foreach ($current_down_users as $current_down_user) {
                    // 将所有子节点压入队列
                    array_push($queue, $current_down_user);
                }
            }
        }
        return $down_users;
    }

	/**
	 * 定义用户和角色的多对多关系
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function roles()
	{
		return $this->belongsToMany('App\Model\Admin\Role', 'role_user', 'user_id', 'role_id');
	}

	/**
	 * 缓存当前用户的角色信息
	 * @return \Illuminate\Database\Eloquent\Collection|mixed
	 */
	public function cachedRoles()
	{
		$userPrimaryKey = $this->primaryKey;
		$cacheKey = 'roles_for_user_'.$this->$userPrimaryKey;
		if(Cache::getStore() instanceof TaggableStore) {
			return Cache::tags('role_user')->remember($cacheKey, Config::get('cache.ttl'), function () {
				return $this->roles()->get();
			});
		}
		else return $this->roles()->get();
	}

	/**
	 * 重写系统方法，加入缓存机制
	 * @param array $options
	 * @return bool
	 */
	public function save(array $options = [])
	{   //both inserts and updates
		if(Cache::getStore() instanceof TaggableStore) {
			Cache::tags('role_user')->flush();
		}
		return parent::save($options);
	}

	public function delete(array $options = [])
	{   //soft or hard
		$result = parent::delete($options);
		if(Cache::getStore() instanceof TaggableStore) {
			Cache::tags('role_user')->flush();
		}
		return $result;
	}

	public function restore()
	{   //soft delete undo's
		$result = parent::restore();
		if(Cache::getStore() instanceof TaggableStore) {
			Cache::tags('role_user')->flush();
		}
		return $result;
	}

	/**
	 * 判断该用户是否拥有某个权限
	 * @param $name
	 * @param bool $requireAll
	 * @return bool
	 */
	public function hasRole($name, $requireAll = false)
	{
		if (is_array($name)) {
			foreach ($name as $roleName) {
				$hasRole = $this->hasRole($roleName);

				if ($hasRole && !$requireAll) {
					return true;
				} elseif (!$hasRole && $requireAll) {
					return false;
				}
			}

			// If we've made it this far and $requireAll is FALSE, then NONE of the roles were found
			// If we've made it this far and $requireAll is TRUE, then ALL of the roles were found.
			// Return the value of $requireAll;
			return $requireAll;
		} else {
			foreach ($this->cachedRoles() as $role) {
				if ($role->name == $name) {
					return true;
				}
			}
		}

		return false;
	}

	/**
	 * 多对多关系的 attach 方法别名
	 * @param $role
	 */
	public function attachRole($role)
	{
		if(is_object($role)) {
			$role = $role->getKey();
		}

		if(is_array($role)) {
			$role = $role['id'];
		}

		$this->roles()->attach($role);
	}

	/**
	 * 多对多关系的 detach 方法别名
	 * @param $role
	 */
	public function detachRole($role)
	{
		if (is_object($role)) {
			$role = $role->getKey();
		}

		if (is_array($role)) {
			$role = $role['id'];
		}

		$this->roles()->detach($role);
	}

	/**
	 * 将多个角色附加当前用户
	 * @param $roles
	 */
	public function attachRoles($roles)
	{
		foreach ($roles as $role) {
			$this->attachRole($role);
		}
	}

	/**
	 * 将多个角色从当前用户分离出去
	 * @param null $roles
	 */
	public function detachRoles($roles=null)
	{
		if (!$roles) $roles = $this->roles()->get();

		foreach ($roles as $role) {
			$this->detachRole($role);
		}
	}

	/**
	 * 根据角色过滤用户
	 * @param $query
	 * @param $role
	 * @return mixed
	 */
	public function scopeWithRole($query, $role)
	{
		return $query->whereHas('roles', function ($query) use ($role)
		{
			$query->where('name', $role);
		});
	}
}

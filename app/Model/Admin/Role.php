<?php
namespace App\Model\Admin;

use App\Model\Model;
use Illuminate\Cache\TaggableStore;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;

class Role extends Model{

	protected $table = 'role';

	/**
	 * 定义角色和用户的多对多关系
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function users()
	{
		return $this->belongsToMany('App\Model\Admin\User', 'role_user', 'role_id', 'user_id');
	}

	/**
	 * 定义角色和权限的多对多关系
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function perms()
	{
		return $this->belongsToMany('App\Model\Admin\Permission', 'role_permission', 'role_id', 'permission_id');
	}

	/**
	 * 缓存当前角色的所有权限
	 * @return \Illuminate\Database\Eloquent\Collection|mixed
	 */
	public function cachedPermissions()
	{
		$rolePrimaryKey = $this->primaryKey;
		$cacheKey = 'permissions_for_role_' . $this->$rolePrimaryKey;
		if (Cache::getStore() instanceof TaggableStore) {
			return Cache::tags(Config::get('permission_role_table'))->remember($cacheKey, Config::get('cache.ttl', 60), function () {
				return $this->perms()->get();
			});
		} else return $this->perms()->get();
	}

	/**
	 * 重写 Model save 方法，添加缓存写入
	 * @param array $options
	 * @return bool
	 */
	public function save(array $options = [])
	{
		if (!parent::save($options)) {
			return false;
		}
		if (Cache::getStore() instanceof TaggableStore) {
			Cache::tags(Config::get('permission_role_table'))->flush();
		}
		return true;
	}

	public function delete(array $options = [])
	{
		if (!parent::delete($options)) {
			return false;
		}
		if (Cache::getStore() instanceof TaggableStore) {
			Cache::tags(Config::get('permission_role_table'))->flush();
		}
		return true;
	}

	public function restore()
	{
		if (!parent::restore()) {
			return false;
		}
		if (Cache::getStore() instanceof TaggableStore) {
			Cache::tags(Config::get('permission_role_table'))->flush();
		}
		return true;
	}

	/**
	 * 判断当前角色是否有某个权限
	 * @param $name
	 * @param bool $requireAll
	 * @return bool
	 */
	public function hasPermission($name, $requireAll = false)
	{
		if (is_array($name)) {
			foreach ($name as $permissionName) {
				$hasPermission = $this->hasPermission($permissionName);

				if ($hasPermission && !$requireAll) {
					return true;
				} elseif (!$hasPermission && $requireAll) {
					return false;
				}
			}

			// If we've made it this far and $requireAll is FALSE, then NONE of the permissions were found
			// If we've made it this far and $requireAll is TRUE, then ALL of the permissions were found.
			// Return the value of $requireAll;
			return $requireAll;
		} else {
			foreach ($this->cachedPermissions() as $permission) {
				if ($permission->name == $name) {
					return true;
				}
			}
		}

		return false;
	}

	/**
	 * 保存输入的权限
	 * @param $inputPermissions
	 */
	public function savePermissions($inputPermissions)
	{
		if (!empty($inputPermissions)) {
			$this->perms()->sync($inputPermissions);
		} else {
			$this->perms()->detach();
		}

		if (Cache::getStore() instanceof TaggableStore) {
			Cache::tags(Config::get('entrust.permission_role_table'))->flush();
		}
	}

	/**
	 * 将权限附加到当前角色
	 * @param $permission
	 */
	public function attachPermission($permission)
	{
		if (is_object($permission)) {
			$permission = $permission->getKey();
		}

		if (is_array($permission)) {
			return $this->attachPermissions($permission);
		}

		$this->perms()->attach($permission);
	}

	/**
	 * 将权限重当前角色分离
	 * @param $permission
	 */
	public function detachPermission($permission)
	{
		if (is_object($permission)) {
			$permission = $permission->getKey();
		}

		if (is_array($permission)) {
			return $this->detachPermissions($permission);
		}

		$this->perms()->detach($permission);
	}

	/**
	 * 将多个权限附加到当前角色
	 * @param $permissions
	 */
	public function attachPermissions($permissions)
	{
		foreach ($permissions as $permission) {
			$this->attachPermission($permission);
		}
	}

	/**
	 * 将多个权限从当前角色分离
	 * @param null $permissions
	 */
	public function detachPermissions($permissions = null)
	{
		if (!$permissions) $permissions = $this->perms()->get();

		foreach ($permissions as $permission) {
			$this->detachPermission($permission);
		}
	}
}
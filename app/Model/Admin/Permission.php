<?php
namespace App\Model\Admin;

use App\Model\Model;

class Permission extends Model{

	protected $table = 'permission';

	/**
	 * 定义角色和权限的多对多关系
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function roles()
	{
		return $this->belongsToMany('App\Model\Admin\Role', 'role_permission', 'permission_id', 'role_id');
	}
}
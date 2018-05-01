<?php
namespace App\Model\Admin;

use App\Model\Model;

class LinkBackend extends Model{

	protected $table = 'link_backend';

	protected $appends = ['user_name'];

	public function getUserNameAttribute()
	{
		return User::find($this->user_id)->username;
	}
}
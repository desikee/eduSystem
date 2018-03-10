<?php
namespace App\Model\Admin;

use App\Model\Model;

class RoleUser extends Model{

	protected $table = 'role_user';

	protected $fillable = ['role_id', 'user_id'];
}
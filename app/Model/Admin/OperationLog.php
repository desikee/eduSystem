<?php
namespace App\Model\Admin;

use App\Model\Model;

class OperationLog extends Model{

	protected $table = 'operation_log';
	
	protected $fillable = ['user_id', 'path', 'method', 'ip', 'input'];
}
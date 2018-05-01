<?php
namespace App\Model\Train;

use App\Model\Model;

class TaskRecord extends Model{

//	protected $connection = 'train_company';

	protected $table = 'task_record';

	const CREATED_AT = 'created_at';

	const UPDATED_AT = 'updated_at';
}
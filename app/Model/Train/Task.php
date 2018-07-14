<?php
namespace App\Model\Train;

use App\Model\Model;

class Task extends Model{

//	protected $connection = 'train_company';
    const STATUS_DETAIL = [
        'create' => 0,
        'default' => 0,
        'complete' => 1
    ];

	protected $table = 'task';

	const CREATED_AT = 'created_at';

	const UPDATED_AT = 'updated_at';
}
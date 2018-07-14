<?php
/**
 * Created by PhpStorm.
 * User: desikee
 * Date: 2018/7/12
 * Time: 16:18
 */

namespace App\Model\Train;

use App\Model\Model;

class Course extends Model
{
    const STATUS_DETAIL = [
        'default' => 0,
        'create'=>0,
        'complete' => 1
    ];
    protected $table = 'course';

    const CREATED_AT = 'created_at';

    const UPDATED_AT = 'updated_at';
}

?>
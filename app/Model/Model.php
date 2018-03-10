<?php
namespace App\Model;

/**
 * 设置当前项目模型默认行为
 * Class Model
 */
class Model extends \Illuminate\Database\Eloquent\Model
{

    // Eloquent 期望数据表中存在 created_at 和 updated_at 字段
    public $timestamps = false;

    // 定义时间格式为Unix时间戳格
//    public $dateFormat = 'U';

}
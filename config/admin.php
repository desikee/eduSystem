<?php

/**
 * 使用 config('admin.name') 访问
 */
return [

	/**
	 * 配置文件名
	 */
    'name' => 'uu_admin',

	/**
	 * 版本
	 */
	'version'   => '1.0',

    /**
     * 设置控制后台的如日志记录行为
     */
    'operation_log'   => [

        'enable' => true,

        /**
         * 不用记录的路由列表
         */
        'except' => [
            'admin/system/log*',
	        '*getList*'
        ]
    ],

];

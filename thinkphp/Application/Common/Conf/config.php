<?php
return array(
    'MODULE_ALLOW_LIST' => array('Home'),
    //'MULTI_MODULE' => false,
    'DEFAULT_MODULE' => 'Home',

	//'配置项'=>'配置值'
    'SWOOLE_SERVER_BIND'=>array(
        'ip'=>'0.0.0.0', //本机
        'port'=>9502,
    ),

    'SWOOLE_SERVER_OPTION'=>array(//swoole服务启动配置
        'worker_num' => 8,//进程数
        'daemonize' =>false,
        'max_request' => 10000,
        'dispatch_mode' => 2,
        'debug_mode'=> 1,
        'task_worker_num'=>8,//任务数
    ),
);
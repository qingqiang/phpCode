<?php

$redis = new Redis();
$redis->connect('192.168.0.31', 6379);
$redis->auth('admin2017@yanfa');

$count = $redis->lpop('goods_store');
if(!$count){
	file_put_contents(__DIR__ . '/error.log', microtime() . " error:no store redis \r\n", FILE_APPEND);
	return;
}


file_put_contents(__DIR__ . '/success.log', microtime() . " $count \r\n", FILE_APPEND);
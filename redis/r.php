<?php

$redis = new Redis();
$redis->connect('192.168.0.31', 6379);
$redis->auth('admin2017@yanfa');

$store = 1000;
$res = $redis->llen('goods_store');
$count = $store-$res;

for($i=0; $i<$count; $i++){
	$redis->rpush('goods_store', 1);
}

echo $redis->llen('goods_store');

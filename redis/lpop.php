<?php

$redis = new Redis();
$redis->connect('192.168.0.5', 6379);

$value = $redis->lPop('mylist');

if($value){
    echo "出队的值".$value;
}else{
    echo "出队完成";
}
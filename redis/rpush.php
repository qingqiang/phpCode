<?php

$redis = new Redis();
$redis->connect('192.168.0.5', 6379);

$arr = array('h','e','l','l','o','w','o','r','l','d');
foreach ($arr as $item) {
    $redis->rPush('mylist', $item);
}
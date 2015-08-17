<?php
$array = array('andy', 'andylau', 'andyho');
shuffle($array);
print_r($array);


$index = array_rand($array, 1);
echo $array[$index];
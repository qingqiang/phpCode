<?php
error_reporting(0);
isset($_COOKIE['user']) ? $user = $_COOKIE['user'] :$user = null;
if ($user != null) {
    require_once ("../config.php");
    $check = "select * from maixiao where user='$user'";
    $check = mysql_query($check, $config);
    $num = mysql_num_rows($check);
    if ($num != "1") {header("location:home.php");exit;}
} else {header("location:index.php");exit;}
?>
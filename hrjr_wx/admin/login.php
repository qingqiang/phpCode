<?php
header("Content-type: text/html; charset=utf-8");
if($_POST["login"] == "1"){
    $username = $_POST['username'];
    $username = md5($username);
    $userpass = $_POST['userpass'];
    $userpass = md5($userpass);
require_once("../config.php");
$loginsql = "select * from maixiao where user='$username' and pass='$userpass'";
$loginery = mysql_query($loginsql,$config);
$login = mysql_num_rows($loginery);
if($login =="1"){
   setcookie("user",$username,time() +3600*24,'/');
   header("location:home.php");
   //echo "<script>location.href='index.php';</script>";
}else{
    echo "<script> alert('用户名或密码错误');parent.location.href='index.php'; </script>"; 
}
    
}

?>
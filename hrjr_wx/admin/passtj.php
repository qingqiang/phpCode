<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<?php require_once("check.php");?>
<?php
require_once("../config.php");
if($_POST["submit"] == 确认修改);
{
    $pass=$_POST["pass"];
    $pass= md5($pass);
    $newpass=$_POST["newpass"];
    $zhengze= preg_match("/^.{4,15}$/",$newpass);
    if($zhengze!="1"){
        echo "<script>window.onload=function(){alert('密码必须大于5位，小于15位数');location.href='home.php?h=pass';}</script>";  
        exit;
    }
    $newpass= md5($newpass);
    $nnewpass=$_POST["nnewpass"];
    $nnewpass= md5($nnewpass);
    
$csql = "select * from maixiao where pass='$pass'";
$csql = mysql_query($csql,$config);
$num = mysql_num_rows($csql);
if($num != "1"){
    echo "<script>window.onload=function(){alert('原密码不正确');location.href='home.php?h=pass';}</script>";
   exit;
}
if($newpass!=$nnewpass){
     echo "<script>window.onload=function(){alert('两次新密码不一致');location.href='home.php?h=pass';}</script>";
     exit;
      
}else{
    $xpass = "update maixiao set `pass`='$newpass'";
    $xpass = mysql_query($xpass,$config);
    if($xpass){
        echo "<script>window.onload=function(){alert('修改成功');location.href='home.php';}</script>";
        
    }
  
}


}
?>
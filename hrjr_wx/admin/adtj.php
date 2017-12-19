<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<?php require_once("check.php");?>
<?php

if($_POST["submit"] == 设置);
{
    $ad=$_POST["ad"];
    $zimu=$_POST['zimu'];
    

}

$sql = "update ad set `sanerwu`='$ad',`zimu`='$zimu' where id='1' limit 1";
$sql = mysql_query($sql,$config);
if($sql){
   echo "<script>window.onload=function(){alert('更新成功');location.href='home.php?h=ad';}</script>";
}else{
    
    echo "更新失败";
}
?>
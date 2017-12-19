<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<?php require_once("check.php");?>
<?php
if($_POST["submit"] == 设置);
{
    $url=$_POST["url"];
    $title=$_POST["title"];
    $keywords=$_POST["keywords"];
    $description=$_POST["description"];
    $logo=$_POST["logo"];
    $icp=$_POST["icp"];
    $banquan=$_POST['banquan'];
    $lianxi = $_POST['lianxi'];
    $cnzz=addslashes($_POST["cnzz"]);

    

}

$sql = "update win set `url`='$url' ,`banquan`='$banquan', `lianxi`='$lianxi',`title`='$title' , `keywords`='$keywords' , `description`='$description' , `logo`='$logo' , `icp`='$icp' , `cnzz`='$cnzz' where id='1' limit 1";
$sql = mysql_query($sql,$config);
if($sql){
   echo "<script>window.onload=function(){alert('更新成功');location.href='home.php?h=win';}</script>";
}else{
    
    echo "更新失败";
}
?>
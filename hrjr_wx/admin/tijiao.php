<?php require_once("check.php");?>
<?php
header("Content-type: text/html; charset=utf-8");
if($_POST["submit"] == "发布");
{
    $title=$_POST["title"];
    $banben=$_POST["banben"];
    $daxiao=$_POST["daxiao"];
    $zhichi=$_POST["zhichi"];
    $imgurl=$_POST["imgurl"];
    $soft=$_POST["soft"];
    $content=$_POST["content"];
    $date=date("Y-m-d H:i:s");
}
$sql = "insert into soft (title,date,images,pv,url,content,banben,daxiao,zhichi) values 
('$title','$date','$imgurl','0','$soft','$content','$banben','$daxiao','$zhichi')";
$sql = mysql_query($sql,$config);
if($sql){
   echo "<script>window.onload=function(){alert('添加成功');location.href='home.php?h=soft';}</script>";
}else{
    echo "添加失败";
}
?>
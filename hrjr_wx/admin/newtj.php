<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<?php require_once("check.php");?>
<?php
if($_POST["submit"] == 发布);
{
    $title=$_POST["title"];
    $content=$_POST["content"];
    $jianjie=strip_tags($content);
    $jianjie= mb_substr($jianjie,0,15,'utf8');
    $date=date("Y-m-d H:i:s");
    
}

$sql = "insert into new (title,content,jianjie,date,pv) values 
('$title','$content','$jianjie','$date','0')";
$sql = mysql_query($sql,$config);
if($sql){
   echo "<script>window.onload=function(){alert('添加成功');location.href='home.php?h=help';}</script>";
}else{
    
    echo "添加失败";
}
?>
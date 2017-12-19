<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<?php
require_once("../config.php");
isset($_GET['id'])?$id=$_GET['id']:$id=null;


$idd = preg_match("/^([0-9]){1,}$/",$id);

if($idd == "1"){
    $pvsql = "update soft set `pv`= pv+'1' where id='$id' ";
    $pvsql = mysql_query($pvsql,$config);
      
    $sql = "select * from soft where `id`='$id'";
    $sql = mysql_query($sql,$config);
    $sql = mysql_fetch_array($sql);
    $url = $sql['url'];
    header("location:$url");
    
   
}else{
    echo "<script>window.onload=function(){alert('地址出错');location.href='../index.php';}</script>";;
    
}

?>
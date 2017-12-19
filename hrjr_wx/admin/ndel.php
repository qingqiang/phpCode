<?php
require_once("check.php");
require_once("../config.php");
isset($_GET['del'])?$id=$_GET['del']:$id=null;
if($id!="null"){
$delsql = "delete from new where id = '$id'";
$delsql = mysql_query($delsql,$config);
if($delsql == "1"){
   echo  "<script>alert('É¾³ý³É¹¦');location.href='home.php?h=new';</script>";

}else{
echo "É¾³ýÊ§°Ü£¬Çë¼ì²éÊý¾Ý¿â£¡";  
}
}else{
    header("location:index.php");
}

?>
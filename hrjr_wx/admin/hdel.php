<?php
require_once("check.php");
require_once("../config.php");
isset($_GET['del'])?$id=$_GET['del']:$id=null;
if($id!="null"){
$delsql = "delete from wx_prize where id = '$id'";
$delsql = mysql_query($delsql,$config);
if($delsql == "1"){
   echo  "<script>alert('ɾ���ɹ�');location.href='home.php?h=help';</script>";

}else{
echo "ɾ��ʧ�ܣ��������ݿ⣡";  
}
}else{
    header("location:index.php");
}

?>
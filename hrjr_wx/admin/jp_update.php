<?php
require_once("check.php");
require_once("../config.php");
isset($_GET['id'])?$id=$_GET['id']:$id=null;
isset($_GET['ac'])?$ac=$_GET['ac']:$ac=null;
if($ac=="cj"){$table="draw";}elseif($ac=="dj"){$table="excharge";}
if($id!="null"){
$delsql = "update wx_".$table."_log set status=1 where id = '$id'";
//echo $delsql;
//exit;
$delsql = mysql_query($delsql,$config);
if($delsql == "1"){
   echo  "<script>alert('�����ɹ�');location.href='home.php?h=$ac';</script>";

}else{
echo "����ʧ�ܣ��������ݿ⣡";  
}
}else{
    header("location:index.php");
}

?>
<?php
header("Content-type: text/html; charset=utf-8");
isset($_COOKIE['user'])?$username=$_COOKIE['user']:$username=null;
if($username==null)
{header("location:index.php");
}else{
    setcookie("user",$username,time()-3600*24);
    header("location:index.php");
    
}

?>
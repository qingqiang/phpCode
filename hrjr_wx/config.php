<?php
$config = mysql_connect("localhost","root","hrjr_wx+")or die(mysql_error());
mysql_select_db("hrjr");
mysql_query("SET NAMES UTF8");

$uptypes = array('image/jpg','image/jpeg','image/png','image/pjpeg','image/gif','image/bmp','image/x-png');
?>
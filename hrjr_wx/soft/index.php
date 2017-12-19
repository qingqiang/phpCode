<!DOCTYPE>
<head>
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
<link rel="bookmark" href="favicon.ico" type="image/x-icon" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<link type="text/css" href="../style/index.css" rel="stylesheet" />
</head>
<?php 
$query = $_SERVER['QUERY_STRING'];
$checkquery = preg_match("/^([0-9]{1,}).(html)$/",$query);
if($checkquery!="1"){
    echo "<script>alert('地址错误');</script>";
    exit;
}
$query = explode(".",$query);
$id = $query['0'];
require_once("../config.php");
$sql = "select * from soft where id = '$id'";
$sql = mysql_query($sql,$config);
$sql = mysql_fetch_array($sql);
$title = $sql['title'];

$content= $sql['content'];
$pv = $sql['pv'];
$time = $sql['date'];
$jianjie = $sql['jianjie'];
$images = $sql['images'];
$banben = $sql['banben'];
$daxiao = $sql['daxiao'];
$zhichi = $sql['zhichi'];
$url = $sql['url'];

$ad = "select * from ad";
$ad = mysql_query($ad,$config);
$ad = mysql_fetch_array($ad);

$win = "select * from win where id ='1'";
$win = mysql_query($win,$config);
$win = mysql_fetch_array($win);

?>

<title><?php echo $title; ?> - 小麦下载中心</title>
<meta  name="keywords" content="<?php echo $title; ?>"/>
<meta  name="description" content="<?php echo $jianjie; ?>"/>
<body>
<div id="top"></div>
<div id="logo">
<div class="left"><img src="<?php echo $win['logo'];?>"  /> </div>
</body>
<div class="right">
<ul>
<li><a href="../?p=index">首页</a></li>
<li><a href="../?p=down">下载中心</a></li>
<li><a href="../?p=help">帮助中心</a></li>
<li><a href="../?p=new">最新动态</a></li>
</ul>
</div>

</div>


<div id="downt"><img src="../images/dh.jpg" /></div>
<div id="downm">
<div id="zuo">
<div id="gnjs"><?php echo $title;?></div>
<div id="hx"></div>
<div id="images"><img src="<?php echo $images?>" style="width: 100%; height: 100%;"/></div>
<div id="zhichi">
<table>
<br />
<tr><td>版本：</td><td><span style="color: #1b68b6;"><?php echo $banben; ?></span></td></tr>
<tr><td>大小：</td><td><span style="color: #1b68b6;"><?php echo $daxiao; ?></span></td></tr>
<tr><td>系统支持：</td><td><span style="color: #1b68b6;"><?php echo $zhichi; ?></span></td></tr>

</table>
</div>
<div id="hx"></div>
<div id="xia">
<table>
<tr><td height="30px"><span style="font-weight: bold; line-height: 30px;" >下载地址:</span></td></tr>
<tr>
<td><a href="<?php echo $url;?>"><span style="font-size: 12px; color: #0080FF;">本地下载</span></a></td>
<td><a href="<?php echo $url;?>"><span style="font-size: 12px; color: #0080FF;">A5下载</span></a></td>
</tr>
</table>
</div>
<div id="hx"></div>
<div id="zhuti">

<?php echo $content;?></div>

</div>
<div id="right">
<div id="you1">
<div id="you11">赞助商链接</div>
<div id="youhx"></div>
<div id="ad">
<?php echo $ad['sanerwu'];?>
</div>
</div>
<div id="you2">
<div id="you11">下载排行榜</div>
<div id="youhx"></div>
<div id="youn">
<table>
<?php
$sql = "select * from soft order by pv limit 9";
$article = mysql_query($sql,$config);
while($new = mysql_fetch_array($article)){
    
    $content = $new['content'];
    $titles = $new['title'];
    $date = $new['date'];
    $url = $new['url'];
    $images = $new['images'];
    $zhichi = $new['zhichi'];
    $idd = $new['id'];



?>
<tr><td><a href="/soft?<?php echo $idd; ?>.html"><? echo $titles?></a></td></tr>

<?php } ?>
</table>
</div>


</div>
</div>

</div>



<div id="dibu">
<div class="nr">Copyright &copy; 2014 小麦网络 Allright Reserved.<br />
闽ICP备10205599号 E-mail:125676075@qq.com 
<?php echo $win['cnzz']?>
</div>
</div>
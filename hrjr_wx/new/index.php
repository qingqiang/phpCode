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
$sql = "select * from new where id = '$id'";
$sql = mysql_query($sql,$config);
$sql = mysql_fetch_array($sql);
$title = $sql['title'];
$content = $sql['content'];
$pv = $sql['pv'];
$time = $sql['date'];
$jianjie = $sql['jianjie'];
$ad = "select * from ad";
$ad = mysql_query($ad,$config);
$ad = mysql_fetch_array($ad);
$win = "select * from win where id ='1'";
$win = mysql_query($win,$config);
$win = mysql_fetch_array($win);

?>

<title><?php echo $title; ?> - 小麦最新动态</title>
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
<div id="gnjs">首页 &gt;&gt; <a href="../?p=new">最新动态</a></div>
<div id="hx"></div>
<div id="title"><span style="font-weight: bold; font-size: 25px; line-height: 60px;">
<?php echo $title;?></span><br /><span style="font-size: 10px;">
发布时间：<?php echo $time;?></span>
</div>
<div id="hx"></div>
<div id="zhuti"><?php echo $content;?></div>

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
<div id="you11">热门内容</div>
<div id="youhx"></div>
<div id="youn">
<table>
<?php
$sql = "select * from new order by pv limit 9";
$article = mysql_query($sql,$config);
while($new = mysql_fetch_array($article)){
    
    $titles = mb_substr($new['title'],0,16,'utf8');
    $idd = $new['id'];
?>
<tr><td><a href="/help?<?php echo $idd; ?>.html"><? echo $titles; ?></a></td></tr>

<?php } ?>
</table>
</div>

</div>
</div>
</div>

<div id="dibu">
<div class="nr">Copyright &copy; 2014 小麦网络 Allright Reserved.<br />
闽ICP备10205599号 E-mail:125676075@qq.com 
<?php echo $win['cnzz']; ?>
</div>
</div>
<?php 

$ad = "select * from ad";
$ad = mysql_query($ad,$config);
$ad = mysql_fetch_array($ad);

?>

<div id="downt"><img src="/images/dh.jpg" /></div>
<div id="downm">
<div id="zuo">
<div id="gnjs">首页 &gt;&gt; 下载</div>
<div id="hx"></div>



<?php

$sql = "select * from soft order by id desc limit 5";
$article = mysql_query($sql,$config);
$newnum = mysql_num_rows($article);
while($new = mysql_fetch_array($article)){
    
    $content = strip_tags($new['content']);
    $content = mb_substr($content,0,40,'utf8');
    $title = mb_substr($new['title'],0,15,'utf8');
    $date = $new['date'];
    $url = $new['url'];
    $images = $new['images'];
    $zhichi = $new['zhichi'];
    $id = $new['id'];


?>
<div id="nei">
<div id="images"><img src="<?php echo $images?>" style="width: 100%; height: 100%;"/></div>
<div id="dbt"><a href="soft/?<?php echo $id; ?>.html"><?php echo $title ?></a></div>
<div id="dtime"><?php echo $date; ?></div>
<div id="dcontent"><?php echo $content; ?>......</div>
<div id="dxia"><a href="/down/down.php?id=<?php echo $id; ?>"> <img src="/images/ljxia.png" /></a></div>
</div>
<div id="hx"></div>
<?php } ?>
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
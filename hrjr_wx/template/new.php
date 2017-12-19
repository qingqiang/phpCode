<div id="downt"><img src="/images/dh.jpg" /></div>
<div id="downm">
<div id="zuo">
<div id="gnjs">首页 &gt;&gt; 最新动态</div>
<div id="hx"></div>
<?php 
$ad = "select * from ad";
$ad = mysql_query($ad,$config);
$ad = mysql_fetch_array($ad);

?>


<?php
$sql = "select * from new order by id desc limit 3";
$article = mysql_query($sql,$config);
$newnum = mysql_num_rows($article);
while($new = mysql_fetch_array($article)){
    $content = strip_tags($new['content']);
    $content = mb_substr($content,0,80,'utf8');
    $titles =  strip_tags($new['title']);
    $titles = mb_substr($titles,0,10,'utf8');
    $date = $new['date'];
    $id = $new['id'];

?>
<div id="nei">
<div id="bt"><a href="new/?<?php echo $id ?>.html"><?php echo $titles; ?></a></div>
<div id="time"><?php echo $date?></div>
<div id="content"><?php echo $content; ?></div>
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
<tr><td><a href="/new?<?php echo $idd; ?>.html"><? echo $titles; ?></a></td></tr>

<?php } ?>
</table>
</div>
</div>
</div>
</div>
<?php

$ad = "select * from ad";
$ad = mysql_query($ad,$config);
$ad = mysql_fetch_array($ad);

?>
<div id="shou">
<div class="n">
<div class="left">
<div class="yi"></div>
<!--<div class="xia"><a href="../down/down.php?id=34">
<img src="../images/xia.png" /></a></div> --!>
  
<div class="yan"><a href="http://www.zhaokandian.com/" target="_blank"><img src="../images/yan.png" /></a></div>
</div>
<div class="right">
<div class="gg">
<?php echo $ad['sanerwu'];?>
</div>
</div>

</div>
</div>
<div id="jieshao">
<div class="top">
<marquee id="scrollArea" height="30" width="955" loop="-1" scrollamount="2" scrolldelay="50" direction="left" onMouseOver=scrollArea.stop() onMouseOut=scrollArea.start()><?php echo $ad['zimu']?></marquee> 

</div>
<div class="left">
<div class="gnjs">功能介绍</div>
<div class="hx"></div>
<div class="js">
<div class="js1"><img src="../images/php.jpg" /></div>
<div class="js2"><h3>架构轻巧，完全免费与开源</h3>采用php伪静态，减少不必要的源码重复，让速度更快，。</div>
</div>
<div class="hx"></div>
<div class="js">
<div class="js1"><img src="../images/sql.jpg" /></div>
<div class="js2"><h3>前台后台一个都不能少</h3>会员、留言、投稿、展示、下载......各种模块功能不断升级完善，让你的网站变得更安全</div>
</div>
<div class="hx"></div>
<div class="js">
<div class="js1"><img src="../images/bz.jpg" /></div>
<div class="js2"><h3>空间虚拟机</h3>精选性价比、速度、安全最佳的空间，让你远离挑选的烦恼</div>
</div>
</div>
<div class="right1">
<div class="dt">赞助商链接</div>
<div class="dthx"></div>
<div class="ad">
<? echo $ad['sanerwu'];?>
</div>
</div>
<div class="right2">
<div class="dt">最新动态</div>
<div class="dthx"></div>
<table>
<?php 

$sql = "select * from new order by id desc limit 5";
$article = mysql_query($sql,$config);
$newnum = mysql_num_rows($article);
while($new = mysql_fetch_array($article)){
    
    $content = $new['content'];
    $titles = $new['title'];
    $id = $new['id'];

?>

<tr><td><a href="new/?<?php echo $id ?>.html"><?php echo $titles; ?></a></td></tr>


<?php } ?>

</table>
</div>
</div>
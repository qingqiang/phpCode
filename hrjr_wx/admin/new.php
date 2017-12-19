<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<?php
require_once("check.php");
?>
<div id="mt">后台管理 - 动态管理</div>
<div id="nei">
<table style="border: #1b68b6; "><tr style="font-weight: bold; text-align: center; color: #1b68b6;">
<td width="440">标题</td>
<td width="200">时间</td>
<td width="150">管理操作</td>
</tr>
</table></div>
<?php 
$sql = "select * from new";
$new = mysql_query($sql,$config);
while($newnum = mysql_fetch_array($new)){
?>
<div id="title"><?php echo mb_substr($newnum['title'],0,15,'utf8');?></div>
<div id="time"><?php echo $newnum['date']?></div>
<div id="up">
<div class="del"><a href="ndel.php?del=<?php echo $newnum['id'];?>">删除</a></div>
</div>
<?php } ?>
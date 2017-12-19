<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<?php
require_once("check.php");
require_once("../config.php");
$soft = "select * from soft  ";
$soft = mysql_query($soft,$config);
$soft = mysql_num_rows($soft);

$pv = "select sum(pv) AS pvs from soft";
$pv = mysql_query($pv,$config);
$pv = mysql_fetch_array($pv);


$new = "select * from new ";
$new = mysql_query($new,$config);
$new = mysql_num_rows($new);

$help = "select * from help";
$help = mysql_query($help,$config);
$help = mysql_num_rows($help)


?>

<div id="lie">
<div id="mt">后台概况&gt;&gt;</div>
<div id="nei"> 
<table cellpadding="10">
<tr>
<td>源码数量</td>
<td><span style="color: red;"><?php echo $soft; ?></span>&nbsp;个</td>
<td>共下载：<span style="color: red;"><?php echo $pv['pvs']; ?></span>&nbsp;次</td>
</tr>
<tr>
<td>帮助主题</td>
<td><span style="color: red;"><?php echo $help;?></span>&nbsp;篇</td>
</tr>
<tr>
<td>动态数量</td>
<td><span style="color: red;"><?php echo $new; ?></span>&nbsp;篇</td>
</tr>
</table>


</div>

</div>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<?php
require_once("check.php");
?>
<div id="mt">后台管理 - 奖品管理</div>
<div id="nei">
<table style="border: #1b68b6; ">
<tr style="font-weight: bold; text-align: center; color: #1b68b6;">
<td width="114">奖品名称</td>
<td width="100">奖品类别</td>
<td width="400">链接地址</td>
<td width="141">管理操作</td>
</tr>
<?php 
$sql = "select * from wx_prize";
$help = mysql_query($sql,$config);

while($helpnum = mysql_fetch_array($help)){

?>
<tr>
<td width="314"><?php echo $helpnum['title'];?></td>
<td><?php if($helpnum['type']==0) echo "转盘奖品"; elseif($helpnum['type']==1) echo "兑换积分";?></td>
<td><?php echo $helpnum['url']?></td>
<td width="141"><a href="hdel.php?del=<?php echo $helpnum['id'];?>">删除</a> | <a href="home.php?h=helped&id=<?php echo $helpnum['id'];?>">修改</a></td>
</tr>
</div>
<?php } ?>
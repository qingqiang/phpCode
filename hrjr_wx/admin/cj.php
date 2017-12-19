<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<script src="../js/jquery.min.js"></script>
<script src="../js/aLocation.js"></script>
<?php
require_once("check.php");
?>
<div id="mt">后台管理 - 抽奖记录管理</div>
<div id="nei">
<?php 
$Page_size=10; 
$result=mysql_query('select * from wx_draw_log'); 
$count = mysql_num_rows($result); 
$page_count = ceil($count/$Page_size); 

$init=1; 
$page_len=7; 
$max_p=$page_count; 
$pages=$page_count; 

//判断当前页码 
if(empty($_GET['page'])||$_GET['page']<0){ 
$page=1; 
}else { 
$page=$_GET['page']; 
} 

$offset=$Page_size*($page-1); 
$sql="select a.nickname,a.username,a.gender,a.telephone,a.addr_prov,a.addr_city,a.addr_area,a.address,b.* from wx_user as a,wx_draw_log as b where a.userid=b.userid order by b.id desc limit $offset,$Page_size";
$result=mysql_query($sql,$config); 
?>
<table>
<tr style="font-weight: bold; text-align: center; color: #1b68b6;">
<td width="100">微信名</td>
<td width="200">抽中奖品</td>
<td width="130">时间</td>
<td width="300">收货人</td>
<td width="80">操作</td>
</tr>
<?php while ($row=mysql_fetch_array($result)) {
	$sql_pz="select title from wx_prize where id=".$row['prize'];
	$res_pz=mysql_query($sql_pz,$config); 
	$rows_pz=mysql_fetch_array($res_pz);
?>
<tr>
<td><?php echo $row['nickname'];?></td>
<td><?php echo $rows_pz['title']?></td>
<td><?php echo $row['created_at']?></td>
<td>
姓名：<?php echo $row['username']?><?php if($row['gender']==1) echo "【男】";elseif($row['gender']==2) echo "【女】";?><br>
电话：<?php echo $row['telephone']?><br>
地址：<span id="address_<?php echo $row['id'];?>"><?php echo $row['address']?></span></td>
<td><?php if($row['status']==1){echo "<font color=#FF0000>已派奖</font>";} else { ?><a href="jp_update.php?ac=cj&id=<?php echo $row['id']?>">未派奖</a><?php }?><!--<a href="del.php?del=<?php echo $row['id'];?>">删除</a>--></td>
</tr>


<?php
if($row['addr_prov'] && $row['addr_city'] && $row['addr_area']) {
?>
    <script>
        $(function () {
            $('#address_<?php echo $row['id'];?>').html(aLocation[0]['<?php echo $row['addr_prov'];?>'] + aLocation['0,<?php echo $row['addr_prov'];?>']['<?php echo $row['addr_city'];?>']+aLocation['0,<?php echo $row['addr_prov'];?>,<?php echo $row['addr_city'];?>']['<?php echo $row['addr_area'];?>']+'<?php echo $row['address'];?>');
        });
    </script>
<?php
}?>


<?php }?>
</table>
</div>

<!--
<div id="title"></div>
<div id="time"></div>
<div id="up">
<div class="up">查看</div>
<div class="del"></div>
</div>
-->
<?php
$page_len = ($page_len%2)?$page_len:$pagelen+1;//页码个数 
$pageoffset = ($page_len-1)/2;//页码个数左右偏移量 

$key='<div class="page">'; 
$key.="<span>$page/$pages</span> "; //第几页,共几页 
if($page!=1){ 
$key.="<a href=\"".$_SERVER['PHP_SELF']."?h=cj&page=1\">第一页</a> "; //第一页 
$key.="<a href=\"".$_SERVER['PHP_SELF']."?h=cj&page=".($page-1)."\">上一页</a>"; //上一页 
}else { 
$key.="第一页 ";//第一页 
$key.="上一页"; //上一页 
} 
if($pages>$page_len){ 
//如果当前页小于等于左偏移 
if($page<=$pageoffset){ 
$init=1; 
$max_p = $page_len; 
}else{//如果当前页大于左偏移 
//如果当前页码右偏移超出最大分页数 
if($page+$pageoffset>=$pages+1){ 
$init = $pages-$page_len+1; 
}else{ 
//左右偏移都存在时的计算 
$init = $page-$pageoffset; 
$max_p = $page+$pageoffset; 
} 
} 
} 
for($i=$init;$i<=$max_p;$i++){ 
if($i==$page){ 
$key.=' <span>'.$i.'</span>'; 
} else { 
$key.=" <a href=\"".$_SERVER['PHP_SELF']."?h=cj&page=".$i."\">".$i."</a>"; 
} 
} 
if($page!=$pages){ 
$key.=" <a href=\"".$_SERVER['PHP_SELF']."?h=cj&page=".($page+1)."\">下一页</a> ";//下一页 
$key.="<a href=\"".$_SERVER['PHP_SELF']."?h=cj&page={$pages}\">最后一页</a>"; //最后一页 
}else { 
$key.="下一页 ";//下一页 
$key.="最后一页"; //最后一页 
} 
$key.='</div>'; 
?> 
<div align="center"><?php echo $key?></div>
<br><br>
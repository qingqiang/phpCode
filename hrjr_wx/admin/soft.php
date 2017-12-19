<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<script src="../js/jquery.min.js"></script>
<script src="../js/aLocation.js"></script>
<?php
require_once("check.php");
?>
<div id="mt">后台管理 - 用户管理</div>
<div id="nei">
<?php 
$Page_size=10; 
$result=mysql_query('select * from wx_user'); 
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
$sql="select * from wx_user limit $offset,$Page_size"; 
$result=mysql_query($sql,$config); 
 

//$sql = "select * from soft";
//$soft = mysql_query($sql,$config);

//while($row = mysql_fetch_array($soft)){
?>
<table>
<tr style="font-weight: bold; text-align: center; color: #1b68b6;">
<td width="130">微信名</td>
<td width="130">注册时间</td>
<td width="130">姓名</td>
<td width="130">手机号</td>
<td width="400">收货地址</td>
</tr>
<?php while ($row=mysql_fetch_array($result)) {?>
<tr>
<td><?php echo mb_substr($row['nickname'],0,15,'utf8');?></td>
<td><?php echo $row['created_at']?></td>
<td><?php echo $row['username']?></td>
<td><?php echo $row['telephone']?></td>
<td><span id="address_<?php echo $row['userid'];?>"><?php echo $row['address']?></span></td>
<!--<a href="del.php?del=<?php echo $row['userid'];?>">删除</a>-->
</tr>
    <?php
        if($row['addr_prov'] && $row['addr_city'] && $row['addr_area']) {
    ?>
    <script>
        $(function () {
            $('#address_<?php echo $row['userid'];?>').html(aLocation[0]['<?php echo $row['addr_prov'];?>'] + aLocation['0,<?php echo $row['addr_prov'];?>']['<?php echo $row['addr_city'];?>']+aLocation['0,<?php echo $row['addr_prov'];?>,<?php echo $row['addr_city'];?>']['<?php echo $row['addr_area'];?>']+'<?php echo $row['address'];?>');
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
$key.="<a href=\"".$_SERVER['PHP_SELF']."?h=soft&page=1\">第一页</a> "; //第一页 
$key.="<a href=\"".$_SERVER['PHP_SELF']."?h=soft&page=".($page-1)."\">上一页</a>"; //上一页 
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
$key.=" <a href=\"".$_SERVER['PHP_SELF']."?h=soft&page=".$i."\">".$i."</a>"; 
} 
} 
if($page!=$pages){ 
$key.=" <a href=\"".$_SERVER['PHP_SELF']."?h=soft&page=".($page+1)."\">下一页</a> ";//下一页 
$key.="<a href=\"".$_SERVER['PHP_SELF']."?h=soft&page={$pages}\">最后一页</a>"; //最后一页 
}else { 
$key.="下一页 ";//下一页 
$key.="最后一页"; //最后一页 
} 
$key.='</div>'; 
?> 
<div align="center"><?php echo $key?></div>
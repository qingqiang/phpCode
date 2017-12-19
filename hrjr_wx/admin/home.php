<?php
require_once("check.php");
?>
<!DOCTYPE html>
<head>
<title>后台管理</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<link type="text/css" href="../style/home.css" rel="stylesheet" />
</head>
<body>
<div id="top" style="display:none"></div>
<div id="main">
<div id="tou">
<table style="float: right; text-align: center; line-height: 25px;display:none" width="280px"><tr>
<td><a href="../index.php">网站首页</a></td>
<td><a href="home.php">后台首页</a></td>
</tr></table>

</div>
<div id="left">
<div class="yi">功能列表</div>
<ul>

<li><a href="?h=soft">用户管理</a></li>
<!--<li><a href="?h=sfb">用户发布</a></li>-->
<li><a href="?h=help">奖品管理</a></li>
<li><a href="?h=helpfb">添加奖品</a></li>
<li><a href="?h=cj">抽奖管理</a></li>
<li><a href="?h=dj">兑奖管理</a></li>
<!--<li><a href="?h=newfb">动态发布</a></li>-->
<!--<li><a href="?h=win">系统设置</a></li>-->
<!--<li><a href="?h=ad">广告管理</a></li>-->
<li><a href="?h=pass">密码修改</a></li>
<li><a href="?h=out">退出系统</a></li>
</ul>
</div>
<div id="right">
<?php
isset($_GET['h'])?$h=$_GET['h']:$h="soft";
if($h){
    require("$h.php");
    
    
}
?>

</div>
</div>
</body>








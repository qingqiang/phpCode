<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<?php
require_once("check.php");
?>
<div id="mt">后台管理 - 广告管理</div>
<div id="nei">
    <?php
$sql = "select * from ad  where id='1'";
$ad = mysql_query($sql,$config);
$ad = mysql_fetch_array($ad);

        ?>
   
        
        
<form method="post" action="adtj.php">
<input type="hidden" name="action" value="1" />
<table>

<tr>
<td>广告代码:</td><td>
<textarea  name="ad" style="width: 350px; height: 100px; resize:none" ><?php echo $ad['sanerwu']; ?></textarea>
</td>
</tr>
<tr>
<td>首页字幕:</td><td>
<textarea  name="zimu" style="width: 350px; height: 50px; resize:none" ><?php echo $ad['zimu']; ?></textarea>
</td>
</tr>

<tr><td></td><td><input type="submit" style="width:150px; height: 35px; " value="设置" /></td></tr>
</table>

</form>

</div>
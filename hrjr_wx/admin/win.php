<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" href="../editor/themes/default/default.css" />
<script src="../editor/kindeditor.js"></script>
<script src="../javascript/jquery-1.11.1.min.js"></script>
<script src="../editor/lang/zh_CN.js"></script>
<?php
require_once("check.php");
?>
<div id="mt">后台管理 - 系统设置</div>
<div id="nei">
    <?php
$sql = "select * from win  where id='1'";
$win = mysql_query($sql,$config);
$win = mysql_fetch_array($win);

        ?>
	<script>
			KindEditor.ready(function(K) {
				var uploadbutton = K.uploadbutton({
					button : K('#uploadButton')[0],
					fieldName : 'imgFile',
					url : '../editor/php/upload_json.php?dir=image',
					afterUpload : function(data) {
						if (data.error === 0) {
							var url = K.formatUrl(data.url, 'absolute');
							K('#imgurl').val(url);
						} else {
							alert(data.message);
						}
					},
					afterError : function(str) {
						alert('自定义错误信息: ' + str);
					}
				});
				uploadbutton.fileBox.change(function(e) {
					uploadbutton.submit();
				});
			});
		</script>
    
        
        
<form method="post" action="wintj.php">
<input type="hidden" name="action" value="1" />
<table>
<tr>
<td>网站地址:</td><td><input value="<?php echo $win['url']; ?>" type="text" name="url" style="width: 350px; height: 25px;" /></td>
</tr>
<tr>
<td>网站标题:</td><td><input  value="<?php echo $win['title']; ?>"  type="text" name="title" style="width: 350px; height: 25px;" /></td>
</tr>
<tr>
<td>关键字:</td><td><input value="<?php echo $win['keywords']; ?>" type="text" name="keywords" style="width: 350px; height: 25px;" /></td>
</tr>
<tr>
<td>网站描述:</td><td><input value="<?php echo $win['description']; ?>" type="text" name="description" style="width: 350px; height: 25px;" /></td>
</tr>
<tr>
<td>网站LOGO:</td><td><input id="imgurl" value="<?php echo $win['logo']; ?>" type="text" name="logo" style="width: 350px; height: 25px;" /></td>
<td><input type="button" id="uploadButton" value="上传图片" /></td><td>建议大小：230*90</td>
</tr>
<tr>
<td>版权信息:</td><td><input value="<?php echo $win['banquan']; ?>" type="text" name="banquan" style="width: 350px; height: 25px;" /></td>
</tr>
<tr>
<td>联系方式</td><td><input value="<?php echo $win['lianxi']; ?>" type="text" name="lianxi" style="width: 350px; height: 25px;" /></td>
</tr>
<tr>
<td>备案号:</td><td><input value="<?php echo $win['icp']; ?>" type="text" name="icp" style="width: 350px; height: 25px;" /></td>
</tr>
<tr>
<td>统计代码:</td><td>
<textarea  name="cnzz" style="width: 350px; height: 100px; resize:none" ><?php echo $win['cnzz']; ?></textarea>
</td>
</tr>

<tr><td></td><td><input type="submit" style="width:150px; height: 35px; " value="设置" /></td></tr>
</table>

</form>

</div>
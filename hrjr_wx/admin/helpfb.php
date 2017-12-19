<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<script src="../editor/kindeditor.js"></script>
<script src="../javascript/jquery-1.11.1.min.js"></script>
<script src="../editor/lang/zh_CN.js"></script>
<?php
require_once("check.php");
?>
<div id="mt">后台管理 - 添加奖品</div>
<div id="nei">
<script>
			var editor;
			KindEditor.ready(function(K) {
				editor = K.create('textarea[name="content"]', {
					resizeType : '0',
					allowPreviewEmoticons : true,
					allowImageUpload : true,
items : ['source', '|', 'undo', 'redo', '|', 'justifyleft', 'justifycenter', 'justifyright',
'justifyfull', 'insertorderedlist', 'insertunorderedlist', 'indent', 'outdent', '|', 'fontname', 'fontsize', '|', 'textcolor', 'bgcolor', 'bold',
'italic', 'underline', 'strikethrough', 'removeformat', '|', 'image',
'flash', 'media', 'advtable', 'hr', 'emoticons', 'link', 'unlink']
				});
			});
		</script>

<form method="post" enctype="multipart/form-data" action="helptj.php">
<input type="hidden" name="action" value="1" />
<table>
<tr>
<td>奖品类别:</td><td><select name="type">
<option value="">请选择类别</option>
<option value="0">转盘奖品</option>
<option value="1">兑换奖品</option>
</select></td>
</tr>
<tr>
<td>奖品名称:</td><td><input type="text" name="title" style="width: 350px; height: 25px;" /></td>
</tr>
<tr>
<td>奖品图片:</td><td><input type="file" name="upfile" style="width: 350px; height: 25px;" /></td>
</tr>
<tr>
<td>链接地址:</td><td><input type="text" name="url" style="width: 350px; height: 25px;" /></td>
</tr>
<tr>
<td>兑换积分:</td><td><input type="text" name="score" style="width: 350px; height: 25px;" /></td>
</tr>
<tr>
<td valign="top" align="right">奖品详情:</td><td><textarea name="content" style="width: 350px; height: 250px;"></textarea></td>
</tr>
<tr><td></td><td><input type="submit" style="width:150px; height: 35px; " value="发布" /></td></tr>
</table>

</form>

</div>


<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<script src="../editor/kindeditor.js"></script>
<script src="../javascript/jquery-1.11.1.min.js"></script>
<script src="../editor/lang/zh_CN.js"></script>
<?php
require_once("check.php");
?>




<div id="mt">后台管理 - 动态发布</div>
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

<form method="post" action="newtj.php">
<input type="hidden" name="action" value="1" />
<table>
<tr>
<td>名&nbsp;称:</td><td><input type="text" name="title" style="width: 350px; height: 25px;" /></td>
</tr>
<tr>
<td valign="top" align="right">内&nbsp;容:</td><td><textarea name="content" style="width: 350px; height: 250px;"></textarea></td>
</tr>
<tr><td></td><td><input type="submit" style="width:150px; height: 35px; " value="发布" /></td></tr>
</table>

</form>

</div>


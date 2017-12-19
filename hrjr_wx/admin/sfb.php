<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<script src="../editor/kindeditor.js"></script>
<script src="../javascript/jquery-1.11.1.min.js"></script>
<script src="../editor/lang/zh_CN.js"></script>
<?php
require_once("check.php");
?>
<div id="mt">后台管理 - 源码发布</div>
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
<script>
			KindEditor.ready(function(K) {
				var uploadbutton = K.uploadbutton({
					button : K('#upsoft')[0],
					fieldName : 'imgFile',
					url : '../editor/php/upload_json.php?dir=file',
					afterUpload : function(data) {
						if (data.error === 0) {
							var url = K.formatUrl(data.url, 'absolute');
							K('#softurl').val(url);
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
<form method="post" action="tijiao.php">
<input type="hidden" name="action" value="1" />
<table>
<tr>
<td>名&nbsp;称:</td><td><input type="text" name="title" style="width: 350px; height: 25px;" /></td>
</tr>
<tr>
<td>大&nbsp;小:</td><td><input type="text" name="daxiao" style="width: 350px; height: 25px;" /></td>
</tr>
<tr>
<td>版&nbsp;本:</td><td><input type="text" name="banben" style="width: 350px; height: 25px;" /></td>
</tr>
<tr>
<td>系统支持:</td><td><input type="text" name="zhichi" style="width: 350px; height: 25px;" /></td>
</tr>
<tr>
<td>缩&nbsp;图:</td><td><input  style="width: 350px;height:25px;" type="text" id="imgurl" name="imgurl" value="" readonly="readonly" /> <input type="button" id="uploadButton" value="上传图片" />&nbsp;&nbsp;&nbsp;&nbsp;<span style="font-size: 12px;">建议图片尺寸:150*150</span></td>
</tr>
<tr>
<td>源&nbsp;码:</td><td><input type="text" name="soft" id="softurl" style="width: 350px; height: 25px;" name="soft" value=""  readonly="readonly" /> <input type="button" id="upsoft" value="上传源码" /></td>
</tr>
<tr>
<td valign="top" align="right">简&nbsp;介:</td><td><textarea name="content" style=" width: 350px; height: 250px;" ></textarea></td>
</tr>
<tr><td></td><td><input type="submit" style="width:150px; height: 35px; " value="发布" /></td></tr>
</table>

</form>

</div>


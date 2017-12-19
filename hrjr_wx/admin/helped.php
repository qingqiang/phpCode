<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<script src="../editor/kindeditor.js"></script>
<script src="../javascript/jquery-1.11.1.min.js"></script>
<script src="../editor/lang/zh_CN.js"></script>
<?php
require_once("check.php");
require_once("../config.php");

    $title=$_POST["title"];
	$type=$_POST["type"];
    $content=$_POST["content"];
	$url=$_POST["url"];
	$score=$_POST["score"];
    $content=strip_tags($content);
	$vid=$_POST["sid"];
	$file = $_FILES["upfile"];
	//$jianjie= mb_substr($jianjie,0,15,'utf8');
    //$date=date("Y-m-d H:i:s");
	if(!empty($title)){
		if(!is_uploaded_file($file['tmp_name'])){ //判断上传文件是否存在
    //echo "<font color='#FF0000'>文件不存在！</font>";
    $pic=$_POST["pic"];
	}else{
	$fname = $_FILES["upfile"]["name"];
	$fname_array = explode('.',$fname);
	$extend = $fname_array[count($fname_array)-1];
	$MAX_FILE_SIZE = 512000;
	//文件当前位置创建picture文件夹，若要在上一层目录创建则为"../picture/";
	$dest_folder = "../up/";
	if($extend!=""){
	if(!in_array($file["type"],$uptypes)){
	echo "只能上传图片文件!";
	exit;
	}
	if($file["size"]>$MAX_FILE_SIZE){
	echo "图片大小不能超过512KB!";
	exit;
	}
	if(!file_exists($dest_folder)){
		mkdir($dest_folder);
	}
	$randval = date('Ymd').rand();
	$uploadfile = $dest_folder.$randval.'.'.$extend;
	//echo 'uploadfile: '.$uploadfile ;
	//echo '<img src='.$uploadfile.'/>';
	if(move_uploaded_file($_FILES["upfile"]["tmp_name"],$uploadfile)){
		//echo "图片上传成功!";
	}else{
		//echo "图片上传失败!";
	}
	$pic=$uploadfile;
  }
}
		$sql = "update wx_prize set
title='$title',content='$content',url='$url',type='$type',pic='$pic',score='$score' where id=".$vid;
	//echo $sql;
	//exit;
	$sql = mysql_query($sql,$config);
	if($sql){
   		echo "<script>window.onload=function(){alert('修改成功');location.href='home.php?h=help';}</script>";
	}else{
    
    echo "修改失败";
	}
}

$sql = "select * from wx_prize where id=".$_GET["id"];
//echo $sql;
$help = mysql_query($sql,$config);
$res = mysql_fetch_array($help);
?>
<div id="mt">后台管理 - 修改奖品</div>
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

<form method="post" enctype="multipart/form-data" action="">
<input type="hidden" name="sid" value="<?php echo $res['id'];?>" />
<input type="hidden" name="pic" value="<?php echo $res['pic'];?>" />
<table>
<td>奖品类别:</td><td><select name="type">
<option value="">请选择类别</option>
<option value="0" <?php if($res['type']==0) echo "selected";?>>转盘奖品</option>
<option value="1" <?php if($res['type']==1) echo "selected";?>>兑换奖品</option>
</select></td>
<tr>
<td>奖品名称:</td><td><input type="text" name="title" style="width: 350px; height: 25px;" value="<?php echo $res['title'];?>"/></td>
</tr>
<tr>
<td>奖品图片:</td><td><input type="file" name="upfile" style="width: 350px; height: 25px;" /></td>
</tr>
<tr>
<td>链接地址:</td><td><input type="text" name="url" style="width: 350px; height: 25px;" value="<?php echo $res['url'];?>"/></td>
</tr>
<tr>
<td>兑换积分:</td><td><input type="text" name="score" style="width: 350px; height: 25px;"  value="<?php echo $res['score'];?>"/></td>
</tr>
<tr>
<td valign="top" align="right">奖品详情:</td><td><textarea name="content" style="width: 350px; height: 250px;"><?php echo $res['content'];?></textarea></td>
</tr>
<tr><td></td><td><input type="submit" style="width:150px; height: 35px; " value="提交" /></td></tr>
</table>
</form>
</div>


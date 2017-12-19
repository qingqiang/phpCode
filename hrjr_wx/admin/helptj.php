<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<?php require_once("check.php");
require_once("../config.php"); 

if($_POST["submit"] == 发布);
{
    $title=$_POST["title"];
	$type=$_POST["type"];
    $content=$_POST["content"];
	$url=$_POST["url"];
	$score=$_POST["score"];
    $content=strip_tags($content);
	
	$file = $_FILES["upfile"];
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
	
} 
}

$sql = "insert into wx_prize (title,type,content,url,pic,score) values 
('$title','$type','$content','$url','$uploadfile','$score')";
$sql = mysql_query($sql,$config);
if($sql){
   echo "<script>window.onload=function(){alert('添加成功');location.href='home.php?h=help';}</script>";
}else{
    
    echo "添加失败";
}
?>
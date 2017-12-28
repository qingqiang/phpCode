<?php

$access_token = '5_ZQ8odc0lSAXFsucfjeRHJHlLW5RqmtUSOYQZllbNu_87Yn9T_op0WFmhq3gV4isXLeB7GG-IEx6zZ-4bRwjrNL2sRTl1v3ifZyVLAR2X8jyAUHrLEr33HYPIbhQbKqcHUDSxJv4VqmGmDcelQRMaAGAUVQ';

$appid = 'wx7fef2477d1200cda';
$secret = 'e5dd1f4d8b1dedae907c71e47861e6f4';
//https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx7fef2477d1200cda&redirect_uri=http://m.hrjk-p2p.com/login/index.html&response_type=code&scope=SCOPE&state=STATE#wechat_redirect


$url = 'https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=' . $access_token;


function http_post_data($c_url, $data = null,$is_post_true=false) {
	$curl = curl_init(); // 启动一个CURL会话
	curl_setopt($curl, CURLOPT_URL, $c_url); // 要访问的地址
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0); // 对认证证书来源的检查
	curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); // 模拟用户使用的浏览器
	curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1); // 使用自动跳转
	curl_setopt($curl, CURLOPT_AUTOREFERER, 1); // 自动设置Referer
	if($is_post_true)
		curl_setopt($curl, CURLOPT_POST, 1); // 发送一个常规的Post请求
	if(!empty($data))
		curl_setopt($curl, CURLOPT_POSTFIELDS, $data); // Post提交的数据包
	curl_setopt($curl, CURLOPT_TIMEOUT, 30); // 设置超时限制防止死循环
	curl_setopt($curl, CURLOPT_HEADER, 0); // 显示返回的Header区域内容
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); // 获取的信息以文件流的形式返回
	$tmpInfo = curl_exec($curl); // 执行操作
	if (curl_errno($curl)) {
		echo 'Errno'.curl_error($curl);//捕抓异常
	}
	curl_close($curl); // 关闭CURL会话
	return $tmpInfo; // 返回数据
}


$data = array(
	'touser' => 'onrV7uB13h--gM7_pzhAPYvodZbU',
	'template_id' => 'QP4CFgcVA0KTh92Jj59FaqhaZQS45PVnqKqUjvmBKcg',
	'data' => array(
		'first' => array(
			'value' => '尊敬的用户您好，您投资的项目国美在线1号供应链已满标。'
		),
		'keyword1' => array(
			'value' => '国美在线1号'
		),
		'keyword2' => array(
			'value' => '2015-12-24'
		),
		'remark' => array(
			'value' => '感谢您的使用，点击查看详情。'
		),
	),
);

$res = http_post_data($url,  json_encode($data));
print_r($res);
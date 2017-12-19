<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<link rel="stylesheet" type="text/css" href="<?=base_url().'css/main.css?'.time()?>" media="all" />
<link rel="stylesheet" type="text/css" href="<?=base_url().'css/dialog.css'?>" media="all" />
<link rel="stylesheet" type="text/css" href="<?=base_url().'css/font-awesome.css'?>" media="all" />
<script type="text/javascript" src="<?=base_url().'js/jquery.min.js'?>"></script>
<script type="text/javascript" src="<?=base_url().'js//main.js'?>"></script>
<script type="text/javascript" src="<?=base_url().'js/dialog_min.js'?>"></script>
<script src="<?= base_url() . 'js/hideWxMenu.js' ?>" type="text/javascript"></script>
<title>会员中心</title>
	<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
	<meta content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">
	<meta name="Keywords" content="" />
	<meta name="Description" content="" />
	<!-- Mobile Devices Support @begin -->
		<meta content="application/xhtml+xml;charset=UTF-8" http-equiv="Content-Type">
		<meta content="telephone=no, address=no" name="format-detection">
		<meta name="apple-mobile-web-app-capable" content="yes" /> <!-- apple devices fullscreen -->
		<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
	<!-- Mobile Devices Support @end -->
</head>
<body onselectstart="return true;" ondragstart="return false;">
<div class="container card">
	<header>
		<div class="header card">
			<div id="card" data-role="card" onclick="this.classList.toggle('on');" >
				<div class="front" style="background-image:url(<?=base_url().'images/logo.png'?>);">
										<span class="name" style="color:#FFFFFF"></span>
					<span class="no" style="color:#ff0000;"><?php echo '100000'+$user_info['userid'];?></span>
				</div>
				<div class="back" style="background-image:url(http://hs-album.oss.aliyuncs.com/static/14/9b/16/image/20150128/20150128155205_41487.jpg);">
							<span style="color:#000000;">
								<h3>使用说明：</h3>
								<pre style="white-space:pre-line;height: 84px;overflow:hidden;">
									欢迎加入华人金融P2P平台
								</pre>
							</span>
				</div>
			</div>
		</div>
		<div>
			<ul class="box group_btn">
			</ul>
		</div>
	</header>
	<div class="body">
		<ul class="list_ul">
			<div>
								<li class="li_b">
					<a href="https://open.weixin.qq.com/connect/oauth2/authorize?appid=<?php echo $this->config->item('appid');?>&redirect_uri=http%3A%2F%2Fzhaojianzhan.net%2Fdraw&response_type=code&scope=snsapi_base#wechat_redirect"><label class="label"><i>&nbsp;</i>积分抽奖<span>&nbsp;</span></label></a>
				</li>
				<li class="li_c">
					<a href="https://open.weixin.qq.com/connect/oauth2/authorize?appid=<?php echo $this->config->item('appid');?>&redirect_uri=http%3A%2F%2Fzhaojianzhan.net%2Fticket&response_type=code&scope=snsapi_base#wechat_redirect"><label class="label"><i>&nbsp;</i>注册投资换礼<span>&nbsp;</span></label></a>
				</li>
				<li class="li_d">
					<a href="<?php echo site_url('member/info');?>?openid=<?php echo $user_info['openid'];?>&token=<?php echo $token;?>"><label class="label"><i>&nbsp;</i>完善会员资料 <span>&nbsp;</span></label></a>
				</li>
							</div><!--
			<div>
																						<li class="li_g">
								<a href=""><label class="label"><i class="icon-shopping-cart">&nbsp;</i>华人金融P2P平台<span>&nbsp;</span></label></a>
							</li>
						
												</div>
			<div>-->
				<li class="li_i">
					<a class="label" href="javascript:void(0)"><i>&nbsp;</i>QQ群：450595446<span>&nbsp;</span></a>
				</li>
				<li class="li_j">
										
					<label class="label"><i>&nbsp;</i><p class="mutipleLine">深圳市南山区桃园路田厦国际中心A座1006-1007</p></label>
					
				</li>
				<!-- 
								<li class="li_k">
					<a href="/Webnewmemberscore/store/pid/378685/wechatid/oz7hMs3nbavBr53-qTIMc9Hwcu7o"><label class="label"><i>&nbsp;</i>适用门店<span>&nbsp;</span></label></a>
				</li>-->
							</div>
		</ul>
	</div>
</div>
<script type="text/javascript">
    function SelectCode(obj){
        var val = $(obj).val();
        if(val != 2){
            $("#vcode").hide();
        }else{
            $("#vcode").show();
        }

		if(val == 1){
			$("#vcode").hide();
			$("#password").show();
		}else{
			$("#password").hide();
		}
    }


</script>
</body>
</html>
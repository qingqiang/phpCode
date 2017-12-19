<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<link rel="stylesheet" type="text/css" href="<?=base_url().'css/main.css'?>" media="all" />
<link rel="stylesheet" type="text/css" href="<?=base_url().'css/dialog.css'?>" media="all" />
<script type="text/javascript" src="<?=base_url().'js/jquery_min.js'?>"></script>
<script type="text/javascript" src="<?=base_url().'js/dialog_min.js'?>"></script>
<script type="text/javascript" src="<?=base_url().'js/calendar.js'?>"></script>
<script type="text/javascript" src="<?=base_url().'js/main.js'?>"></script>
<script src="<?= base_url().'js/hideWxMenu.js'?>" type="text/javascript"></script>
<title>每日签到</title>
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
	<style type="text/css"> 
			body{background:F2f2f2}
			.Calendar { 
				font-family:Verdana; 
				background-color:#EEE; 
				text-align:center;
                height: 320px;
				line-height:1.5em; 
			}
			.Calendar .icons{
				display: block;
				width:40px;
				height:40px;
				background: url(http://stc.weimob.com/img/member/imgs/icons4.png) no-repeat center -300px;
				-webkit-background-size:50px auto;
			}
			.Calendar .icons_after{
				background-position: center -350px;
			}
			.Calendar header{
				font-size:14px;
				color:#888e8e;
				line-height:50px;
				height:50px;
				background:#ffffff;
				box-shadow: 0 5px 5px rgba(100,100,100,0.1);
			}
			.Calendar a{ 
				color:#0066CC; 
			} 
			.Calendar table{ 
				width:280px;
				margin:auto;
				border:0; 
			} 
			.Calendar table thead{color:#acacac;} 
			.Calendar table td {
				color:#989898;
				border:1px solid #ecf9fa;
				width:40px;
				height:40px;
				margin:1px;
				background: #ffffff;
				-webkit-box-sizing:border-box;
			}
			.Calendar thead td, .Calendar td:empty{
				background:none;
				border:0;
			}
			.Calendar thead td{
				color:#72bec9;
				font-size:13px;
				font-weight:bold;
			}
			#idCalendarPre{ 
				cursor:pointer; 
				float:left; 
			} 
			#idCalendarNext{ 
				cursor:pointer; 
				float:right;
			} 

			#idCalendar td a.checked{ 
				display: block;
				height:100%;
				border:1px solid #58c4d1; 
				line-height:38px;
				color:#989898;
			}
			#idCalendar td.onToday, #idCalendar td.onToday a{
				color:#ff3600!important;
			}
		</style>
		<script>
			/**
 			 * 积分签到
			*/
			function dosignin() {
				//提交信息
				$.ajax({
					type: "post",  
					url: "<?php echo site_url('checkin/docheckin');?>",
					data: "openid=<?php echo $user_info['openid'];?>",
					dataType: "json",  
					success: function(html){
				    	if (html.status == 0) {
							alert(html.msg, 1500);
                            setTimeout("window.location.reload()",1500);
				    	} else {
				    		alert(html.msg, 1500)
				    	}
					}
				});
				
				
			}
		</script>
		<div class="container integral">
			<header>
				<ul class="tbox tbox_1">
					<li >
						<p class="pre">
							<label><?php echo $user_info['score'];?></label>
							可用积分
						</p>
					</li>
					<li>
												<a href="javascript:void(0)" onclick="dosignin()" ><label>签到</label></a>
												
					</li>
					<li>
						<p class="pre">
							<label><?php echo $checkin_count;?></label>
							签到次数
						</p>
					</li>
				</ul>
				<nav class="nav_integral">
					<ul class="box">
                    <li><a href="javascript:;">
                                <span class="icons icons_record">&nbsp;</span><label>签到记录</label></a></li>
						<li><a href="https://open.weixin.qq.com/connect/oauth2/authorize?appid=<?php echo $this->config->item('appid');?>&redirect_uri=http%3A%2F%2Fzhaojianzhan.net%2Fticket&response_type=code&scope=snsapi_base#wechat_redirect">
                                <span class="icons icons_prize">&nbsp;</span><label>兑换礼品</label></a></li>
						<li><a href="https://open.weixin.qq.com/connect/oauth2/authorize?appid=<?php echo $this->config->item('appid');?>&redirect_uri=http%3A%2F%2Fzhaojianzhan.net%2Fdraw&response_type=code&scope=snsapi_base#wechat_redirect">
                                <span class="icons icons_luck">&nbsp;</span><label>积分抽奖</label></a></li>
						
						<li><a href="https://open.weixin.qq.com/connect/oauth2/authorize?appid=<?php echo $this->config->item('appid');?>&redirect_uri=http%3A%2F%2Fzhaojianzhan.net%2Fuser&response_type=code&scope=snsapi_base#wechat_redirect">
                                <span class="icons icons_teach">&nbsp;</span><label>推荐拿积分</label></a></li>
					</ul>
				</nav>
</header>
            <header>
	</header>
	<div class="body">
		<section class="p_10">
			<table class="table_record">
				<thead>
				<tr>
					<td style="width:30%;">积分详情 </td>
					<td style="width:50%;">日期 </td>
					<td style="width:20%;">积分</td>
				</tr>
				</thead>
				<tbody>
<?php 
						foreach ($checkin_log as $log) {
					?>
					<tr>
							<td>签到得积分  </td>
							<td><?php echo $log['datetime'];?></td>
							<td>+<?php echo $checkin_score;?></td>
						</tr>
					<?php
						}
					?>
               </tbody>
			</table>
		</section>
	</div>
 
</div>
</body>
</html>
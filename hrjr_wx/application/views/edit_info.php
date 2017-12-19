<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<link rel="stylesheet" type="text/css" href="<?= base_url().'css/main.css'?>" media="all" />
<link rel="stylesheet" type="text/css" href="<?= base_url().'css/dialog.css'?>" media="all" />
<script type="text/javascript" src="<?= base_url().'js/jquery.min.js'?>"></script>
<script type="text/javascript" src="<?= base_url().'js/mymain.js'?>"></script>
<script type="text/javascript" src="<?= base_url().'js/aSelect.js'?>"></script>
<script type="text/javascript" src="<?= base_url().'js/aLocation.js'?>"></script>
<script type="text/javascript" src="<?= base_url().'js/dialog_min.js'?>"></script>
<script type="text/javascript" src="<?= base_url().'js/dater_min.js'?>"></script>
<script type="text/javascript" src="<?= base_url().'js/main.js'?>"></script>
<title>会员卡</title>
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
<script>
	$().ready(function(){
		new dater({
			selectYear:document.getElementById("selectYear"),
			selectMonth:document.getElementById("selectMonth"),
			selectDate:document.getElementById("selectDate"),
			minDat: new Date("1900/1/1"),
			maxDat: new Date(),
			curDat: new Date("<?php echo ($user_info['birth_year']?$user_info['birth_year']:1970).'/'.($user_info['birth_month']?$user_info['birth_month']:1).'/'.($user_info['birth_date']?$user_info['birth_date']:1);?>")
		}).init();
	});

	function submit1(){
		var form = document.getElementById("form1");
		var obj = {
			username: form.username.value,
			gender:form.gender.value,
			telephone: form.telephone.value,
			//birthday: [form.birth_year.value, form.birth_month.value, form.birth_date.value].join("/"),
            birth_year : form.birth_year.value,
            birth_month : form.birth_month.value,
            birth_date : form.birth_date.value,
			//address:[form.addr_prov.value, form.addr_city.value, form.addr_area.value, form.address.value].join(" "),
            addr_prov : form.addr_prov.value,
            addr_city : form.addr_city.value,
            addr_area : form.addr_area.value,
            address : form.address.value
		};
		if(!obj.username || !obj.gender || !obj.telephone || !obj.birth_year || !obj.birth_month || !obj.birth_date || !obj.addr_prov || !obj.addr_city || !obj.addr_area || !obj.address){
			alert("请填写完整！", 1500);
			return;
		}

		//loading(true);
		$.ajax({
			url: "<?php echo site_url('member/edit');?>",
			type:"POST",
			data:$("#form1").serialize(),
			dataType:"json",
			success: function(res){
				//loading(false);
				if(res.errno == 0){
					alert('资料修改成功！', 1500);
                    redirect("https://open.weixin.qq.com/connect/oauth2/authorize?appid=<?php echo $this->config->item('appid');?>&redirect_uri=http%3A%2F%2Fzhaojianzhan.net%2Fmember&response_type=code&scope=snsapi_base#wechat_redirect",1500);
				}else{
					alert(res.error, 1500);
				}
			}
		});

	}
	$(function () {
		var sel = aSelect({data: aLocation});
		sel.bind('#selectProvince', '<?php echo $user_info['addr_prov'];?>');
		sel.bind('#selectCity', '<?php echo $user_info['addr_city'];?>');
		sel.bind('#selectArea', '<?php echo $user_info['addr_area'];?>');
	})
</script>
<div class="container info_tx">
<?php 
if($step=='' && $user_info['is_filled'] == 0){?>
<div class="ecard"></div>
 <div class="elql"></div><div class="elqr"><a href="<?php echo site_url('member/info');?>?openid=<?php echo $user_info['openid'];?>&token=<?php echo $token;?>&step=next">点击领取</a></div>
<?php  }else{?>

	<div class="body pt_10">
		<ul class="list_ul_card">
			<form id="form1" action="javascript:;" method="post">
				<li data-card>
               <?php 
if($user_info['is_filled'] == 0){?>
					<header>
						<label style="display:inline-block;">推荐积分说明：</label>
					</header>
                    <P>1、本次登记您将获得<span style="color:#db3652;">1000积分</span>；</P>
 <P>2、积分可以抽奖、换礼。</P>
 <P>3、以下资料请认真填写，资料必须真实，礼品将发给该联系人。</P>
 <P></P><?php  }else{?>
 					<header>
						<label style="display:inline-block;">会员资料：</label>
					</header>
                    <?php }?>
					<div class="forms">
						<dl>
							<dt>姓 名： </dt>
							<dd>
								<input type="text" name="username" id="username" value="<?php echo $user_info['username'];?>" placeholder="请输入姓名" maxlength="30"  class="input"/>
							</dd>
						</dl>
						<dl>
							<dt>手 机：</dt>
							<dd><input type="tel" name="telephone" value="<?php echo $user_info['telephone'];?>" placeholder="请输入手机号码" maxlength="11"  class="input"/></dd>
						</dl>
						
						<!-- 系统字段性别可修改-->
						<dl>
							<dt>性 别： </dt>
							<dd>
								<select name="gender" id="gender" class="select" style="width:100%;">
									<option value="1" <?php if($user_info['gender'] == 1){?>selected="selected"<?php } ?>>男</option>
									<option value="2" <?php if($user_info['gender'] == 2){?>selected="selected"<?php } ?>>女</option>
								</select>
								</dd>
						</dl>
						<!-- 系统字段性别是否可修改-->
						<dl>
							<dt>生 日：</dt>
							<dd>
								<div class="box select_box">
									<div>
										<select name="birth_year" readonly="readonly"                                            class="select" id="selectYear" value="<?php echo $user_info['birth_year'];?>"><!--auth Eric_wu--></select>
									</div>
									<div>
										<select name="birth_month" readonly="readonly"                                            class="select" id="selectMonth" value="<?php echo $user_info['birth_month'];?>"><!--auth Eric_wu--></select>
									</div>
									<div>
										<select name="birth_date" readonly="readonly"                                            class="select" id="selectDate" value="<?php echo $user_info['birth_date'];?>"><!--auth Eric_wu--></select>
									</div>
								</div>
							</dd>
						</dl>
						<!-- 系统字段性别可修改-->
						<dl>
							<dt>地区:</dt>
							<dd>
								<div class="box select_box">
									<div>
										<select name="addr_prov" class="select" id="selectProvince"></select>
									</div>
									<div>
										<select name="addr_city" class="select" id="selectCity"></select>
									</div>
									<div>
										<select name="addr_area" class="select" id="selectArea"></select>
									</div>
								</div>
							</dd>
						</dl>
						<dl>
							<dt>详细地址:</dt>
							<dd><input type="text" name="address" id="Js-address" value="<?php echo $user_info['address'];?>" placeholder="请输入详细地址" maxlength="100"  class="input"/></dd>
						</dl>
                        </div>
<!-- 自定义字段必填项下拉框start-->
                                                <!-- 自定义字段必填项下拉框end-->

					</li>
				<div class="pt_10 pb_10">
					<a href="javascript:submit1();" class="button">提&nbsp;&nbsp;&nbsp;交</a>
				</div>
				<!--<div class="pt_10 pb_10">
					<a href="javascript:bd();" class="link">绑定已有实体卡</a>
				</div>-->
                <input type="hidden" name="openid" value="<?php echo $user_info['openid'];?>">
                <input type="hidden" name="token" value="<?php echo $token;?>">
			</form>
		</ul>
	</div>
    <?php }?>
</div>
</body>
</html>
<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html class="no-js " lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta name="keywords" content=""/>
    <meta name="description" content="奖品兑换"/>
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    <meta name="format-detection" content="telephone=no">
    <meta http-equiv="cleartype" content="on">
    <title>注册投资换礼</title>
    <!-- _global -->
    <!-- meta viewport -->
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>

    <!-- CSS -->
    <link rel="stylesheet" href="<?= base_url().'css/duijiang.css?'.time()?>" onerror="_cdnFallback(this)">
    <link rel="stylesheet" href="<?= base_url().'css/duijiang1.css?'.time()?>>" onerror="_cdnFallback(this)">
</head>
<body class=" body-fixed-bottom">
<!-- container -->
<div class="container ">
    <div class="apps-game">
        <div class="apps-checkin">
            <div class="apps-checkin-nav">
                <a href="">
                    <div class="apps-checkin-avatar"><img src="<?php echo $user_info['avator']; ?>"></div>
                </a>

                <div class="apps-checkin-nav-opt">
                    <a class="btn btn-opt" href="#">活动规则如下：</a>
                </div>
                <div class="apps-checkin-userinfo">
                    <p class="apps-checkin-userinfo-row"><?php echo $user_info['nickname']; ?></p>
                    <p class="apps-checkin-userinfo-row apps-checkin-userinfo-points">积分：<span
                            class="js-points"><?php echo $user_info['score']; ?></span></p>
                </div>
            </div>
            <div class="apps-checkin-content">
            <img src="../../images/reg_content.png" style="display:block;width:100%;" />
                <div class="apps-checkin-center-content" style="display:none">
                    <p>活动说明：</p>
                 	<p style="font-size:18px;font-weight:bold">华人金融用户专享，华人金融用户专享，注册投资即可换取礼品。非华人金融<font color="#FF0000">投资用户</font>请勿换取！</p>
                   	<p>本换礼活动每次换取礼品扣掉对应礼品积分，换取次数不限。</p>
               </div>
               <div class="apps-checkin-right-content" style="display:none">
               <img src="../../images/an_logo.jpg"  width="100" height="100"/>
               </div>
               <div style="clear:both"></div>
            </div>
        </div>

        <div id="wxcover"></div>

        <!-- 富文本内容区域 -->
        <div class="custom-richtext">
            <h2>热门换取</h2>
            </div>
         <!-- 商品区域 -->
            <!-- 展现类型判断 -->

            <?php
            foreach ($prize_list as $prize) {
                ?>
               <table border="0" cellpadding="0" cellspacing="0" width="100%" bgcolor="#FFFFFF" style="margin:10px 0">
               <tr><td height="20"></td></tr>
                <tr><td height="200" align="center"><a href="<?php echo $prize['url']; ?>"><img width="320" height="360" src="<?php echo $prize['pic']; ?>"/></a></td></tr>
                        
                        <tr><td height="30" align="center"><a href="<?php echo $prize['url']; ?>"  style="font-size:14px;"><?php echo $prize['title']; ?></a></td></tr>

                            <tr><td height="80" align="center" valign="top" style="font-size:14px;color:#ff8800"><?php echo $prize['score']; ?>积分&nbsp;&nbsp;
<a class="button" onClick="excharge(<?php echo $prize['id']; ?>);">立即兑换</a>
                           </td></tr>
                           </table>
            <?php } ?>
            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tr><td height="30" align="center"></td></tr>
               </table>
    </div>
</div>
<script src="<?= base_url() . 'js/jquery.min.js' ?>" type="text/javascript"></script>
<script src="<?= base_url() . 'js/mymain.js' ?>" type="text/javascript"></script>
<script src="<?= base_url() . 'js/hideWxMenu.js' ?>" type="text/javascript"></script>

<link rel="stylesheet" type="text/css" href="<?=base_url().'css/dialog.css'?>" media="all" />
<script type="text/javascript" src="<?=base_url().'js/dialog_min.js'?>"></script>
<script type="text/javascript" src="<?=base_url().'js/main.js'?>"></script>
<script>
    function excharge(giftid) {
        $.ajax({
            type: 'POST',
            url: '<?php echo site_url('ticket/doexcharge');?>?openid=<?php echo $user_info['openid'];?>&token=<?php echo $token;?>&giftid=' + giftid,
            dataType: 'json',
            success: function (data) {
                if (data.error == 'scoreerr') {
                    alert('积分不够！', 1500);
                    return;
                }

                if (data.success) {
                    alert('礼品兑换成功！', 1500);
                    if (data.fill_info) {
                        var redirect_url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=<?php echo $this->config->item('appid');?>&redirect_uri=http%3A%2F%2Fzhaojianzhan.net%2Fuser&response_type=code&scope=snsapi_base#wechat_redirect';
                    } else {
                        var redirect_url = '<?php echo site_url('member/info');?>?openid=<?php echo $user_info['openid'];?>&token=<?php echo $token;?>';
                    }

                    redirect(redirect_url, 100);
                }
            },
            error: function () {
                alert('加载失败!', 1500);
            }
        });
    }
</script>
</body>
</html>
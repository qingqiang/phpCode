<!DOCTYPE html>
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width,height=device-height,inital-scale=1.0,maximum-scale=1.0,user-scalable=no;">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="format-detection" content="telephone=no">
<title>活动介绍</title>
<link href="<?= base_url() . 'css/activity-style.css?'.time()?>" rel="stylesheet" type="text/css">
</head>
<body class="activity-lottery-winning" onselectstart="return true;" ondragstart="return false;">
<div class="main">
<div style="text-align:center;"><img width="320" style="width:100%" src="<?= base_url(). 'images/login.png'?>"></div>
<div style="margin:0 20px 20px 20px;">
<p>积分抽奖活动介绍：</p>
<br>
<p>说明：积分可用于 "积分抽奖"活动，礼品丰富，获奖率高。</p>
<br>
<p>用户获取积分方法：</p>
<p><br></p>

<p>一、	关注推荐</p>
<br>
<p>1，关注华人金融微信号送500积分；</p>
<p>2，推荐好友扫描二维码（二维码在"推荐拿积分"处可获得）送500积分，次级推荐送250积分，第三级推荐送125积分；</p>
<p>3，领取会员卡送1000积分；</p>
<p>4，每日签到送50积分。</p>
<br>
<p>二、	注册华人金融及投资</p>
<br>
<p>1，	注册华人金融送5000积分；</p>
<p>2，	首次投资华人金融送15000积分。</p>
<p><br>
</p>
</div>
</div>
<script src="<?= base_url() . 'js/jquery.min.js' ?>" type="text/javascript"></script>
<script src="<?= base_url() . 'js/mymain.js' ?>" type="text/javascript"></script>
<script src="<?= base_url() . 'js/hideWxMenu.js' ?>" type="text/javascript"></script>

<link rel="stylesheet" type="text/css" href="<?=base_url().'css/dialog.css'?>" media="all" />
<script type="text/javascript" src="<?=base_url().'js/dialog_min.js'?>"></script>
<script type="text/javascript" src="<?=base_url().'js/main.js'?>"></script>
<script type="text/javascript">
    $(function () {
        window.requestAnimFrame = (function () {
            return window.requestAnimationFrame || window.webkitRequestAnimationFrame || window.mozRequestAnimationFrame || window.oRequestAnimationFrame || window.msRequestAnimationFrame || function (callback) {
                    window.setTimeout(callback, 1000 / 60)
                }
        })();
        var totalDeg = 360 * 3 + 0;
        var steps = [];
        var lostDeg = [6];
        var prizeDeg = [42, 102, 132, 222, 192, 282, 312];
        var prize, sncode;
        var fill_info;
        var count = 0;
        var now = 0;
        var a = 0.01;
        var outter, inner, timer, running = false;

        function countSteps() {
            var t = Math.sqrt(2 * totalDeg / a);
            var v = a * t;
            for (var i = 0; i < t; i++) {
                steps.push((2 * v * i - a * i * i) / 2)
            }
            steps.push(totalDeg)
        }

        function step() {
            outter.style.webkitTransform = 'rotate(' + steps[now++] + 'deg)';
            outter.style.MozTransform = 'rotate(' + steps[now++] + 'deg)';
            if (now < steps.length) {
                requestAnimFrame(step)
            } else {
                running = false;
                setTimeout(function () {
                    if (prize != null) {
                        $("#sncode").text(sncode);
                        var type = "";
                        if (prize == 1) {
                            type = "保湿妆前乳"
                        }
                        else if (prize == 2) {
                            type = "唇膏"
                        }
                        else if (prize == 3) {
                            type = "防晒霜"
                        }
                        else if (prize == 4) {
                            type = "粉底"
                        }
                        else if (prize == 5) {
                            type = "洁面乳"
                        }
                        else if (prize == 6) {
                            type = "男士洁面乳"
                        }
						else if (prize == 7) {
                            type = "保湿乳液"
                        }
                        $("#prizetype").text(type);
                        $("#result").slideToggle(500);
                        $("#outercont").slideUp(500);

                        if(fill_info) {
                            var redirect_url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=<?php echo $this->config->item('appid');?>&redirect_uri=http%3A%2F%2Fzhaojianzhan.net%2Fuser&response_type=code&scope=snsapi_base#wechat_redirect';
                        }else{
                            var redirect_url = '<?php echo site_url('member/info');?>?openid=<?php echo $openid;?>&token=<?php echo $token;?>';
                        }

                        redirect(redirect_url, 1500);
                    } else {
                        alert("谢谢您的参与，下次再接再厉！", 1500);
                    }
                }, 200)
            }
        }

        function start(deg) {
            deg = deg || lostDeg[0];
            running = true;
            clearInterval(timer);
            totalDeg = 360 * 5 + deg;
            steps = [];
            now = 0;
            countSteps();
            requestAnimFrame(step)
        }

        window.start = start;
        outter = document.getElementById('outer');
        inner = document.getElementById('inner');
        i = 10;
        $("#inner").click(function () {
            if (running)return;
            $.ajax({
                url: "<?php echo site_url('turn/doturn');?>",
                dataType: "json",
                data: {openid: "<?php echo $openid;?>", token: "<?php echo $token;?>", t: Math.random()},
                beforeSend: function () {
                    running = true;
                    timer = setInterval(function () {
                        i += 5;
                        outter.style.webkitTransform = 'rotate(' + i + 'deg)';
                        outter.style.MozTransform = 'rotate(' + i + 'deg)'
                    }, 1)
                },
                success: function (data) {
                    if(data.error == 'scoreerr') {
                        alert('积分不够！', 1500);
                        clearInterval(timer);
                        return;
                    }
                    if (data.success) {
                        prize = data.prizetype;
                        fill_info = data.fill_info;
                        start(prizeDeg[data.prizetype - 1])
                    } else {
                        prize = null;
                        start()
                    }
                    running = false;
                    count++
                },
                error: function () {
                    prize = null;
                    start();
                    running = false;
                    count++
                },
                timeout: 4000
            })
        })
    });
</script>
</body>
</html>
<!DOCTYPE html>
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width,height=device-height,inital-scale=1.0,maximum-scale=1.0,user-scalable=no;">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="format-detection" content="telephone=no">
<title>幸运大转盘抽奖</title>
<link href="<?= base_url() . 'css/activity-style.css?'.time()?>" rel="stylesheet" type="text/css">
</head>
<body class="activity-lottery-winning" onselectstart="return true;" ondragstart="return false;">
<div class="main">
<div style="text-align:center;"><img width="320" style="width:100%" src="<?= base_url(). 'images/login.png'?>"></div>
<div style="height:20px;"></div>
<a style="color:#2e2e2e;margin:0 auto;border:none;width:80%; background:#dbe375;  border-radius:20px" href="https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx8b855a8f9d18a0f5&redirect_uri=http%3A%2F%2Fzhaojianzhan.net%2Fuser&response_type=code&scope=snsapi_base#wechat_redirect" class="ui-btn">立即赚积分</a>
<div style="margin:0 20px;"></div>
     <div id="outercont">
        <div id="outer-cont">
            <div id="outer" style="-webkit-transform: rotate(2136deg);"><img
                    src="images/activity-lottery-1.png"></div>
        </div>
        <div id="inner-cont">
            <div id="inner"><img src="images/activity-lottery-2.png"></div>
        </div>
    </div>
    <div style="margin:0 20px;"><p style="text-align: center;"><br></p><p style="text-align: center;"><span style="font-family: 微软雅黑, 'Microsoft YaHei'; text-decoration: underline; color: rgb(255, 255, 0);"><a style="font-family: 微软雅黑, 'Microsoft YaHei'; text-decoration: underline; color: rgb(255, 255, 0);" title="查看我的奖品" target="_self" href="https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx8b855a8f9d18a0f5&redirect_uri=http%3A%2F%2Fzhaojianzhan.net%2Fuser&response_type=code&scope=snsapi_base#wechat_redirect">查看我的奖品</a></span><br></p></div>
    <div style="margin:0 20px;"><p><span style="color: rgb(0, 0, 0);"><span style="display: none; line-height: 0px;" id="_baidu_bookmark_start_47">&zwj;</span><span style="display: none; line-height: 0px;" id="_baidu_bookmark_start_49">&zwj;</span><span style="display: none; line-height: 0px;" id="_baidu_bookmark_start_49"></span></span></p><p><br></p><p><span style="font-size: 16px; color: rgb(255, 255, 255);"><strong><span style="font-size: 16px; font-family: 微软雅黑, 'Microsoft YaHei';">活动规则：</span></strong></span></p><p><span style="font-size: 15px; font-family: 微软雅黑, 'Microsoft YaHei'; color: rgb(255, 255, 255);">1. 活动时间：</span></p><p><span style="font-size: 15px; font-family: 微软雅黑, 'Microsoft YaHei'; color: rgb(255, 255, 255);">2015年5月1日10:00-2015年5月31日23:59；</span></p><p><span style="font-size: 15px; font-family: 微软雅黑, 'Microsoft YaHei'; color: rgb(255, 255, 255);"><br></span></p><p><span style="color: rgb(255, 255, 255); font-size: 15px; font-family: 微软雅黑, 'Microsoft YaHei';">2. 活动期间，本活动10000积分抽奖一次，每次抽奖扣掉10000积分。拥有10000积分即可参与抽奖，不限次数；</span></p><p><span style="color: rgb(255, 255, 255); font-size: 15px; font-family: 微软雅黑, 'Microsoft YaHei';"><br></span></p><p><span style="color: rgb(255, 255, 255); font-size: 15px; font-family: 微软雅黑, 'Microsoft YaHei';">3. 活动奖品：（奖品均由嘉宝旗舰店提供，点击奖品图片可进入嘉宝旗舰店）</span></p><div class="jx"> 
 
<?php
            foreach ($prize_list as $prize) {
                ?>
<p><span style="font-size: 15px; font-family: 微软雅黑, 'Microsoft YaHei'; color: rgb(255, 255, 255);"><?php echo $prize['title']; ?></span></p>
<p><a href="<?php echo $prize['url']; ?>"><img src="<?php echo $prize['pic']; ?>"/></a></p>
<?php } ?>
<p><span style="font-size: 15px; font-family: 微软雅黑, 'Microsoft YaHei'; color: rgb(0, 0, 0);">
</span></p>
</div>
<p><br></p><p><span style="display: none; line-height: 0px;" id="_baidu_bookmark_end_50">&zwj;</span><span style="display: none; line-height: 0px;" id="_baidu_bookmark_end_48">&zwj;</span></p></div>
    <div class="content">
        <div class="boxcontent boxyellow" id="result" style="display:none">
            <div class="box">
                <div class="title-orange"><span>恭喜你中奖了</span></div>
                <div class="Detail">
                    <a class="ui-link" href="" id="opendialog" style="display: none;" data-rel="dialog"></a>

                    <p>你中了：<span class="red" id="prizetype">一等奖</span></p>

                    <!--<p>你的兑奖SN码：<span class="red" id="sncode"></span></p>

                    <p class="red">本次兑奖码已经关联你的微信号，你可向公众号发送 兑奖 进行查询!</p>
                    <p>
                        <input name="trname" class="px" id="trname" type="text" placeholder="输入您的姓名">
                    </p>
                    <p>
                        <input name="tel" class="px" id="tel" type="text" placeholder="输入您的手机号码">
                    </p>
                    <p>
                     <select name="sex" class="px" id="sex" placeholder="选择性别">
                     <option value="1">男</option>
                     <option value="0">女</option>
                     </select>
                    </p>
                    <p>
                    <select name="birth_year" readonly="readonly" class="select" id="selectYear" value="1970"></select>
                  <select name="birth_month" readonly="readonly" class="select" id="selectMonth" value="01"></select>
                 <select name="birth_date" readonly="readonly" class="select" id="selectDate" value="01"></select>
                    </p>
                     <p>
                      <select name="addr_prov" class="select" id="selectProvince">省</select>
					  <select name="addr_city" class="select" id="selectCity">市</select>
					  <select name="addr_area" class="select" id="selectArea">县</select>
                    </p>
                    <p>
                        <input name="adr" class="px" id="adr" type="text" placeholder="输入您详细地址">
                    </p>

                    <p>
                        <input class="pxbtn" id="save-btn" name="提 交" type="button" value="提 交">
                    </p>-->
                </div>
            </div>
        </div>
        <div class="boxcontent boxyellow" style="display:none">
            <div class="box">
                <div class="title-green"><span>奖项设置：</span></div>
                <div class="Detail">
                    <p>奖项一：保湿妆前乳</p>

                    <p>奖项二：唇膏</p>

                    <p>奖项三：防晒霜</p>
                    
                    <p>奖项四：粉底</p>

                    <p>奖项五：洁面乳</p>

                    <p>奖项六：男士洁面乳</p>
                    
                    <p>奖项七：保湿乳液</p>
                </div>
            </div>
        </div>
        <div class="boxcontent boxyellow" style="display:none">
            <div class="box">
                <div class="title-green">活动说明：</div>
                <div class="Detail">
                    <p>本次活动1000积分抽奖一次，每次抽奖扣掉1000积分。 </p>

                    <p> 我们的中奖率高达100%！！ </p>
                </div>
            </div>
        </div>
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
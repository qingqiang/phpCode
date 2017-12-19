<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>推荐拿积分</title>
    <meta name="viewport" content="width=device-width, initial-scale=1,user-scalable=no">
 <link href="<?= base_url().'css/bootstrap.css?'.time()?>" rel="stylesheet" type="text/css">
    <link href="<?= base_url().'css/mobileStyle.css?'.time()?>" rel="stylesheet" type="text/css">
    <style type="text/css">
        .msgModal {
            position: fixed;
            top: 0;
            background-color: #FFF;
            width: 90%;
            margin: 20% 5%;
            max-width: 500px;
            text-align: center;
            border-radius: 8px;
            padding: 10px 0;
            font-size: 14px;
            box-shadow: 0 0 4px #333;
            z-index: 99999;
            display: none;
        }
    </style>
</head>
<body>
<div class="wrapper">
<div class="dialogs" id="mainDiv">
        <div class="itemdiv">
            <div class="body">

                <div class="userInfo" onclick="goHref()">

                    <span class="photo"><img class="img" src="<?php echo $user_info['avator']; ?>"/></span>

                    <p class="info">
                        <span class="name"><?php echo html_escape($user_info['nickname']); ?></span>
                        <span
                            class="msg">我的推荐人：<?php echo $user_info['intro_name'] ? $user_info['intro_name'] : '无'; ?></span>
                    </p>


                    <a style="float: right; color: #ca2f2f;font-size: 14px; display:none" href="#">能抽大奖的P2P平台</a>

                    <div class="moreInfo">
                        <ul>
                            <li>
                                <!--<p class="tile">统计自己团队总成员人数</p>-->
                                <p class="tile">团队成员</p>

                                <p class="num"><?php echo $all_intro_count;?></p>
                            </li>
                            <li>
                                <!--<p class="tile">统计我的奖品数量</p>-->
                                <p class="tile">我的奖品</p>

                                <p class="num"><?php echo $prize_count;?></p>
                            </li>
                            <li>
                                <!--<p class="tile">统计我的总积分</p>-->
                                <p class="tile">总积分</p>

                                <p class="num" id="market_integral"><?php echo $user_info['score']; ?> </p>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="con">
                    <div class="code">
                        <p><h4>请您朋友扫此二维码<br/>加入华人金融P2P平台,得积分抽大奖!</h4></p>
                        <!--<p><h4>快邀请朋友和您一起玩转视界吧！<br/>轻松扫一扫，参与积分寻宝！</h4></p>-->
                        <img id="qrcodeUrl" alt="加载中、请等待！" src="<?php echo $qrcode_url; ?>">
                        <!--<p>扫一扫 加入南山的推广团队</p>-->
                        <div class="codeCopy">
                            <br/>

                            <span style="font-size: 15px;">此二维码三十分钟内有效</span> &nbsp;&nbsp;
                            <!--<span><a href="javascript:staticCode()" class="btn">申请永久二维码</a></span>-->

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="itemdiv">
            <div class="body">

                <div class="header_items">
                    <ul>
                        <li id="nav_1" class="active" onClick="changDiv(1,3)"><p>团队</p></li>
                        <li id="nav_2" onClick="changDiv(2,3)"><p>积分</p></li>
                        <li id="nav_3" onClick="changDiv(3,3)"><p>奖品</p></li>
                        <!--<li id="nav_1" onClick="changDiv(1,4)"><p>返现</p></li>-->
                    </ul>
                </div>
            </div>
        </div>


        <div id="chDiv_1">

            <div class="con">
                <div class="perBox">
                    <!--<div class="item_svipHeader item_sh_padding">我的阳光计划成员<span class="right">返现（$）</span></div>-->
                    <div class="item_svipHeader">
                        <span>排序方式:</span>
                            <span id="market-time_1"
                                  style="margin-left: 10px; color: #df3636;">时间</span>
                        <!--                            <span onclick="javascript:sortByMembers(1, 1)" id="market-number_1"-->
                        <!--                                  style="margin-left: 10px; color: black;">人数</span>-->
                        <span class="right" style="color:#df3636"><i
                                class="fa fa-user"></i> 我的推荐：<?php echo $intro_count; ?> 人 </span>
                    </div>

                    <div id="userList">
                        <?php $this->load->view('get_more_user_log'); ?>
                    </div>

                    <div id="boot_user" style="display: none; padding: 4px;text-align: center; font-size: 15px;">
                        快去推荐您的小伙伴加入赚积分活动！
                    </div>
                    <div class="item_svipMore" id="item_svipMoreUser">
                        <a href="javascript:queryOffline()">查看更多</a>
                    </div>
                </div>
                <!-- openId  mpUser -->
                <input id="openid" type="hidden" value="<?php echo $user_info['openid']; ?>">
            </div>
        </div>


        <div id="chDiv_2" style="display:none;">
            <div class="con">
                <div class="perBox">
                    <!--<div class="item_svipHeader item_sh_padding">我的积分<span class="right">积分</span></div>-->
                    <div class="item_svipHeader">
                        <span>排序方式:</span>
                        <span id="integral-time" style="margin-left: 10px; color: #df3636;">时间</span>
                        <span id="integral-number" style="margin-left: 10px; color: black;">积分</span>
                    </div>

                    <div id="integralLog">
                        <?php $this->load->view('get_more_score_log'); ?>
                    </div>

                    <div id="boot_integral"
                         style="display: none; padding: 4px;text-align: center; font-size: 15px;">
                        快去推荐您的小伙伴加入赚积分行动,签到，购买盒子赚钱积分！
                    </div>
                    <div class="item_svipMore" id="item_svipMorentegral">
                        <a href="javascript:getIntegral()">查看更多</a>
                    </div>
                </div>
            </div>
        </div>

        <div id="chDiv_3" style="display:none;">
            <div class="con">
                <div class="perBox">
                    <div class="item_svipHeader">
                        <span>类别:</span>
                        <span class="prize-draw" style="margin-left: 10px; color: #df3636;">抽奖</span>
                        <span class="prize-excharge" style="margin-left: 10px; color: black;">兑换</span>
                    </div>
                    <div class="prize-list" id="prizeLog">
                        <?php $this->load->view('get_more_prize_log'); ?>
                    </div>
                    <div class="item_svipMore" id="item_svipMorePrize">
                        <a class="prize-draw-more" href="javascript:getPrize(0)">查看更多</a>
                        <a class="prize-excharge-more" href="javascript:getPrize(1)" style="display: none;">查看更多</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

</div>


</div>
<!-- 提示新的下线 -->

<div id="message" class="msgModal">
    <label id="messageText"></label>
</div>
<script src="<?= base_url() . 'js/jquery.min.js' ?>"></script>
<!-- <script src="http://wechat.suntv.tv/zpp/socket.io/socket.io.js"></script> -->
<script src="<?= base_url() . 'js/bootstrap.min.js' ?>"></script>
<script src="<?= base_url() . 'js/toast.js' ?>"></script>
<script src="<?= base_url() . 'js/hideWxMenu.js' ?>" type="text/javascript"></script>
<script type="text/javascript">
    var integralPage = 1;  //积分  第几页
    var integralSort = 0;  //积分排序       0 代表时间，1 代表积分
    var pagecount = 10;   //一页显示几条

    function goBack() {
        if (stateNum === 2) {
            var leftNum = "translate3d(0%, 0px, 0px)";
            stateNum = 1;
        } else if (stateNum === 3) {
            var leftNum = "translate3d(-100%, 0px, 0px)";
            stateNum = 2;
        }
        sliderWarp(leftNum);
    }
    //------------------------------------------------------------------------------


    function mat_number(n) {
        var b = parseInt(n).toString();
        var len = b.length;
        if (len <= 3) {
            return b;
        }
        var r = len % 3;
        return r > 0 ? b.slice(0, r) + "," + b.slice(r, len).match(/\d{3}/g).join(",") : b.slice(r, len).match(/\d{3}/g).join(",");
    }

    //var mu_id = document.getElementById("mat_number");
    //var mu_id_1 = document.getElementById("mat_number_1");
    //var mu_id_2 = document.getElementById("mat_number_2");
    //
    //mu_id.innerHTML = mat_number(mu_id.innerHTML);
    //mu_id_1.innerHTML = mat_number(mat_number_1.innerHTML);
    //mu_id_2.innerHTML = mat_number(mat_number_2.innerHTML);


    function changDiv(value, maxNum) {

        for (var i = 1; i <= maxNum; i++) {
            document.getElementById("chDiv_" + i).style.display = "none";
            document.getElementById("nav_" + i).className = "";
        }

        document.getElementById("nav_" + value).className = "active";
        document.getElementById("chDiv_" + value).style.display = "block";

        if (value === 1) {
            sortByMembers(1, 0);
        }
    }
    //-----------------------------------------------------------------------------


    function goHref() {
        // window.location.href = '/wechat/integral';
    }

    var userPage = 0;
    function queryOffline() {
        userPage++;
        $.ajax({
            type: 'GET',
            url: '<?php echo site_url('user/get_more_user');?>?openid=<?php echo $user_info['openid'];?>&token=<?php echo $token;?>&page=' + userPage,
            dataType: 'json',
            success: function (data) {
                if (data.count < 10) {
                    $('#item_svipMoreUser').hide();
                }

                if (data.count == 0) {
                    return;
                }

                $('#userList').append(data.content);
            },
            error: function () {
                $.showToast('加载失败!');
            }
        });
    }

    var prizePage = 0;
    var prizeSort = 'dateTime';
    function getPrize(type) {
        prizePage++;

        $.ajax({
            type: 'GET',
            url: '<?php echo site_url('user/get_more_prize');?>?openid=<?php echo $user_info['openid'];?>&token=<?php echo $token;?>&page=' + prizePage + '&type=' + type,
            dataType: 'json',
            success: function (data) {
                if (data.count < 10) {
                    $('.prize-draw-more, .prize-excharge-more').hide();
                }

                if (data.count == 0) {
                    return;
                }

                $('#prizeLog').append(data.content);
            },
            error: function () {
                $.showToast('加载失败!');
            }
        });
    }

    $('.prize-draw').click(function () {
        prizePage = -1;
        $('#prizeLog').html('');
        $('.prize-excharge-more').hide();
        $('.prize-draw-more').show();
        getPrize(0);
        $(this).css('color', '#027bc6');
        $('.prize-excharge').css('color', 'black');
    });

    $('.prize-excharge').click(function () {
        prizePage = -1;
        $('#prizeLog').html('');
        $('.prize-draw-more').hide();
        $('.prize-excharge-more').show();
        getPrize(1);
        $(this).css('color', '#027bc6');
        $('.prize-draw').css('color', 'black');
    });


    //积分 时间 排序
    $('#integral-time').click(function () {
        integralPage = 0;
        integralSort = 0;
        $('#integralLog').html('');
        $(this).css('color', '#027bc6');
        $('#integral-number').css('color', 'black');
        getIntegral();
    });
    //积分 积分 排序
    $('#integral-number').click(function () {
        integralPage = 0;
        integralSort = 1;
        $('#integralLog').html('');
        $(this).css('color', '#027bc6');
        $('#integral-time').css('color', 'black');
        getIntegral();
    });

    function getIntegral() {
        var page = integralPage;
        $.ajax({
            type: 'GET',
            url: '<?php echo site_url('user/get_more_score');?>?openid=<?php echo $user_info['openid'];?>&token=<?php echo $token;?>&page=' + page + '&sortby=' + integralSort,
            dataType: 'json',
            success: function (data) {
                integralPage++;
                if (data.count < 10) {
                    $('#item_svipMorentegral').hide();
                }

                if (data.count == 0) {
                    return;
                }

                $('#integralLog').append(data.content);
            },
            error: function () {
                $.showToast('加载失败!');
            }
        });
    }

    function queryOfflineUser(userid, objid) {
        $.ajax({
            type: 'GET',
            url: '<?php echo site_url('user/get_more_user');?>?openid=<?php echo $user_info['openid'];?>&token=<?php echo $token;?>&userid=' + userid,
            dataType: 'json',
            success: function (data) {
                $('#user_list_' + userid).html(data.content);
            },
            error: function () {
                $.showToast('加载失败!');
            }
        });
    }

    //生成随机数
    var chars = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];

    function generateMixed(n) {
        var res = "";
        for (var i = 0; i < n; i++) {
            var id = Math.ceil(Math.random() * 35);
            res += chars[id];
        }
        return res;
    }

    function Random() {
        var word = "abcdefghijklmnopqrstuvwxyz_0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ".split(""), len = 112;
        return "." + word[Math.random() * len >> 1] + word[Math.random() * len >> 1]
    }
</script>

</body>
</html>

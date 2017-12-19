<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <title>积分抽奖</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <script type="text/javascript" src="<?php echo base_url();?>js/hideWxMenu.js"></script>
    <style type="text/css">
        *{
            margin:0; padding:0;
            outline: 0 !important;
        }
        *, *:before, *:after{
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }
        article,aside,details,figcaption,figure,footer,header,hgroup,menu,nav,section{display:block}
        li{list-style:none}
        img{border:0; max-width:100%; height:auto;}
        html{ width:100%; height:100%;}
        body{font-family:'SimHei', Arial, Helvetica; font-size:12px; color:#333; -webkit-overflow-scrolling:touch;-webkit-text-size-adjust:none;}
        a{
            color:#333;
            text-decoration:none;
            outline:none;
            -webkit-tap-highlight-color: rgba(0,0,0,0);
        }
        a:hover{
            text-decoration:none;
        }
        a:focus,a:active{outline:none;}

        .bgimg{ position:fixed; min-height:100%; z-index:-1;}
        .warp_scratch{margin:0 auto; max-width:640px;}

        .topimg{position:relative;}
        .topimg .btn{ position:absolute; width:33.333%; height:50%; overflow:hidden; text-indent:-9999em; display:block;}
        .topimg .btn01{ left:0; bottom:0;}
        .topimg .btn02{ top:0; left:50%; margin-left:-16.6666%;}
        .topimg .btn03{ right:0; bottom:0; height:65%;}

        .con{ padding:0 0 10px;}
        .con h2{width:100%; padding:0 28%; text-align:center;}
        .con ul{}
        .con li{padding:12px 14px 12px 22px; position:relative; height:80px; width:100%;}
        .con li:nth-child(2n+1){ background:url(http://wechat.suntv.tv/zpp/images/slist_bg_t.png) no-repeat; background-size:100% 100%;}
        .con li:nth-child(2n+2){ background:url(http://wechat.suntv.tv/zpp/images/slist_bg_b.png) no-repeat; background-size:100% 100%;}

        .con li .photo{width:38px; height:38px; border:1px solid #FFF; border-radius:50%; display:block; float:left;}
        .con li .photo img{border-radius:50%;}
        .con li .tet{padding-left:48px;}
        .con li .tet h4{font-size:14px; color:#333; word-break: keep-all; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;}
        .con li .tet h4 span{font-size:12px; margin-left:6px; background-color:#fe2616; color:#FFF; border-radius:8px; height:16px; line-height:16px; padding:0 8px; display:inline-block; vertical-align:top;}
        .con li .tet p{color:#333; font-size:12px; margin-top:4px; word-break: keep-all; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;}
        .con li .tet p.time{color:#999;}
        .con li .tet p.time a{color:#999;}

        .con li .tet .topTetBox{ position:relative; height:20px; line-height:20px; padding-right:20px;}
        .con li .tet .topTetBox:after{ content:''; position:absolute; width:0; height:0;border: 10px solid transparent;border-left-color: #fe2616; top:0px; right:0px;}
        .con li .tet p.topTet{ background-color:#fe2616; color:#FFF; padding:0 2px; height:20px;}


        .con li .gif{ float:left; font-size:30px; width:70px; font-weight:bold; text-align:center; font-family:Impact; margin-top:3px; font-weight:bold; display:inline-block;}
        .con li .gif i{display:block; font-size:14px; font-style:normal; font-family:Arial; font-weight:normal;}

        /*
        .con li:nth-child(1) .tet{padding-left:118px;}
        .con li:nth-child(2) .tet{padding-left:118px;}
        .con li:nth-child(3) .tet{padding-left:118px;}

        .con li:nth-child(1) .gif{ color:#fe2616;}
        .con li:nth-child(1) .tet .topTetBox:after{border-left-color: #fe2616;}
        .con li:nth-child(1) .tet p.topTet{ background-color:#fe2616;}

        .con li:nth-child(2) .gif{ color:#14bdfc;}
        .con li:nth-child(2) .tet .topTetBox:after{border-left-color: #14bdfc;}
        .con li:nth-child(2) .tet p.topTet{ background-color:#14bdfc;}

        .con li:nth-child(3) .gif{ color:#00b035;}
        .con li:nth-child(3) .tet .topTetBox:after{border-left-color: #00b035;}
        .con li:nth-child(3) .tet p.topTet{ background-color:#00b035;}
        */

        .con li.cash_log .tet{padding-left:118px;}
        .con li.cash_log .gif{ color:#e0d800;}
        .con li.cash_log .tet .topTetBox:after{border-left-color: #e0d800;}
        .con li.cash_log .tet p.topTet{ background-color:#e0d800;}

        .con li.cash_log_red .tet{padding-left:118px;}
        .con li.cash_log_red .gif{ color:#fe2616;}
        .con li.cash_log_red .tet .topTetBox:after{border-left-color: #fe2616;}
        .con li.cash_log_red .tet p.topTet{ background-color:#fe2616;}

        .con li.cash_log_blue .tet{padding-left:118px;}
        .con li.cash_log_blue .gif{ color:#14bdfc;}
        .con li.cash_log_blue .tet .topTetBox:after{border-left-color: #14bdfc;}
        .con li.cash_log_blue .tet p.topTet{ background-color:#14bdfc;}

        .con li.cash_log_green .tet{padding-left:118px;}
        .con li.cash_log_green .gif{ color:#00b035;}
        .con li.cash_log_green .tet .topTetBox:after{border-left-color: #00b035;}
        .con li.cash_log_green .tet p.topTet{ background-color:#00b035;}

        .topimg_1{}
        .topimg_1 ul{ background-color:#c0c0c0;}
        .topimg_1 li{ border-top:1px solid #c0c0c0;}
        .topimg_1 li a{display:block; position:relative; display:block; overflow:hidden;}
        .topimg_1 li a.linght:after{content:''; position:absolute; width:660px; height:660px; top:-100%; left:0%; background:url(http://wechat.suntv.tv/zpp/images/light_p.png);
            -webkit-animation:spin 5s linear infinite;
            animation:spin 5s linear infinite;
        }
        .topimg_1 img{ vertical-align:bottom;}

        @media screen and (max-width:539px) {
            .topimg_1 li a.linght:after{top:-270%; left:-50%;}
        }

        @-webkit-keyframes spin {
            0%  {-webkit-transform:rotate(0deg); opacity:0.3;}
            5%  {opacity:1;}
            10%  {opacity:0.3;}
            15%  {opacity:1;}
            50% {-webkit-transform:rotate(-180deg); opacity:1;}
            100%{-webkit-transform:rotate(-360deg); opacity:1;}
        }


    </style>

</head>
<body>

<div class="warp_scratch">
<div class="topimg_1">
		<ul>
  		    <!--<li><a href="<?php //echo site_url('guaka');?>"><img src="<?=base_url().'images/suntv_jc01.jpg'?>"></a></li>-->
		  <li><a href="<?php echo site_url('turn');?>?openid=<?php echo $user_info['openid'];?>&token=<?php echo $token;?>" class="linght"><img src="<?=base_url().'images/suntv_jc02.jpg'?>"></a></li>
		     <!-- <li><a href="#"><img src="<?//=base_url().'images/suntv_jc03.jpg'?>"></a></li>-->
		</ul>
    </div>

    <div class="con">
        <h2><img src="<?=base_url().'images/lottery_tile.png'?>"></h2>
        <ul id="lottery-list">
            
                <!--<li class="rating">
                    
                        <span class="gif">$100<i>喜获 USD</i></span>
                    
                    <span class="photo"><img src="http://wx.qlogo.cn/mmopen/dleWCQgVqTHpE2zmyTsmGctWvSp7VEfvnGI8QAtZX3lVoxkVJAhdiaWuGKOicJ0z5Vc38cyClibSY1B3s649A1O9WTXoJdj91cj/96"></span>
                    <div class="tet">
                        <h4>天啊，没天理了！</h4>
                        <div class="topTetBox"><p class="topTet">李小唯中了$100 USD大奖</p></div>
                        <p class="time">03/23/2015 10:01</p>
                    </div>
                </li>
            
                <li class="rating">
                    
                        <span class="gif">$50<i>喜获 USD</i></span>
                    
                    <span class="photo"><img src="http://wx.qlogo.cn/mmopen/8sqY02oFDF2wzgG4kOokxDY8MicuhcsqbHFT3ZPVdExx6iaowrw7lEWnAGDe3POpODjAqiaK3ERS6AGIKnUK58hVTaoa0UDfkHY/96"></span>
                    <div class="tet">
                        <h4>让人羡慕嫉妒恨啊！</h4>
                        <div class="topTetBox"><p class="topTet">森林木乖乖中了$50 USD大奖</p></div>
                        <p class="time">03/23/2015 07:07</p>
                    </div>
                </li>
            
                <li class="rating">
                    
                        <span class="gif">$20<i>喜获 USD</i></span>
                    
                    <span class="photo"><img src="http://wx.qlogo.cn/mmopen/8wzQ0Nr1ygsJl6PpMWammEOEnyXDylqjSyHI4GtuW5AibiacypD65lekHAxR0ZBfIxTicNzoxMproJMIHogmS3XaSP9TQx1FB9ic/96"></span>
                    <div class="tet">
                        <h4>哇，这是真的吗？</h4>
                        <div class="topTetBox"><p class="topTet">吕章中了$20 USD大奖</p></div>
                        <p class="time">03/23/2015 14:06</p>
                    </div>
                </li>-->
            
            <?php $this->load->view('get_more_draw_log.php');?>
            
        </ul>
        <div id="load-more" style="text-align: center; font-size: 14px; padding: 6px 10px;">
            查看更多
        </div>
    </div>
</div>

<script src="<?= base_url() . 'js/jquery.min.js' ?>"></script>
<script src="<?= base_url() . 'js/toast.js' ?>"></script>
<script src="<?= base_url() . 'js/hideWxMenu.js' ?>" type="text/javascript"></script>
<script type="text/javascript">
    $(function(){
        $('.rating').each(function(){
            var index = $(this).index();
            if (index == 0){
                $(this).addClass('cash_log_red')
            } else if (index == 1){
                $(this).addClass('cash_log_blue')
            } else if (index == 2){
                $(this).addClass('cash_log_green');
            }
        })
        var page = 0;
        $('#load-more').click(function(){
            page++
            $.ajax({
                type: 'GET',
                url: '<?php echo site_url('draw/get_more');?>?openid=<?php echo $user_info['openid'];?>&token=<?php echo $token;?>&page=' + page,
                dataType:'json',
                success: function(data){
                    renderPrizeList(data);
                },
                error: function(){
                    $.showToast('加载失败!');
                }
            })
        })

        function renderPrizeList(data){
            if (data.count < 10){
                $('#load-more').hide();
            }

            if (data.count == 0){
                return;
            }

            $('#lottery-list').append(data.content);
        }
    })
</script>

</body>
</html>

<?php
foreach ($score_list AS $score) {
    ?>
    <div class="item"><span class="photo"><img class="img"
                                               src="<?php echo $score['avator']; ?>"></span>

        <p class="info"><span class="name"><?php echo html_escape($score['nickname']); ?></span><span
                class="msg">
                                        <?php
                                        if ($score['type'] == 'subscribe') {
                                            ?>
                                            加入赢积分抽奖活动，获得积分奖励
                                        <?php
                                        } elseif ($score['type'] == 'intro') {
                                            ?>
                                            您于 <?php echo $score['created_at']; ?> 推荐了一位新朋友，您获得积分奖励
                                        <?php
                                        } elseif ($score['type'] == 'checkin') {
                                            ?>
                                            <?php echo $score['created_at']; ?> 签到，您获得积分奖励
                                        <?php
                                        } elseif ($score['type'] == 'draw') {
                                            ?>
                                            您于 <?php echo $score['created_at']; ?> 抽奖扣除积分
                                        <?php
                                        } elseif ($score['type'] == 'excharge') {
                                            ?>
                                            您于 <?php echo $score['created_at']; ?> 兑换礼品扣除积分
                                        <?php
                                        } elseif ($score['type'] == 'reg') {
                                            ?>
                                            注册成功，获得积分奖励
                                        <?php
                                        } elseif ($score['type'] == 'invest') {
                                            ?>
                                            投资成功，获得积分奖励
                                        <?php
                                        } elseif ($score['type'] == 'fill') {
                                            ?>
                                            完善会员资料，获得积分奖励

                                        <?php } ?>


                                    </span>
        </p><span
            class="meney"><?php if ($score['type'] == 'draw' || $score['type'] == 'excharge') { ?>-<?php } ?><?php echo $score['score']; ?></span>
    </div>
<?php
}
?>
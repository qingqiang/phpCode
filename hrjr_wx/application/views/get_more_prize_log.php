<?php
foreach ($prize_list AS $prize) {
    if(!$prize['title']) {
        continue;
    }
    ?>
    <div class="item"><span class="photo"><img class="img"
                                               src="<?php echo $prize['avator']; ?>"></span>

        <p class="info"><span class="name"><?php echo html_escape($prize['nickname']); ?></span><span
                class="msg">
                        您于 <?php echo $prize['created_at']; ?>
                <?php if (isset($type) && $type == 1) { ?>
                    兑换了
                <?php } else { ?>抽中了 <?php } ?><?php echo $prize['title']; ?>


                                    </span>
        </p>
    </div>
<?php
}
?>
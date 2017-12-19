<?php
foreach ($team_list as $team) {
    ?>
    <div class="item" id="userid_<?php echo $team['userid']; ?>" <?php if(@$level != 2) { ?>onclick="queryOfflineUser('<?php echo $team['userid']; ?>');"<?php } ?>><span
            class="photo"><img class="img"
                               src="<?php echo $team['avator']; ?>"></span>

        <p class="info"><span
                class="name"><?php echo $team['nickname']; ?><!--（<span
                                           >0</span>）</span>--><span
                    class="msg"><?php echo $team['created_at']; ?></span></p>
    </div>

    <div id="user_list_<?php echo $team['userid']; ?>" style="padding-left:15px;">

    </div>

<?php
}
?>
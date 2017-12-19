<?php
foreach($draw_log AS $draw) {
    ?>

    <li>
        <span class="photo"><img
                src="<?php echo $draw['avator'];?>"></span>

        <div class="tet">
            <h4><?php echo html_escape($draw['nickname']);?></h4>

            <p>参与1000积分抽奖，<?php if($draw['title']) { ?>中了<?php echo $draw['title'];?><?php }else{ ?>很遗憾，没有中奖！<?php } ?></p>

            <p class="time"><?php echo $draw['created_at'];?></p>
        </div>
    </li>
<?php
}
?>
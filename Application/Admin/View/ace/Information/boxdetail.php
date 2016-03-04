
<div class="message-header clearfix">
    <div class="pull-left">
        <span class="blue bigger-125"> <?=$item['notice_title']?> </span>

        <div class="space-4"></div>

        &nbsp;
        <img class="middle" alt="" src="<?=(!empty($item['head_image']) ? imageMogr2($item['head_image'],32,32) : 'Public//Ace/avatars/avatar.png')?>" width="32" />
        &nbsp;
        <a href="#" class="sender"><?=$item['mobile_num']?></a>

        &nbsp;
        <i class="icon-time bigger-110 orange middle"></i>
        <span class="time"><?=$item['insert_time']?></span>
    </div>

    <div class="action-buttons pull-right">
        <a href="#">
            <i class="icon-trash red icon-only bigger-130"></i>
        </a>
    </div>
</div>

<div class="hr hr-double"></div>

<div class="message-body">
    <p>
        <?=$item['notice_text']?>
    </p>
</div>


<?php if(isset($title_icon) && $title_icon):?><tr>
    <td colspan="2">
        <div class="widget-header widget-header-small header-color-blue3">
            <h6 class="smaller">
                <?=$title_icon?>
            </h6>
        </div>
    </td>
</tr>
<?php endif;?>
<?php foreach($cloumn_data as $cloumn=>$th_title):?>
<tr>
    <th width="50%"><?=$th_title?></th>
    <td>
        <?php foreach(explode(',',$cloumn) as $index):?>
        <?=$item[strtolower($index)]?>
        <?php endforeach;?>
    </td>
</tr>
<?php endforeach;?>
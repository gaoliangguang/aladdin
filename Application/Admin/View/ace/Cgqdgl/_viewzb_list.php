<tr>
    <td colspan="2">
        <div class="widget-header widget-header-small header-color-blue3">
            <?php if(isset($title_icon)):?>
            <h6 class="smaller">
                <?=$title_icon?>
            </h6>
            <?php endif;?>
        </div>
    </td>
</tr>
<tr>
    <td colspan="2">
        <table class="table table-striped table-bordered table-hover">
            <thead>
            <?php foreach($cloumn_data as $th_title):?>
                <th><?=$th_title?></th>
            <?php endforeach;?>
            </thead>
            <tbody>
            <?php foreach($list as $item):?>
            <tr>
               <?php foreach($cloumn_data as $cloumn=>$title):?>
                <td>
                    <?php foreach(explode(',',$cloumn) as $index):?>
                    <?=$item[$index]?>
                    <?php endforeach;?>
                </td>
                <?php endforeach;?>
            </tr>
            <?php endforeach;?>
            </tbody>
        </table>
    </td>
</tr>
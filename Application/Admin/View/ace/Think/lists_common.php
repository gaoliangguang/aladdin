<table class="table table-striped table-bordered table-hover dataTable">
    <!-- 表头 -->
    <thead>
    <tr>

        <?php if($model['need_batch_handle']):?>
        <th class="row-selected">
            <label>
                <input class="ace check-all" type="checkbox"/>
                <span class="lbl"></span>
            </label>
        </th>
        <?php endif;?>
        <volist name="list_grids" id="field">
            <th>{$field.title}</th>
        </volist>
    </tr>
    </thead>

    <!-- 列表 -->
    <tbody>
    <notempty name="list_data">
    <volist name="list_data" id="data">
        <tr>
            <?php if($model['need_batch_handle']):?>
            <td>
                <label>
                    <input class="ace ids" type="checkbox" name="ids[]" value="{$data['id']}" />
                    <span class="lbl"></span>
                </label>
            </td>
            <?php endif;?>
            <volist name="list_grids" id="grid">
                <td><?=get_list_field($data,$grid)?></td>
            </volist>
        </tr>
    </volist>
    <else/>
    <tr>
        <td colspan="<?=count($list_grids)?>" class="text-center"> aOh! 暂时还没有内容! </td>
    </tr>
    </notempty>
    </tbody>
</table>
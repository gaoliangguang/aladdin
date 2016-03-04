<extend name="Public/base"/>

<block name="body">
    <!-- 数据列表 -->
    <div class="table-responsive">
        <div class="dataTables_wrapper">  
            <?php foreach($list as $key=>$fee_list):?>
            <h3 class="row-fluid header smaller lighter purple">
                <span class="span7"> <?=$type_list[$key]?> </span><!-- /span -->
                <span class="span5">
                    <label class="pull-right inline">
                        <a class="btn btn-sm btn-white" href="<?=U('config/addfeerate',['type'=>$key])?>">
                            新增
                        </a>
                    </label>
                </span><!-- /span -->
            </h3>
            <table class="table table-striped table-bordered table-hover dataTable">
                <!-- 表头 -->
                <thead>
                <tr>
                    <th class="text-right">最小金额</th>
                    <th class="text-right">最大金额</th>
                    <th class="text-right">费率（万分比）</th>
                    <th class="text-right">封顶手续费</th>
                    <th>操作</th>
                </tr>
                </thead>

                <!-- 列表 -->
                <tbody>
                <?php foreach($fee_list as $data):?>
                    <tr>
                        <td class="text-right">
                            <?=price_format($data['min_amount'])?>
                        </td>
                        <td class="text-right">
                            <?=price_format($data['max_amount'])?>
                        </td>
                        <td class="text-right">
                            <a href="<?=U('config/editfeerate',['id'=>$data['id']])?>" class="">
                                <?=$data['fee_rate']?> %%
                            </a>
                        </td>
                        <td class="text-right">
                            <?=price_format($data['max_fee'])?>
                        </td>
                        <td>
                            <a href="<?=U('config/delfeerate',['id'=>$data['id']])?>" class="ajax-get confirm">
                                删除
                            </a>
                        </td>
                    </tr>
                <?php endforeach;?>
                </tbody>
            </table>
            <?php endforeach;?>
        </div>
    </div>
</block>

<block name="script">
<script type="text/javascript">
$(function(){
    //导航高亮
    highlight_subnav('{:U('config/feerate')}');
})
</script>
</block>

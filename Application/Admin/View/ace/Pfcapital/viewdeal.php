<extend name="Public/base" />

<block name="body">
<div class="col-md-offset-2 col-xs-8">
    <div class="widget-header widget-header-small header-color-blue">
        <h6 class="smaller">
        </h6>
    </div>
    <table class="table table-striped table-bordered table-hover">
        <tbody>
            <tr>
                <th width="50%">订单号</th>
                <td>
                    <?=$item['order_id']?>
                </td>
            </tr>
            <tr>
                <th>账户</th>
                <td><?=$item['account_id']?></td>
            </tr>
            <tr>
                <th>交易类型</th>
                <td><?=$type_array[$item['type']]?></td>
            </tr>
            <tr>
                <th>流向</th>
                <td><?=$flow_array[$item['flow_direction']]?></td>
            </tr>
            <tr>
                <th>交易金额</th>
                <td><?=price_format($item['sum'])?></td>
            </tr>
            <tr>
                <th>结存</th>
                <td><?=price_format($item['balance'])?></td>
            </tr>
            <tr>
                <th>交易时间</th>
                <td><?=$item['insert_time']?></td>
            </tr>
            <tr>
                <th>对方账户</th>
                <td><?=$item['peer_account_id']?></td>
            </tr>
            <tr>
                <th>备注</th>
                <td><?=$item['remark']?></td>
            </tr>
        </tbody>
    </table>
    <div class="clearfix form-actions">
        <div class="col-xs-12 center">
            <a onclick="history.go(-1)" class="btn btn-info" href="javascript:;">
                <i class="icon-reply"></i>返回上一页
            </a>
        </div>
    </div>
</div>
</block>
<block name="script">
<script>
    highlight_subnav('<?=U('pfcapital/dealindex')?>');
</script>
</block>
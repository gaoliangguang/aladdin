<extend name="Public/base"/>

<block name="body">
<?php $type= ['SBZ'=>'退还保证金','JBZ'=>'交纳保证金','GFK'=>'工程付款','GSK'=>'工程收款','CHZ'=>'冲正','TX#'=>'提现','CZ#'=>'充值','FRZ'=>'冻结','UFZ'=>'解冻','SXF'=>'手续费','TSX'=>'手续费退还'] ;
$flow = ['IN#'=>'转入','OUT'=>'转出'];
?>
            <table class="table table-striped table-bordered table-hover dataTable">
                <thead>
                    <tr>
                        <th>订单号</th>
                        <th>交易类型</th>
                        <th>交易金额</th>
                        <th>结余</th>
                        <th>交易时间</th>
                        <th>流向</th>
                        <th>备注</th>
                    </tr>
                </thead>
                <tbody>
				<notempty name="_list">
                <volist name="_list" id="item">
                    <tr>
                        <td>{$item.order_id}</td>
                        <td><?php echo $type[$item['type']];?></td>
                        <td>{$item.sum|price_format}</td>
                        <td>{$item.balance|price_format}</td>
                        <td>{$item.insert_time}</td>
                        <td><?php echo $flow[$item['flow_direction']]?></td>
                        <td>{$item.remark}</td>
                    </tr>
                </volist>
				<else/>
				<td colspan="10" class="text-center"> aOh! 暂时还没有内容! </td>
				</notempty>
                </tbody>
            </table>
            </form>
            <include file="Public/page"/>
        </div>
    </div>
</block>


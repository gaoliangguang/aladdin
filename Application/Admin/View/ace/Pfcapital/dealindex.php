<extend name="Public/base" />

<block name="body">
     <div class="table-responsive">
        <div class="dataTables_wrapper">  
            
            <div class="row">
                <div class="col-sm-12">
                    <form action="<?=U('pfcapital/dealindex')?>" method="POST" class="search-form">
                        <label>订单号
                            <input type="text" class="search-input" name="order_id" value="{:I('id')}">
                        </label>
                        <label>交易类型
                            <?=form_dropdown('type',[''=>'---全部---']+$type_array,I('type'))?>
                        </label>
                        <label>流向
                            <?=form_dropdown('flow_direction',[''=>'---全部---']+$flow_array,I('flow_direction'))?>
                        </label>
                        <label>
                            <button class="btn btn-sm btn-primary" type="button" id="search-btn" url="{:U('pfcapital/dealindex')}">
                               <i class="icon-search"></i>搜索
                            </button>
                        </label>
                    </form>
                </div>
            </div>
            
            <!-- 数据列表 -->
            <table class="table table-striped table-bordered table-hover dataTable">
			    <thead>
			        <tr>
                        <th class="">操作</th>
                        <th class="">订单号</th>
                        <th class="">账户</th>
                        <th class="">交易类型</th>
                        <th class="">流向</th>
                        <th class="align-right">交易金额</th>
                        <th class="align-right">结存</th>
                        <th class="">交易时间</th>
                        <th class="">备注</th>
					</tr>
			    </thead>
			    <tbody>
					<notempty name="list">
					<volist name="list" id="vo">
					<tr>
                        <td>
                            <a title="查看详情" href="{:U('viewdeal?order_id='.$vo['order_id'])}" class="ui-pg-div"><span class="ui-icon icon-zoom-in blue"></span></a>
                        </td>
						<td>
                            <a title="查看详情" href="{:U('viewdeal?order_id='.$vo['order_id'])}" class="ui-pg-div">
                                <?=$vo['order_id']?>
                            </a>
                        </td>
                        <td><?=$vo['account_id']?></td>
						<td><?=$type_array[$vo['type']]?></td>
						<td><?=$flow_array[$vo['flow_direction']]?></td>
                        <td class="align-right"><?=price_format($vo['sum'])?></td>
                        <td class="align-right"><?=price_format($vo['balance'])?></td>
                        <td><?=$vo['insert_time']?></td>
                        <td><?=$vo['remark']?></td>
                    </tr>
					</volist>
					<else/>
					<td colspan="9" class="text-center"> aOh! 暂时还没有内容! </td>
					</notempty>
				</tbody>
            </table>
            <div class="row">
                <div class="col-sm-4">
                </div>
                <div class="col-sm-8">
                    <include file="Public/page"/>
                </div>
            </div>
        </div>
    </div>
</block>
<extend name="Public/base" />

<block name="body">
     <div class="table-responsive">
        <div class="dataTables_wrapper">  
            
            <div class="row">
                <div class="col-sm-12">
                    <form action="<?=U('pfcapital/feeindex')?>" method="POST" class="search-form">
                        <label>项目编号
                            <input type="text" class="search-input" name="object_no" value="{:I('object_no')}">
                        </label>
                        <label>订单号
                            <input type="text" class="search-input" name="order_id" value="{:I('id')}">
                        </label>
                        <label>
                            <button class="btn btn-sm btn-primary" type="button" id="search-btn" url="{:U('pfcapital/feeindex')}">
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
                        <!--<th class="">操作</th>-->
                        <th class="">订单号</th>
                        <th class="">项目编号/名称</th>
                        <th class="">手续费金额</th>
                        <th class="">付款人（投标人）</th>
                        <th class="">交易时间</th>
                        <th class="">交易类型</th>
					</tr>
			    </thead>
			    <tbody>
					<notempty name="list">
					<volist name="list" id="vo">
					<tr>
                        <!--<td>
                            <a title="查看详情" href="{:U('viewdanbao?id='.$vo['id'])}" class="ui-pg-div"><span class="ui-icon icon-zoom-in blue"></span></a>
                        </td>-->
						<td><?=$vo['id']?></td>
						<td>{$vo.object_no}/<?=$vo['object_name']?></td>
                        <td><?=price_format($vo['fee'])?></td>
						<td><?=$vo['mobile_num']?></td>
                        <td><?=$vo['insert_time']?></td>
                        <td><?=$type_array[$vo['type']]?></td>
                    </tr>
					</volist>
					<else/>
					    <tr><td colspan="9" class="text-center"> aOh! 暂时还没有内容! </td></tr>
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
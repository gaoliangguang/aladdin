<extend name="Public/base" />

<block name="body">
     <div class="table-responsive">
        <div class="dataTables_wrapper">  
            
            <div class="row">
                <div class="col-sm-12">
                    <form action="<?=U('ztglobject/yzbindex')?>" method="POST" class="search-form">
                        <label>项目编号
                            <input type="text" class="search-input" name="purchase_no" value="{:I('purchase_no')}">
                        </label>
                        <label>项目名称
                            <input type="text" class="search-input" name="purchase_name" value="{:I('purchase_name')}">
                        </label>
                        <label>
                            <button class="btn btn-sm btn-primary" type="button" id="search-btn" url="{:U('cgqdgl/qdjgindex')}">
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
                        <th class="">项目编号</th>
                        <th class="">项目名称</th>
                        <th class="">中标人</th>
                        <th class="text-right">中标金额</th>
                        <th class="">创建时间</th>
                        <th class="">开标日期</th>
                        <th class="">投标时间</th>
					</tr>
			    </thead>
			    <tbody>
					<notempty name="list">
					<volist name="list" id="vo">
					<tr>
						<td><a data-rel="tooltip" data-placement="bottom" title="查看采购详情" href="{:U('cgxqindex',['purchase_no'=>$vo['purchase_no'],'active'=>'b'])}">{$vo.purchase_no}</a></td>
                        <td><?=$vo['purchase_name']?></td>
                        <td>
                            <a data-rel="tooltip" data-placement="bottom" title="查看抢单详情" href="{:U('viewqdjg?id='.$vo['bid'])}">
                                <?=$vo['nick_name']?>
                            </a>
                        </td>
                        <td class="text-right"><?=price_format($vo['bid_amount'])?></td>
						<td><?=$vo['insert_time']?></td>
						<td>{$vo.bid_open_date}</td>
						<td>{$vo.toubiao_time}</td>
					</tr>
					</volist>
					<else/>
					<td colspan="11" class="text-center"> aOh! 暂时还没有内容! </td>
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
<block name="script">
<script>
    $('[data-rel=tooltip]').tooltip();
</script>
</block>
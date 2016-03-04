<extend name="Public/base" />

<block name="body">
     <div class="table-responsive">
        <div class="dataTables_wrapper">  
            
            <div class="row">
                <div class="col-sm-12">
                    <form action="<?=U('ztglobject/yzbindex')?>" method="POST" class="search-form">
                        <label>项目编号
                            <input type="text" class="search-input" name="object_no" value="{:I('object_no')}">
                        </label>
                        <label>项目名称
                            <input type="text" class="search-input" name="object_name" value="{:I('object_name')}">
                        </label>
                        <label>工程类别
                            <?=form_dropdown('industry_id',[''=>'---全部---']+$industry,I('industry_id'))?>
                        </label>
                        <label>
                            <button class="btn btn-sm btn-primary" type="button" id="search-btn" url="{:U('ztglobject/yzbindex')}">
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
                        <th class="">中标公司</th>
                        <th class="text-right">中标金额</th>
                        <th class="text-right">标的估价</th>
                        <th class="">工程类别</th>
                        <th class="">创建时间</th>
                        <th class="">开标日期</th>
                        <th class="">投标时间</th>
					</tr>
			    </thead>
			    <tbody>
					<notempty name="list">
					<volist name="list" id="vo">
					<tr>
						<td><a data-rel="tooltip" data-placement="bottom" title="查看标的详情" href="{:U('viewzb',['object_id'=>$vo['object_id'],'active'=>'b'])}">{$vo.object_no}</a></td>
                        <td><?=$vo['object_name']?></td>
                        <td>
                            <a data-rel="tooltip" data-placement="bottom" title="查看中标详情" href="{:U('viewzhongbiao?id='.$vo['bid'])}">
                                <?=$vo['company_name']?>
                            </a>
                        </td>
                        <td class="text-right"><?=price_format($vo['bid_amount'])?></td>
                        <td class="text-right"><?=price_format($vo['evaluation_amount'])?></td>
                        <td><?=$industry[$vo['industry_id']]?></td>
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
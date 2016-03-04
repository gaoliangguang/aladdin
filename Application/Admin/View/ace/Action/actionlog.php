<extend name="Public/base"/>

<block name="body">
	<!--列表 -->
    <div class="table-responsive">
        <div class="dataTables_wrapper">   
            <table class="table table-striped table-bordered table-hover dataTable">
			    <thead>
			        <tr>
                    <th class="row-selected center">
                        <label>
                           <input class="ace check-all" type="checkbox"/>
                           <span class="lbl"></span>
                        </label>
                    </th>
					<th class="">编号</th>
					<th class="">行为名称</th>
					<th class="">执行者</th>
					<th class="">执行时间</th>
					<th class="">操作</th>
					</tr>
			    </thead>
			    <tbody>
					<notempty name="_list">
					<volist name="_list" id="vo">
					<tr>
			            <td class="center">
                            <label>
                                <input class="ace ids" type="checkbox" name="ids[]" value="{$vo.id}" />
                                <span class="lbl"></span>
                            </label>
                        </td>
						<td>{$vo.id} </td>
						<td>{:get_action($vo['action_id'],'title')}</td>
						<td>{:get_nickname($vo['user_id'])}</td>
						<td><span>{$vo.create_time|time_format}</span></td>
						<td><a href="{:U('Action/edit?id='.$vo['id'])}">详细</a>
							<a class="confirm ajax-get" href="{:U('Action/remove?ids='.$vo['id'])}">删除</a>
			                </td>
					</tr>
					</volist>
					<else/>
					<td colspan="6" class="text-center"> aOh! 暂时还没有内容! </td>
					</notempty>
				</tbody>
            </table>
            <div class="row">
                <div class="col-sm-4">
                    <label>
                        <a class="btn btn-white ajax-get confirm" href="{:U('clear')}">
                            清空
                        </a>
                    </label>
                    <label>
                        <button class="btn btn-white ajax-post confirm" target-form="ids" url="{:U('remove')}">
                            删除
                        </button>
                    </label>
                </div>
                <div class="col-sm-8">
                    <include file="Public/page"/>
                </div>
            </div>
        </div>
    </div>
</block>
<block name="script">
<script type="text/javascript">
$(function(){
	$("#action_add").click(function(){
		window.location.href = $(this).attr('url');
	})
})
</script>
</block>

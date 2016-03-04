<extend name="Public/base"/>

<block name="body">
	<!-- 数据列表 -->

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
                        <th class="">标识</th>
                        <th class="">名称</th>
                        <th class="">创建时间</th>
                        <th class="">状态</th>
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
						<td>{$vo.name}</td>
						<td><a data-id="{$vo.id}" href="{:U('model/edit?id='.$vo['id'])}">{$vo.title}</a></td>
						<td><span>{$vo.create_time|time_format}</span></td>
						<td>
                            <label>
                                <input type="checkbox" class="ace ace-switch ace-switch-6 ajax-get" name="status" value="{$vo.status}" <?=$vo['status'] == '1' ? 'checked' : ''?> url="{:U('model/setstatus?ids='.$vo['id'].'&status='.abs(1-$vo['status']))}">
                                <span class="lbl"></span>
                            </label>
                        </td>
                        <td>
                            <a title="删除" href="{:U('model/del?ids='.$vo['id'])}" class="ui-pg-div ui-inline confirm ajax-get">
                                删除
                            </a>
                            <?php if($vo['need_datalist']):?>
                                <a title="数据列表" href="{:U('think/lists?model='.$vo['name'])}" class="ui-pg-div ui-inline">
                                    数据列表
                                </a>
                            <?php endif;?>
                        </td>
					</tr>
					</volist>
					<else/>
					<td colspan="7" class="text-center"> aOh! 暂时还没有内容! </td>
					</notempty>
				</tbody>
			    </table>

                <div class="row">
                    <div class="col-sm-4">
                        <label>
                            <a class="btn btn-white" href="{:U('Model/add')}">
                                新增
                            </a>
                        </label>
                        <label>
                            <a class="btn btn-white" href="{:U('Model/generate')}">
                                生成
                            </a>
                        </label>
                        <label>
                            <button class="btn btn-white ajax-post" target-form="ids" url="{:U('Model/setStatus',array('status'=>1))}">
                                启 用
                            </button>
                        </label>
                        <label>
                            <button class="btn btn-white ajax-post" target-form="ids" url="{:U('Model/setStatus',array('status'=>0))}">
                                暂停
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
    <script src="__STATIC__/thinkbox/jquery.thinkbox.js"></script>
    <script type="text/javascript">
    $(function(){
    	$("#search").click(function(){
    		var url = $(this).attr('url');
    		var status = $('select[name=status]').val();
    		var search = $('input[name=search]').val();
    		if(status != ''){
    			url += '/status/' + status;
    		}
    		if(search != ''){
    			url += '/search/' + search;
    		}
    		window.location.href = url;
    	});
})
</script>
</block>

<extend name="Public/base"/>

<block name="body">

 <div class="table-responsive">
    <div class="dataTables_wrapper">  

        <!-- 数据列表 -->
        <table class="table table-striped table-bordered table-hover dataTable">
			<thead>
				<tr>
					<th class="row-selected center">
                        <label>
                            <input class="ace check-all" type="checkbox"/>
                            <span class="lbl"></span>
                        </label>
					</th>
					<th>ID</th>
					<th>导航名称</th>
					<th>导航地址</th>
                    <th>排序</th>
					<th>操作</th>
				</tr>
			</thead>
			<tbody>
				<notempty name="list">
				<volist name="list" id="channel">
					<tr>
						<td class="center">
                            <label>
                                <input class="ace ids" type="checkbox" name="id[]" value="{$channel['id']}" />
                                <span class="lbl"></span>
                            </label>
                        </td>
						<td>{$channel.id}</td>
						<td><a href="{:U('index?pid='.$channel['id'])}">{$channel.title}</a></td>
						<td>{$channel.url}</td>
                        <td>{$channel.sort}</td>
						<td>
							<a title="编辑" href="{:U('edit?id='.$channel['id'].'&pid='.$pid)}">编辑</a>
							<a href="{:U('setStatus?ids='.$channel['id'].'&status='.abs(1-$channel['status']))}" class="ajax-get">{$channel.status|show_status_op}</a>
							<a class="confirm ajax-get" title="删除" href="{:U('del?id='.$channel['id'])}">删除</a>
						</td>
					</tr>
				</volist>
				<else/>
				<td colspan="6" class="text-center"> aOh! 暂时还没有内容! </td>
				</notempty>
			</tbody>
		</table>
        <div class="row">
            <div class="col-sm-12">
                <label>
                    <a class="btn btn-white" href="{:U('add','pid='.$pid)}">
                        新增
                    </a>
                </label>
                <label>
                    <a class="btn btn-white list_sort" href="{:U('sort',array('pid'=>I('get.pid',0)),'')}">
                        排序
                    </a>
                </label>
            </div>
        </div>
    </div>
</div>
</block>

<block name="script">
<script type="text/javascript">
    $(function() {
    	//点击排序
    	$('.list_sort').click(function(){
    		var url = $(this).attr('url');
    		var ids = $('.ids:checked');
    		var param = '';
    		if(ids.length > 0){
    			var str = new Array();
    			ids.each(function(){
    				str.push($(this).val());
    			});
    			param = str.join(',');
    		}

    		if(url != undefined && url != ''){
    			window.location.href = url + '/ids/' + param;
    		}
    	});
    });
</script>
</block>
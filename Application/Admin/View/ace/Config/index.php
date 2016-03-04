<extend name="Public/base"/>

<block name="body">
    <div class="page-header">
        <h1>
            <small>
                <i class="icon-double-angle-right"></i>
                <present name="Think.get.group">
		        <a href="{:U('index')}">全部</a><else/><strong>全部</strong></present>&nbsp;<foreach name="group" item="vo">
		        <neq name="group_id" value="$key">
		         <a href="{:U('index?group='.$key)}">{$vo}</a><else/><strong>{$vo}</strong></neq>&nbsp;     
		        </foreach>
            </small>
        </h1>
    </div>
	<div class="table-responsive">
        <div class="dataTables_wrapper">  
            
            <div class="row">
                <div class="col-sm-12">
                    <div class="search-form">
                        <label>请输入配置名称 
                            <input type="text" name="name" class="search-input" value="{:I('name')}" placeholder="请输入配置名称">
                        </label>
                        <label>
                            <button class="btn btn-sm btn-primary" type="button" id="search" url="{:U('config/index')}">
                               <i class="icon-search"></i>搜索
                            </button>
                        </label>
                    </div>  
                </div>
            </div>
            
            <!-- 数据列表 -->
            <table class="table table-striped table-bordered table-hover dataTable">
				<thead>
					<tr>
						<th>ID</th>
						<th>名称</th>
						<th>标题</th>
						<th>分组</th>
						<th>类型</th>
                        <th>操作</th>
					</tr>
				</thead>
				<tbody>
					<notempty name="list">
					<volist name="list" id="config">
						<tr>
							<td>{$config.id}</td>
							<td><a href="{:U('edit?id='.$config['id'])}">{$config.name}</a></td>
							<td>{$config.title}</td>
							<td>{$config.group|get_config_group}</td>
							<td>{$config.type|get_config_type}</td>
                            <td>
                                <a title="删除" href="{:U('del?id='.$config['id'])}" class="ui-pg-div ui-inline confirm ajax-get">
                                    删除
                                </a>
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
                        <a class="btn btn-white" href="{:U('add')}">
                            新增
                        </a>
                    </label>
                    <label>
                        <a class="btn list_sort btn-white" href="{:U('sort?group='.I('group'),'','')}">
                            排序
                        </a>
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
	//搜索功能
	$("#search").click(function(){
		var url = $(this).attr('url');
        var query  = $('.search-form').find('input').serialize();
        query = query.replace(/(&|^)(\w*?\d*?\-*?_*?)*?=?((?=&)|(?=$))/g,'');
        query = query.replace(/^&/g,'');
        if( url.indexOf('?')>0 ){
            url += '&' + query;
        }else{
            url += '?' + query;
        }
		window.location.href = url;
	});
	//回车搜索
	$(".search-input").keyup(function(e){
		if(e.keyCode === 13){
			$("#search").click();
			return false;
		}
	});
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
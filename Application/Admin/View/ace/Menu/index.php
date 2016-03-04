<extend name="Public/base"/>

<block name="body">
     <div class="table-responsive">
        <div class="dataTables_wrapper">  
            
            <div class="row">
                <div class="col-sm-12">
                    <form class="search-form">
                        <label>菜单名称
                            <input type="text" class="search-input" name="title" value="{:I('title')}" placeholder="请输入菜单名称">
                        </label>
                        <label>
                            <button class="btn btn-sm btn-primary" type="button" id="search" url="{:U('index')}">
                               <i class="icon-search"></i>搜索
                            </button>
                        </label>
                    </form>  
                </div>
            </div>
            
            <form class="ids">
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
                        <th>名称</th>
                        <th>上级菜单</th>
                        <th>分组</th>
                        <th>URL</th>
                        <th>排序</th>
                        <th>仅开发者模式显示</th>
                        <th>隐藏</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
				<notempty name="list">
                <volist name="list" id="menu">
                    <tr>
                        <td class="center">
                            <label>
                                <input class="ace ids" type="checkbox" name="id[]" value="{$menu.id}" />
                                <span class="lbl"></span>
                            </label>
                        </td>
                        <td>{$menu.id}</td>
                        <td>
                            <a href="{:U('index?pid='.$menu['id'])}">{$menu.title}</a>
                        </td>
                        <td>{$menu.up_title|default='无'}</td>
                        <td>{$menu.group}</td>
                        <td>{$menu.url}</td>
                        <td>{$menu.sort}</td>
                        <td>
                            <label>
                                <input type="checkbox" class="ace ace-switch ace-switch-5 ajax-get" name="status" value="{$menu.is_dev}" <?=$menu['is_dev'] == '1' ? 'checked' : ''?> url="{:U('toogleDev',array('id'=>$menu['id'],'value'=>abs($menu['is_dev']-1)))}">
                                <span class="lbl"></span>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="checkbox" class="ace ace-switch ace-switch-6 ajax-get" name="status" value="{$menu.hide}" <?=$menu['hide'] == '1' ? '' : 'checked'?> url="{:U('toogleHide',array('id'=>$menu['id'],'value'=>abs($menu['hide']-1)))}">
                                <span class="lbl"></span>
                            </label>
                        </td>
                        <td>
                            <a title="编辑" href="{:U('edit?id='.$menu['id'])}" class="ui-pg-div ui-inline">
                                编辑
                            </a>
                            <a title="删除" href="{:U('del?id='.$menu['id'])}" class="ui-pg-div ui-inline confirm ajax-get">
                                删除
                            </a>
                        </td>
                    </tr>
                </volist>
				<else/>
				<td colspan="10" class="text-center"> aOh! 暂时还没有内容! </td>
				</notempty>
                </tbody>
            </table>
            </form>
            <div class="row">
                <div class="col-sm-12">
                    <label>
                        <a class="btn btn-white" href="{:U('add',array('pid'=>I('get.pid',0)))}">
                            新增
                        </a>
                    </label>
                    <label>
                        <button type="button" class="btn btn-white list_sort" url="{:U('sort',array('pid'=>I('get.pid',0)),'')}">
                            排序
                        </button>
                    </label>
                    <label>
                        <button type="button" class="btn btn-white ajax-post confirm" target-form="ids" url="{:U('del')}">
                            删除
                        </button>
                    </label>
                </div>
            </div>
        </div>
    </div>
</block>

<block name="script">
    <script type="text/javascript">
        $(function() {
            //搜索功能
            $("#search").click(function() {
                var url = $(this).attr('url');
                var query = $('.search-form').serialize();
                query = query.replace(/(&|^)(\w*?\d*?\-*?_*?)*?=?((?=&)|(?=$))/g, '');
                query = query.replace(/^&/g, '');
                if (url.indexOf('?') > 0) {
                    url += '&' + query;
                } else {
                    url += '?' + query;
                }
                window.location.href = url;
            });
            //回车搜索
            $(".search-input").keyup(function(e) {
                if (e.keyCode === 13) {
                    $("#search").click();
                    return false;
                }
            });
            //导航高亮
            highlight_subnav('{:U('index')}');
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
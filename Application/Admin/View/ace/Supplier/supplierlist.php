<extend name="Public/base"/>

<block name="body">
     <div class="table-responsive">
        <div class="dataTables_wrapper">  
            
            <div class="row">
                <div class="col-sm-12">
                    <form class="search-form">
                        <label>
                        	<select type="select" class="search-input" style="height: 35px;margin-right:-3px;" name="">
                        		<option value="">公司名称</option>
                        		<option value="">联系人</option>
                        		<option value="">联系电话</option>
                        	</select>
                            <input type="text" class="search-input" style="height: 35px;margin-left:0px;" name="title" value="{:I('title')}" placeholder="">
                        </label>
                        <label>
                            <button class="btn btn-sm btn-primary" type="button" id="search" url="{:U('index')}">
                               <i class="icon-search"></i>搜索
                            </button>
                        </label>&nbsp;
                         <label>
                            <a class="btn btn-sm btn-primary" href="{:U('add?model='.$model['id'])}"><i class="icon-plus"></i>新增供应商</a>
                        </label>
                    </form> 
                    
                </div>
            </div>
            
            <form class="ids">
            <!-- 数据列表 -->
            <table class="table table-striped table-bordered table-hover dataTable">
                <thead>
                    <tr>
                        <th>供应商名称</th>
                        <th>编号</th>
                        <th>结算周期</th>
                        <th>公司</th>
                        <th>联系人</th>
                        <th>联系电话</th>
                        <th>在线客服</th>
                        <th>是否启用</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
				<notempty name="list">
                <volist name="list" id="menu">
                    <tr>
                        <td><a href="{:U('index?pid='.$menu['id'])}">{$menu.title}</a></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
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

        });
    </script>
</block>
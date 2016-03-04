<extend name="Public/base" />
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
					<th class="">用户组</th>
					<th class="">描述</th>
			
					<th class="">授权</th>
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
                                <input class="ace ids" type="checkbox" name="id[]" value="{$vo.id}" />
                                <span class="lbl"></span>
                            </label>
                        </td>
						<td><a href="{:U('AuthManager/editgroup?id='.$vo['id'])}">{$vo.title}</a> </td>
						<td><span>{:mb_strimwidth($vo['description'],0,60,"...","utf-8")}</span></td>
			
			
						<td>
							<a href="{:U('AuthManager/access?group_name='.$vo['title'].'&group_id='.$vo['id'])}" >访问授权</a>
			                <a href="{:U('AuthManager/category?group_name='.$vo['title'].'&group_id='.$vo['id'])}" >分类授权</a>
							<a href="{:U('AuthManager/user?group_name='.$vo['title'].'&group_id='.$vo['id'])}" >成员授权</a>
						</td>
						<td>{$vo.status_text}</td>
						<td><eq name="vo.status" value="1">
							<a href="{:U('AuthManager/changeStatus?method=forbidGroup&id='.$vo['id'])}" class="ajax-get">禁用</a>
							<else/>
							<a href="{:U('AuthManager/changeStatus?method=resumeGroup&id='.$vo['id'])}" class="ajax-get">启用</a>
							</eq>
							<a href="{:U('AuthManager/changeStatus?method=deleteGroup&id='.$vo['id'])}" class="confirm ajax-get">删除</a>
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
                        <a class="btn btn-white" href="{:U('createGroup')}">
                            新增
                        </a>
                    </label>
                    <label>
                        <button class="btn btn-white ajax-post" target-form="ids" url="{:U('changestatus?method=resumeGroup')}">
                            启 用
                        </button>
                    </label>
                    <label>
                        <button class="btn btn-white ajax-post" target-form="ids" url="{:U('changestatus?method=forbidGroup')}">
                            暂停
                        </button>
                    </label>
                    <label>
                        <button class="btn btn-white ajax-post" target-form="ids" url="{:U('changestatus?method=deleteGroup')}">
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
<script type="text/javascript" charset="utf-8">
    //导航高亮
    highlight_subnav('{:U('AuthManager/index')}');
</script>
</block>
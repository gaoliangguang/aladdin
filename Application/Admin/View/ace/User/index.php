<extend name="Public/base" />

<block name="body">
     <div class="table-responsive">
        <div class="dataTables_wrapper">  
            
            <div class="row">
                <div class="col-sm-12">
                    <div class="search-form">
                        <label>用户昵称或者ID
                            <input type="text" class="search-input" name="nickname" value="{:I('nickname')}" placeholder="请输入用户昵称或者ID">
                        </label>
                        <label>
                            <button class="btn btn-sm btn-primary" type="button" id="search" url="{:U('index')}">
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
                        <th class="row-selected center">
                           <label>
                               <input class="ace check-all" type="checkbox"/>
                               <span class="lbl"></span>
                           </label>
                        </th>
                        <th class="">用户名</th>
                        <th class="">昵称</th>
                        <th class="">登录次数</th>
                        <th class="">最后登录时间</th>
                        <th class="">最后登录IP</th>
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
						<td><a href="{:U('uedit',array('id'=>$vo['id']))}">{$vo.username}</a></td>
						<td>{$vo.nickname}</td>
						<td>{$vo.login}</td>
						<td><span>{$vo.last_login_time|time_format}</span></td>
						<td><span>{:long2ip($vo['last_login_ip'])}</span></td>
						<td>
                            <?php

                            $url = U('User/changeStatus?method=resumeUser&id='.$vo['id']);
                            if($vo['status'] == '1'){
                                $url = U('User/changeStatus?method=forbidUser&id='.$vo['id']);
                            }
                            ?>
                            <label>
                                <input type="checkbox" class="ace ace-switch ace-switch-6 ajax-get no-refresh" name="status" value="{$vo.status}" <?=$vo['status'] == '1' ? 'checked' : ''?> url="<?=$url?>">
                                <span class="lbl"></span>
                            </label>
                        </td>
                        <td>
                            <a title="授权" href="{:U('AuthManager/group?uid='.$vo['id'])}" class="">
                                授权
                            </a>
                            <a title="删除" href="{:U('User/changeStatus?method=deleteUser&id='.$vo['id'])}" class="confirm ajax-get">
                                删除
                            </a>
                        </td>
					</tr>
					</volist>
					<else/>
					<td colspan="9" class="text-center"> aOh! 暂时还没有内容! </td>
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
                        <button type="button" class="btn btn-white ajax-post" target-form="ids" url="{:U('changeStatus?method=resumeUser')}">
                            启 用
                        </button>
                    </label>
                    <label>
                        <button type="button" class="btn btn-white ajax-post" target-form="ids" url="{:U('changeStatus?method=forbidUser')}">
                            暂停
                        </button>
                    </label>
                    <label>
                        <button type="button" class="btn btn-white ajax-post" target-form="ids" url="{:U('changeStatus?method=deleteUser')}">
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
	<script src="__STATIC__/thinkbox/jquery.thinkbox.js"></script>

	<script type="text/javascript">
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
		    console.info($("#search"));
			$("#search").click();
			return false;
		}
	});
    //导航高亮
    highlight_subnav('{:U('User/index')}');
	</script>
</block>

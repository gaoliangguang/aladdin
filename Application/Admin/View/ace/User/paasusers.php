<extend name="Public/base" />

<block name="body">
     <div class="table-responsive">
        <div class="dataTables_wrapper">  
            
            <div class="row">
                <div class="col-sm-12">
                    <form action="<?=U('user/paasusers')?>" method="POST" class="search-form">
                        <label>昵称
                            <input type="text" class="search-input" name="nickname" value="{:I('nickname')}" placeholder="请输入用户昵称">
                        </label>
                        <label>手机号码
                            <input type="text" class="search-input" name="mobile" value="{:I('mobile_num')}" placeholder="请输入用户手机号码">
                        </label>
                        <label>
                            <button class="btn btn-sm btn-primary" type="button" id="search-btn" url="{:U('user/paasusers')}">
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
                        <th class="">手机号码</th>
                        <th class="">昵称</th>
                        <th class="">用户姓名</th>
                        <th class="">邮箱</th>
                        <th class="">注册时间</th>
                        <th class="">状态</th>
					</tr>
			    </thead>
			    <tbody>
					<notempty name="_list">
					<volist name="_list" id="vo">
					<tr>
						<td><a href="{:U('paasuview',array('id'=>$vo['id']))}">{$vo.mobile_num}</a></td>
						<td>{$vo.nick_name}</td>
						<td>{$vo.real_name}</td>
						<td>{$vo.email}</td>
						<td>{$vo.insert_time}</td>
						<td>
                            <label>
                                <input type="checkbox" class="ace ace-switch ace-switch-6 ajax-get" name="status" value="{$vo.status}" <?=$vo['status'] == 'OK#' ? 'checked' : ''?> url="<?=U('changePuStatus',['id'=>$vo['id'],'status'=>$vo['status']])?>">
                                <span class="lbl"></span>
                            </label>
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
    //导航高亮
    highlight_subnav('{:U('User/paasusers')}');
	</script>
</block>

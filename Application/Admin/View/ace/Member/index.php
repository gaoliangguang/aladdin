<extend name="Public/base" />

<block name="body">
     <div class="table-responsive">
        <div class="dataTables_wrapper">  
            
            <div class="row">
                <div class="col-sm-12">
                    <form action="<?=U('Member/index')?>" method="POST" class="search-form">
                        <label>昵称
                            <input type="text" class="search-input" name="nickname" value="{:I('nickname')}" placeholder="请输入用户昵称">
                        </label>
                        <label>手机号码
                            <input type="text" class="search-input" name="mobile" value="{:I('mobile_num')}" placeholder="请输入用户手机号码">
                        </label>
                        <label>
                            <select type="select" class="search-input" name="sort">
                            	<option selected value='all'>全部</option>
                            	<option value='golden' >金牌用户</option>
                            	<option value='source'>推广渠道</option>
                            </select>
                        </label>
                        <label>
                            <button class="btn btn-sm btn-primary" type="button" id="search-btn" url="{:U('Member/index')}">
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
                        <th class="">头像</th>
                        <th class="">昵称</th>
                        <th class="">手机号</th>
                        <th class="">加入时间</th>
                        <th class="">来源</th>
                        <th class="">位置</th>
                        <th class="">操作</th>
					</tr>
			    </thead>
			    <tbody>
					<notempty name="_list">
					<volist name="_list" id="vo">
					<tr>
						<td><img src="{$vo.head_image}" /></td>
						<td>{$vo.nick_name}</td>
						<td>{$vo.mobile_num}</td>
						<td>{$vo.insert_time}</td>
						<td>{$vo.userSource}</td>
						<td>{$vo.position}</td>
						<td>
                            <a title="详情" class="ui-pg-div ui-inline btn-detail" data-id="{$vo.id}" >
                                详情
                            </a>
                            <a title="团队" href="" class="ui-pg-div ui-inline confirm ajax-get">
                                团队
                            </a>
                             <a title="订单" href="" class="ui-pg-div ui-inline confirm ajax-get">
                                订单
                            </a>
                        </td>
                        
					</tr>
					<tr class="detail-{$vo.id}" >
					<td colspan="7">
					<div id="user-profile-1" class="user-profile row">
						<div style="float:right;margin-right:20px;">
							<a title="关闭" class="ui-pg-div ui-inline btn-close" data-id="{$vo.id}">
	                                                               关闭
	                        </a>
                        </div>
					    <div class="col-xs-12 col-sm-3 center">
					        <div>
					            <span class="profile-picture">
					                <img width="180" src="" class="editable img-responsive editable-click editable-empty" id="avatar" />
					            </span>
					            <div><span>{$vo.user_name}</span></div>
					            <div class="width-80 label label-info label-xlg arrowed-in arrowed-in-right">
					                <div class="inline position-relative">
					                    <a href="#" class="user-title-label dropdown-toggle" data-toggle="dropdown">
					                        <i class="icon-circle light-green middle"></i>
					                        &nbsp;
					                        <span class="white">更新微信资料</span>
					                    </a>
					                    
					                </div>
					                
					            </div><br/><br/>
					            <div class="width-80 label label-info label-xlg arrowed-in arrowed-in-right">
					                <div class="inline position-relative">
					                    <a href="#" class="user-title-label dropdown-toggle" data-toggle="dropdown">
					                        <i class="icon-circle light-green middle"></i>
					                        &nbsp;
					                        <span class="white">更新消费金额</span>
					                    </a>
					                    
					                </div>
					                
					            </div>
					        </div>
					
					        <div class="space-6"></div>
					
					        <div class="hr hr12 dotted"></div>
					    </div>
					
					    <div class="col-xs-12 col-sm-9">
					
					        <div class="profile-user-info profile-user-info-striped">
					        	
					        	<div class="profile-info-row">
					                <div class="profile-info-name"> 昵称 </div>
					
					                <div class="profile-info-value">
					                    <span class="editable">{$vo.nick_name}&nbsp;</span>
					                </div>
					            </div>
					        
					            <div class="profile-info-row">
					                <div class="profile-info-name"> 手机号码</div>
					
					                <div class="profile-info-value">
					                    <span class="editable">{$vo.mobile_num}&nbsp;</span>
					                </div>
					            </div>
					
					            <div class="profile-info-row">
					                <div class="profile-info-name"> 加入时间 </div>
					
					                <div class="profile-info-value">
					                    <span class="editable">{$vo.insert_time}&nbsp;</span>
					                </div>
					            </div>
					
					            <div class="profile-info-row">
					                <div class="profile-info-name"> 来源 </div>
					
					                <div class="profile-info-value">
					                    <span class="editable">&nbsp;</span>
					                </div>
					            </div>
					
					            <div class="profile-info-row">
					                <div class="profile-info-name"> 标识 </div>
					
					                <div class="profile-info-value">
					                    <i class="icon-email light-orange bigger-110"></i>
					                    &nbsp;
					                </div>
					            </div>
					
					            <div class="profile-info-row">
					                <div class="profile-info-name"> 微信openid </div>
					
					                <div class="profile-info-value">
					                    <i class="icon-email light-orange bigger-110"></i>
					                    <span class="editable"></span>
					                </div>
					            </div>
					            
					            <div class="profile-info-row">
					                <div class="profile-info-name"> 推荐人 </div>
					
					                <div class="profile-info-value">
					                    <i class="icon-email light-orange bigger-110"></i>
					                    &nbsp;
					                </div>
					            </div>
					
					            <div class="profile-info-row">
					                <div class="profile-info-name"> 消费金额 </div>
					
					                <div class="profile-info-value">
					                    <span class="editable">￥&nbsp;</span>
					                </div>
					            </div>
					
					            <div class="profile-info-row">
					                <div class="profile-info-name"> 账户余额 </div>
					
					                <div class="profile-info-value">
					                    <span class="editable">￥&nbsp;</span>
					                </div>
					            </div>
					
					            <div class="profile-info-row">
					                <div class="profile-info-name"> 账户冻结资金 </div>
					                <div class="profile-info-value">
					                                             ￥&nbsp;
					                </div>
					            </div>
							
					        </div>
					
					    </div>
					</div>
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
	<script>
		$(function(){
			$("[class^=detail-]").hide();
		});
		
		$(".btn-detail").click(function(){
			
			var id = $(this).data('id');
			$(".detail-"+id).toggle(1000);

			var tr = $(".detail-"+id).get(0);
			$("[class^=detail-]").each(function(index,item){
				if(tr!=item){
					$(item).hide();
				}
			});
				
		});
				
		$(".btn-close").click(function(){
				var id = $(this).data('id');
				$(".detail-"+id).toggle(1000);
			});
	</script>
	
</block>

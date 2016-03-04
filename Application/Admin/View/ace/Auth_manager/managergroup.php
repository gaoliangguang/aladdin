<!-- 管理员用户组新增和编辑页面 -->
<extend name="Public/base" />
<block name="body">
<div class="tabbable">
    <ul class="nav nav-tabs padding-18">
        <li class="active"><a href="javascript:;">访问授权</a></li>
        <li><a href="{:U('AuthManager/category',array('group_name'=>I('group_name') ,'group_id'=> I('group_id')))}">分类授权</a></li>
        <li><a href="{:U('AuthManager/user',array('group_name'=>I('group_name') ,'group_id'=> I('group_id')))}">成员授权</a></li>
        <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">分组 &nbsp;
                <i class="icon-caret-down bigger-110 width-auto"></i>
            </a>
            <ul class="dropdown-menu dropdown-info">
                <volist name="auth_group" id="vo">
	                <li <eq name="vo['id']" value="$this_group['id']">class="active"</eq>>
	                    <a data-toggle="tab" href="{:U('AuthManager/access',array('group_id'=>$vo['id'],'group_name'=>$vo['title']))}">{$vo.title}</a>
	                </li>
                </volist>
            </ul>
        </li>
    </ul>
    <div class="tab-content no-border padding-24">
		<!-- 访问授权 -->
        <div class="tab-pane active">
			<form action="{:U('AuthManager/writeGroup')}" enctype="application/x-www-form-urlencoded" method="POST" class="form-horizontal auth-form">
	            <div id="accordion" class="accordion-style1 panel-group">
				<volist name="node_list" id="node" >
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseOne{$node.id}">
                                    <i class="icon-angle-right bigger-110" data-icon-hide="icon-angle-down" data-icon-show="icon-angle-right"></i>
                                    &nbsp; {$node.title}
                                </a>
                            </h4>
                        </div>

                        <div class="panel-collapse collapse" id="collapseOne{$node.id}">
                            <div class="panel-body">
                                <div>
	                                <label class="inline">
	                                    <input class="auth_rules rules_all ace" type="checkbox" name="rules[]" value="<?php echo $main_rules[$node['url']] ?>">
	                                    <span class="lbl"> {$node.title}</span>
	                                </label>
                                </div>
                                <present name="node['child']">
	                            <volist name="node['child']" id="child" >
	                               <div class="rule_check" style="padding-left: 20px;">
	                                   <div>
	                                       <label class="" data-rel="tooltip" data-original-title="{$child.tip}">
	                                           <input class="auth_rules rules_row ace" type="checkbox" name="rules[]" value="<?php echo $auth_rules[$child['url']] ?>"/>
	                                           <span class="lbl"> {$child.title}</span> 
	                                       </label>
	                                   </div>
			                            <notempty name="child['operator']">
			                                <div class="child_row" style="padding-left: 40px;">
			                                    <volist name="child['operator']" id="op">
			                                        <label class="inline" data-rel="tooltip" data-original-title='{$op.tip}'>
			                                            <input class="auth_rules ace" type="checkbox" name="rules[]" value="<?php echo $auth_rules[$op['url']] ?>"/>
			                                            <span class="lbl"> {$op.title}</span> &nbsp;
			                                        </label>
			                                    </volist>
			                                </div>
			                            </notempty>
	                                </div>
	                            </volist>
	                            </present>
                            </div>
                        </div>
                    </div>
				</volist>
                </div>

		        <input type="hidden" name="id" value="{$this_group.id}" />

                <?=ace_srbtn()?>
		    </form>
		</div>
	</div>
</div>

</block>
<block name="script">
<script type="text/javascript" src="__STATIC__/qtip/jquery.qtip.min.js"></script>
<link rel="stylesheet" type="text/css" href="__STATIC__/qtip/jquery.qtip.min.css" media="all">
<script type="text/javascript" charset="utf-8">
    +function($){
        var rules = [{$this_group.rules}];
        $('.auth_rules').each(function(){
            if( $.inArray( parseInt(this.value,10),rules )>-1 ){
                
                $(this).prop('checked',true).closest('.panel-collapse').addClass('in').prev().find('.accordion-toggle').removeClass('collapsed');
            }
            if(this.value==''){
                $(this).closest('span').remove();
            }
        });

        $('[data-rel=tooltip]').tooltip();
        //全选节点
        $('.rules_all').on('change',function(){
            $(this).closest('.panel-body').find('input').prop('checked',this.checked);
        });
        $('.rules_row').on('change',function(){
            $(this).closest('.rule_check').find('.child_row').find('input').prop('checked',this.checked);
        });

        $('.dropdown-menu a').click(function(){
			location.href = this.href;
			return false;
        });
        //导航高亮
        highlight_subnav('{:U('AuthManager/index')}');
    }(jQuery);
</script>
</block>

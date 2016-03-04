<extend name="Public/base" />

<block name="body">
	<div class="form-horizontal">
		<!-- 基础 -->
		
    <?php 
        echo ace_group(ace_label('行为名称'),'<div class="line-height-2 blue">'.get_action($info['action_id'], "title").'</div>');
        echo ace_group(ace_label('执行者'),'<div class="line-height-2 blue">'.get_nickname($info['user_id']).'</div>');
        echo ace_group(ace_label('执行IP'),'<div class="line-height-2 blue">'.long2ip($info['action_ip']).'</div>');
        echo ace_group(ace_label('执行时间'),'<div class="line-height-2 blue">'.date('Y-m-d H:i:s',$info['create_time']).'</div>');
        echo ace_textarea(array('label_text'=>'备注'),'',$info['remark']);
    ?>
		<!-- 按钮 -->
		<div class="clearfix form-actions">
             <div class="col-xs-12">
                 <a onclick="history.go(-1)" class="btn btn-white" href="javascript:;">
	                返回上一页
	             </a>  
             </div>
         </div>
	</div>
</block>
<block name="script">
<script type="text/javascript" charset="utf-8">
//导航高亮
highlight_subnav('{:U('Action/actionlog')}');

</script>
</block>


<extend name="Public/base"/>

<block name="body">
<script type="text/javascript" src="__STATIC__/uploadify/jquery.uploadify.min.js"></script>
	
<div class="tabbable">
	<ul class="nav nav-tabs">
		<li class="active">
			<a data-toggle="tab" href="#home">
				<i class="green icon-home bigger-110"></i>
				基 础
			</a>
		</li>
	</ul>
    <form action="{:U()}" method="post" class="form-horizontal">
	<div class="tab-content">
		<div id="home" class="tab-pane in active">
		    <div class="form-group">
				<label class="col-xs-12 col-sm-2 control-label no-padding-right">上级分类</label>
				<div class="col-xs-12 col-sm-6">
					<input type="text" class="width-100" disabled="disabled" value="{$category['name']|default='无'}"/>
				</div>
				<span class="check-tips"></span>
			</div>
			<div class="form-group">
				<label class="col-xs-12 col-sm-2 control-label no-padding-right">
					分类名称
				</label>
				<div class="col-xs-12 col-sm-6">
					<input type="text" name="name" class="width-100" value="{$info.name|default=''}">
				</div>
				<span class="check-tips">（名称不能为空）</span>
			</div>

			<div class="form-group">
				<label class="col-xs-12 col-sm-2 control-label no-padding-right">分组描述</label>
				<div class="col-xs-12 col-sm-6">
					<textarea name="description" class="form-control">{$info.description|default=''}</textarea>
				</div>
			</div>


		</div>
        <input type="hidden" name="id" value="{$info.id|default=''}">
        <input type="hidden" name="parent_id" value="{:isset($category['id'])?$category['id']:$info['parent_id']}">
        <input type="hidden" name="category" value="{:isset($category['category'])?$category['category']:$info['category']}">
        <input type="hidden" name="status" value="{$info.status|default='OK#'}">
        <?=ace_srbtn()?>
	</div>
    </form>
</div>	
</block>

<block name="script">
	<script type="text/javascript">
		<present name="info.id">
		Think.setValue("allow_publish", {$info.allow_publish|default=1});
		Think.setValue("check", {$info.check|default=0});
		Think.setValue("model[]", {$info.model|json_encode} || [1]);
		Think.setValue("model_sub[]", {$info.model_sub|json_encode} || [1]);
		Think.setValue("type[]", {$info.type|json_encode} || [2]);
		Think.setValue("display", {$info.display|default=1});
		Think.setValue("reply", {$info.reply|default=0});
		Think.setValue("reply_model[]", {$info.reply_model|json_encode} || [1]);
		</present>
		$(function(){
			showTab();
			$("input[name=reply]").change(function(){
				var $reply = $(".form-group.reply");
				parseInt(this.value) ? $reply.show() : $reply.hide();
			}).filter(":checked").change();
		});
		//导航高亮
		highlight_subnav('{:U('config/category')}');
	</script>
</block>

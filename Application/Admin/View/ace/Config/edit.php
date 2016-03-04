<extend name="Public/base"/>

<block name="body">
	<form action="{:U()}" method="post" class="form-horizontal">
		<div class="form-group">
			<label class="col-xs-12 col-sm-2 control-label no-padding-right">配置标识</label>
			<div class="col-xs-12 col-sm-5">
				<input type="text" class="width-100 input-large" name="name" value="{$info.name|default=''}">
			</div>
			<div class="help-block col-xs-12 col-sm-reset inline">（用于C函数调用，只能使用英文且不能重复）</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-2 control-label no-padding-right">配置标题</label>
			<div class="col-xs-12 col-sm-5">
				<input type="text" class="width-100 input-large" name="title" value="{$info.title|default=''}">
			</div>
			<div class="help-block col-xs-12 col-sm-reset inline">（用于后台显示的配置标题）</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-2 control-label no-padding-right">排序</label>
			<div class="col-xs-12 col-sm-5">
				<input type="text" class="width-100 input-small" name="sort" value="{$info.sort|default=0}">
			</div>
			<div class="help-block col-xs-12 col-sm-reset inline">（用于分组显示的顺序）</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-2 control-label no-padding-right">配置类型</label>
			<div class="col-xs-12 col-sm-5">
				<select name="type">
					<volist name="Think.config.CONFIG_TYPE_LIST" id="type">
						<option value="{$key}">{$type}</option>
					</volist>
				</select>
			</div>
			<div class="help-block col-xs-12 col-sm-reset inline">（系统会根据不同类型解析配置值）</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-2 control-label no-padding-right">配置分组</label>
			<div class="col-xs-12 col-sm-5">
				<select name="group">
					<option value="0">不分组</option>
					<volist name="Think.config.CONFIG_GROUP_LIST" id="group">
						<option value="{$key}">{$group}</option>
					</volist>
				</select>
			</div>
			<div class="help-block col-xs-12 col-sm-reset inline">（配置分组 用于批量设置 不分组则不会显示在系统设置中）</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-2 control-label no-padding-right">配置值</label>
			<div class="col-xs-12 col-sm-5">
				<textarea name="value" class="autosize-transition span12 form-control" cols="40">{$info.value|default=''}</textarea>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-2 control-label no-padding-right">配置项</label>
			<div class="col-xs-12 col-sm-5">
				<textarea name="extra" class="autosize-transition span12 form-control" cols="40">{$info.extra|default=''}</textarea>
			</div>
			<div class="help-block col-xs-12 col-sm-reset inline">（如果是枚举型 需要配置该项）</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-2 control-label no-padding-right">说明</label>
			<div class="col-xs-12 col-sm-5">
				<textarea name="remark" class="autosize-transition span12 form-control" rows="" cols="40">{$info.remark|default=''}</textarea>
			</div>
			<div class="help-block col-xs-12 col-sm-reset inline">（配置详细说明）</div>
		</div>
        <input type="hidden" name="id" value="{$info.id|default=''}">

        <?=ace_srbtn()?>
	</form>
</block>

<block name="script">
	<script type="text/javascript">
		Think.setValue("type", {$info.type|default=0});
		Think.setValue("group", {$info.group|default=0});
		//导航高亮
		highlight_subnav('{:U('Config/index')}');
	</script>
</block>

<extend name="Public/base" />

<block name="body">
	<!-- 表单 -->
	<form id="form" action="{:U('saveAction')}" method="post" class="form-horizontal">
		<div class="form-group">
			<label class="col-xs-12 col-sm-2 control-label no-padding-right">行为标识</label>
			<div class="col-xs-12 col-sm-5">
				<input type="text" class="width-100" name="name" value="{$data.name}">
			</div>
			<span class="help-block col-xs-12 col-sm-5 inline">（输入行为标识 英文字母）</span>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-2 control-label no-padding-right">行为名称</label>
			<div class="col-xs-12 col-sm-5">
				<input type="text" class="width-100" name="title" value="{$data.title}">
			</div>
			<span class="help-block col-xs-12 col-sm-5 inline">（输入行为名称）</span>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-2 control-label no-padding-right">行为类型</label>
			<div class="col-xs-12 col-sm-5">
				<select name="type">
					<volist name=":get_action_type(null,true)" id="vo">
						<option value="{$key}">{$vo}</option>
					</volist>
				</select>
			</div>
			<span class="help-block col-xs-12 col-sm-5 inline">（选择行为类型）</span>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-2 control-label no-padding-right">行为描述</label>
			<div class="col-xs-12 col-sm-5">
				<textarea name="remark" class="autosize-transition span12 form-control">{$data.remark}</textarea>
			</div>
			<span class="help-block col-xs-12 col-sm-5 inline">（输入行为描述）</span>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-2 control-label no-padding-right">行为规则</label>
			<div class="col-xs-12 col-sm-5">
				<textarea name="rule" class="autosize-transition span12 form-control">{$data.rule}</textarea>
			</div>
			<span class="help-block col-xs-12 col-sm-5 inline">（输入行为规则，不写则只记录日志）</span>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-2 control-label no-padding-right">日志规则</label>
			<div class="col-xs-12 col-sm-5">
				<textarea name="log" class="autosize-transition span12 form-control">{$data.log}</textarea>
			</div>
			<div class="help-block col-xs-12 col-sm-5 inline">（记录日志备注时按此规则来生成，支持[变量|函数]。目前变量有：user,time,model,record,data）</div>
		</div>

        <input type="hidden" name="id" value="{$data.id}"/>

        <?=ace_srbtn()?>
	</form>
</block>

<block name="script">
<script type="text/javascript" src="__STATIC__/uploadify/jquery.uploadify.min.js"></script>
<script type="text/javascript" charset="utf-8">
	Think.setValue('type',{$type|default=1});
    //导航高亮
    highlight_subnav('{:U('User/action')}');
</script>
</block>

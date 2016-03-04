<extend name="Public/base"/>

<block name="body">
	<form action="{:U()}" method="post" class="form-horizontal">
		<input type="hidden" name="pid" value="{$pid}">
		<div class="form-group">
			<label class="col-xs-12 col-sm-2 control-label no-padding-right">导航标题</label>
			<div class="col-xs-12 col-sm-5">
				<input type="text" class="width-100" name="title" value="{$info.title|default=''}">
			</div>
			<span class="help-block col-xs-12 col-sm-reset inline">（用于显示的文字）</span>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-2 control-label no-padding-right">导航连接</label>
			<div class="col-xs-12 col-sm-5">
				<input type="text" class="width-100" name="url" value="{$info.url|default=''}">
			</div>
			<span class="help-block col-xs-12 col-sm-reset inline">（用于调转的URL，支持带http://的URL或U函数参数格式）</span>
		</div>
        <div class="form-group">
            <label class="col-xs-12 col-sm-2 control-label no-padding-right">新窗口打开</label>
            <div class="col-xs-12 col-sm-5">
                <select name="target">
				<option value="0" <eq name="info.target" value="0" >selected</eq>>否</option>
				<option value="1" <eq name="info.target" value="1" >selected</eq>>是</option>
                </select>
            </div>
            <span class="help-block col-xs-12 col-sm-reset inline">（是否新窗口打开链接）</span>
        </div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-2 control-label no-padding-right">优先级</label>
			<div class="col-xs-12 col-sm-5">
				<input type="text" class="width-100" name="sort" value="{$info.sort|default='0'}">
			</div>
			<span class="help-block col-xs-12 col-sm-reset inline">（导航显示顺序）</span>
		</div>
		<!-- 按钮 -->
        <input type="hidden" name="id" value="{$info.id|default=''}">

        <?=ace_srbtn()?>
	</form>
</block>
<block name="script">
<script type="text/javascript" charset="utf-8">
	//导航高亮
	highlight_subnav('{:U('index')}');
</script>
</block>

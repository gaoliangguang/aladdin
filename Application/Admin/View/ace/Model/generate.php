<extend name="Public/base" />

<block name="body">

	<!-- 表单 -->
	<form id="form" action="{:U('generate')}" method="post" class="form-horizontal doc-modal-form">
		<!-- 基础 -->
		<div id="tab1" class="tab-pane in tab1">
			<div class="form-item cf">
				<label class="item-label">数据表<span class="check-tips">（当前数据库的所有表）</span></label>
				<div class="controls">
					<select name="table">
						<volist name="tables" id="tb">
							<option value="{$tb}">{$tb}</option>
						</volist>
					</select>
				</div>
			</div>
			<div class="form-item cf">
				<label class="item-label">模型标识<span class="check-tips">（模型英文标识）</span></label>
				<div class="controls">
					<input type="text" class="text " name="name" value="">
				</div>
			</div>
			<div class="form-item cf">
				<label class="item-label">模型名称<span class="check-tips">（模型名称）</span></label>
				<div class="controls">
					<input type="text" class="text " name="title" value="">
				</div>
			</div>
		</div>

		<!-- 按钮 -->
		<div class="form-item cf">
			<label class="item-label"></label>
			<div class="controls edit_sort_btn">
				<input type="hidden" name="id" value="{$id}"/>
				<button class="btn btn-success submit-btn ajax-post no-refresh" type="submit" target-form="form-horizontal">
				    <i class="icon-ok bigger-110"></i>生 成
				</button>
				<button class="btn btn-info btn-return" onclick="javascript:history.back(-1);return false;">
				    <i class="icon-reply"></i>返 回
				</button>
			</div>
		</div>
	</form>
</block>
<block name="script">
<script type="text/javascript" charset="utf-8">
    //导航高亮
    highlight_subnav('{:U('Model/index')}');
</script>
</block>


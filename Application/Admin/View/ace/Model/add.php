<extend name="Public/base" />

<block name="body">
	<!-- 标签页导航 -->
	<!-- 表单 -->
	<form id="form" action="{:U('update')}" method="post" class="form-horizontal doc-modal-form">
		<!-- 基础 -->
		<div class="form-group">
			<label class="col-xs-12 col-sm-2 control-label no-padding-right">模型标识</label>
			<div class="col-xs-12 col-sm-5">
				<input type="text" class="width-100 " name="name" value="">
			</div>
			<span class="help-block col-xs-12 col-sm-reset inline">（请输入文档模型标识）</span>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-2 control-label no-padding-right">模型名称</label>
			<div class="col-xs-12 col-sm-5">
				<input type="text" class="width-100 " name="title" value="">
			</div>
			<span class="help-block col-xs-12 col-sm-reset inline">（请输入模型的名称）</span>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-2 control-label no-padding-right">模型类型</label>
			<div class="col-xs-12 col-sm-5">
				<select name="extend">
					<option value="0">独立模型</option>
					<option value="1">文档模型</option>
				</select>
			</div>
			<span class="help-block col-xs-12 col-sm-reset inline">（目前只支持独立模型和文档模型）</span>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-2 control-label no-padding-right">引擎类型</label>
			<div class="col-xs-12 col-sm-5">
				<select name="engine_type">
					<option value="MyISAM">MyISAM</option>
					<option value="InnoDB">InnoDB</option>
                    <option value="MEMORY">MEMORY</option>
                    <option value="BLACKHOLE">BLACKHOLE</option>
                    <option value="MRG_MYISAM">MRG_MYISAM</option>
                    <option value="ARCHIVE">ARCHIVE</option>
				</select>
			</div>
			<span class="help-block col-xs-12 col-sm-reset inline"></span>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-2 control-label no-padding-right">是否需要主键</label>
			<div class="col-xs-12 col-sm-5">
				<select name="need_pk">
					<option value="1" selected="selected">是</option>
					<option value="0">否</option>
				</select>
			</div>
			<span class="help-block col-xs-12 col-sm-reset inline">（选“是”则会新建默认的id字段作为主键）</span>
		</div>

		<div class="clearfix form-actions">
            <div class="col-xs-12 center">
                <button type="submit" target-form="form-horizontal" class="btn btn-success ajax-post no-refresh" id="sub-btn">
                  <i class="icon-ok bigger-110"></i> 确认保存
                </button> <button type="reset" class="btn" id="reset-btn">
                  <i class="icon-undo bigger-110"></i> 重置
                </button>	  
                <a onclick="history.go(-1)" class="btn btn-info" href="javascript:;">
                 <i class="icon-reply"></i>返回上一页
                </a>	
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


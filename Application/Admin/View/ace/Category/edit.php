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

		<li>
			<a data-toggle="tab" href="#profile">
			    <i class="green icon-external-link bigger-110"></i>
				高 级
			</a>
		</li>

	</ul>
    <form action="{:U()}" method="post" class="form-horizontal">
	<div class="tab-content">
		<div id="home" class="tab-pane in active">
		    <div class="form-group">
				<label class="col-xs-12 col-sm-2 control-label no-padding-right">上级分类</label>
				<div class="col-xs-12 col-sm-6">
					<input type="text" class="width-100" disabled="disabled" value="{$category['title']|default='无'}"/>
				</div>
				<span class="check-tips"></span>
			</div>
			<div class="form-group">
				<label class="col-xs-12 col-sm-2 control-label no-padding-right">
					分类名称
				</label>
				<div class="col-xs-12 col-sm-6">
					<input type="text" name="title" class="width-100" value="{$info.title|default=''}">
				</div>
				<span class="check-tips">（名称不能为空）</span>
			</div>
			<div class="form-group">
				<label class="col-xs-12 col-sm-2 control-label no-padding-right">
					分类标识
				</label>
				<div class="col-xs-12 col-sm-6">
					<input type="text" name="name" class="width-100" value="{$info.name|default=''}">
				</div>
				<span class="check-tips">（英文字母）</span>
			</div>
			<div class="form-group">
				<label class="col-xs-12 col-sm-2 control-label no-padding-right">分组定义</label>
				<div class="col-xs-12 col-sm-6">
					<textarea name="groups" class="form-control">{$info.groups|default=''}</textarea>
				</div>
			</div>
			<div class="form-group">
				<label class="col-xs-12 col-sm-2 control-label no-padding-right">
					发布内容
				</label>
				<div class="col-xs-12 col-sm-6">
					<label><input type="radio" class="ace" name="allow_publish" value="0"><span class="lbl">不允许&nbsp;</span></label>
					<label><input type="radio" class="ace" name="allow_publish" value="1" checked><span class="lbl">仅允许后台&nbsp;</span></label>
					<label><input type="radio" class="ace" name="allow_publish" value="2" ><span class="lbl">允许前后台&nbsp;</span></label>
				</div>
				<span class="check-tips">（是否允许发布内容）</span>
			</div>
			<div class="form-group">
				<label class="col-xs-12 col-sm-2 control-label no-padding-right">
					是否审核
				</label>
				<div class="col-xs-12 col-sm-6">
					<label><input type="radio" class="ace" name="check" value="0" checked><span class="lbl">不需要&nbsp;</span></label>
					<label><input type="radio" class="ace" name="check" value="1"><span class="lbl">需要&nbsp;</span></label>
				</div>
				<span class="check-tips">（在该分类下发布的内容是否需要审核）</span>
			</div>
			<div class="form-group">
				<label class="col-xs-12 col-sm-2 control-label no-padding-right">允许文档类型</label>
				<div class="col-xs-12 col-sm-6">
					<volist name=":C('DOCUMENT_MODEL_TYPE')" id="type">
						<label>
							<input type="checkbox" class="ace" name="type[]" value="{$key}"><span class="lbl"> {$type}&nbsp;</span>
						</label>
					</volist>
				</div>
			</div>
			<div class="form-group">
				<label class="col-xs-12 col-sm-2 control-label no-padding-right">列表绑定文档模型</label>
				<div class="col-xs-12 col-sm-6">
					<volist name=":get_document_model()" id="list">
						<label>
							<input type="checkbox" class="ace" name="model[]" value="{$list.id}"><span class="lbl"> {$list.title}&nbsp;</span>
						</label>
					</volist>
				</div>
				<span class="check-tips">（列表支持发布的文档模型）</span>
			</div>
			<div class="form-group">
				<label class="col-xs-12 col-sm-2 control-label no-padding-right">子文档绑定绑定模型</label>
				<div class="col-xs-12 col-sm-6">
					<volist name=":get_document_model()" id="list">
						<label>
							<input type="checkbox" class="ace" name="model_sub[]" value="{$list.id}"><span class="lbl"> {$list.title}&nbsp;</span>
						</label>
					</volist>
				</div>
				<span class="check-tips">（子文档支持发布的文档模型）</span>
			</div>
			<div class="form-group">
				<label class="col-xs-12 col-sm-2 control-label no-padding-right">分类图标</label>
				<div class="col-xs-12 col-sm-6">
    				<input type="file" id="upload_picture">
    				<input type="hidden" name="icon" id="icon" value="{$info['icon']|default=''}"/>
    				<div class="upload-img-box">
        				<notempty name="info['icon']">
        					<div class="upload-pre-item"><img src="{$info.icon|get_cover='path'}"/></div>
        				</notempty>
    				</div>
				</div>
			</div>
			<script type="text/javascript">
			//上传图片
		    /* 初始化上传插件 */
			$("#upload_picture").uploadify({
		        "height"          : 30,
		        "swf"             : "__STATIC__/uploadify/uploadify.swf",
		        "fileObjName"     : "download",
		        "buttonText"      : "上传图片",
		        "uploader"        : "{:U('File/uploadPicture',array('session_id'=>session_id()))}",
		        "width"           : 120,
		        'removeTimeout'	  : 1,
		        'fileTypeExts'	  : '*.jpg; *.png; *.gif;',
		        "onUploadSuccess" : uploadPicture,
		        'onFallback' : function() {
		            alert('未检测到兼容版本的Flash.');
		        }
		    });
			function uploadPicture(file, data){
		    	var data = $.parseJSON(data);
		    	var src = '';
		        if(data.status){
		        	$("#icon").val(data.id);
		        	src = data.url || '__ROOT__' + data.path;
		        	$("#icon").parent().find('.upload-img-box').html(
		        		'<div class="upload-pre-item"><img src="' + src + '"/></div>'
		        	);
		        } else {
		        	updateAlert(data.info);
		        	setTimeout(function(){
		                $('#top-alert').find('button').click();
		                $(that).removeClass('disabled').prop('disabled',false);
		            },1500);
		        }
		    }
			</script>
		</div>

		<div id="profile" class="tab-pane">
			
            <div class="form-group">
				<label class="col-xs-12 col-sm-2 control-label no-padding-right">可见性</label>
				<div class="col-xs-12 col-sm-6">
					<select name="display">
						<option value="1">所有人可见</option>
						<option value="0">不可见</option>
						<option value="2">管理员可见</option>
					</select>
				</div>
				<span class="check-tips">（是否对用户可见，针对前台）</span>
			</div>
			<div class="form-group">
				<label class="col-xs-12 col-sm-2 control-label no-padding-right">
					排序
				</label>
				<div class="col-xs-12 col-sm-6">
					<input type="text" name="sort" class="col-xs-3" value="{$info.sort|default=0}">
				</div>
				<span class="check-tips">（仅对当前层级分类有效）</span>
			</div>
			<div class="form-group">
				<label class="col-xs-12 col-sm-2 control-label no-padding-right">
					列表行数
				</label>
				<div class="col-xs-12 col-sm-6">
					<input type="text" name="list_row" class="col-xs-3" value="{$info.list_row|default=10}">
				</div>
			</div>

			<div class="form-group">
				<label class="col-xs-12 col-sm-2 control-label no-padding-right">网页标题</label>
				<div class="col-xs-12 col-sm-6">
					<input type="text" name="meta_title" class="width-100" value="{$info.meta_title|default=''}">
				</div>
			</div>
			<div class="form-group">
				<label class="col-xs-12 col-sm-2 control-label no-padding-right">关键字</label>
				<div class="col-xs-12 col-sm-6">
					<textarea name="keywords" class="form-control">{$info.keywords|default=''}</textarea>
				</div>
			</div>
			<div class="form-group">
				<label class="col-xs-12 col-sm-2 control-label no-padding-right">描述</label>
				<div class="col-xs-12 col-sm-6">
					<textarea name="description" class="form-control">{$info.description|default=''}</textarea>
				</div>
			</div>
			<div class="form-group">
				<label class="col-xs-12 col-sm-2 control-label no-padding-right">频道模板</label>
				<div class="col-xs-12 col-sm-6">
					<input type="text" name="template_index" class="width-100" value="{$info.template_index|default=''}">
				</div>
			</div>
			<div class="form-group">
				<label class="col-xs-12 col-sm-2 control-label no-padding-right">列表模板</label>
				<div class="col-xs-12 col-sm-6">
					<input type="text" name="template_lists" class="width-100" value="{$info.template_lists|default=''}">
				</div>
			</div>
			<div class="form-group">
				<label class="col-xs-12 col-sm-2 control-label no-padding-right">详情模板</label>
				<div class="col-xs-12 col-sm-6">
					<input type="text" name="template_detail" class="width-100" value="{$info.template_detail|default=''}">
				</div>
			</div>
			<div class="form-group">
				<label class="col-xs-12 col-sm-2 control-label no-padding-right">编辑模板</label>
				<div class="col-xs-12 col-sm-6">
					<input type="text" name="template_edit" class="width-100" value="{$info.template_edit|default=''}">
				</div>
			</div>
		</div>
        <input type="hidden" name="id" value="{$info.id|default=''}">
        <input type="hidden" name="pid" value="{:isset($category['id'])?$category['id']:$info['pid']}">
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
		highlight_subnav('{:U('Category/index')}');
	</script>
</block>

<extend name="Public/base" />
<block name="style">
	<link rel="stylesheet" href="__JS__/codemirror/codemirror.css">
	<link rel="stylesheet" href="__JS__/codemirror/theme/{:C('codemirror_theme')}.css">
	<style>
		.CodeMirror,#preview_window{
			width:700px;
			height:500px;
		}
		#preview_window.loading{
			background: url('__STATIC__/thinkbox/skin/default/tips_loading.gif') no-repeat center;
		}

		#preview_window textarea{
			display: none;
		}
	</style>
</block>
<block name="body">
	<!-- 表单 -->
	<form id="form" action="{:U('build')}" method="post" class="form-horizontal doc-modal-form">
		<div class="form-group">
			<label class="col-xs-12 col-sm-2 control-label no-padding-right"><span class="red">*</span>标识名</label>
			<div class="col-xs-12 col-sm-5">
				<input type="text" class="width-100" name="info[name]" value="Example">
			</div>
			 <span class="help-block col-xs-12 col-sm-reset inline">（请输入插件标识）</span>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-2 control-label no-padding-right">插件名</label>
			<div class="col-xs-12 col-sm-5">
				<input type="text" class="width-100" name="info[title]" value="示列">
			</div>
			<span class="help-block col-xs-12 col-sm-reset inline">（请输入插件名）</span>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-2 control-label no-padding-right">版本</label>
			<div class="col-xs-12 col-sm-5">
				<input type="text" class="width-100" name="info[version]" value="0.1">
			</div>
			<span class="help-block col-xs-12 col-sm-reset inline">（请输入插件版本）</span>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-2 control-label no-padding-right">作者</label>
			<div class="col-xs-12 col-sm-5">
				<input type="text" class="width-100" name="info[author]" value="无名">
			</div>
			<span class="help-block col-xs-12 col-sm-reset inline">（请输入插件作者）</span>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-2 control-label no-padding-right">描述</label>
			<div class="col-xs-12 col-sm-5">
				<textarea name="info[description]" class="autosize-transition span12 form-control">这是一个临时描述</textarea>
			</div>
			<span class="help-block col-xs-12 col-sm-reset inline">（请输入描述）</span>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-2 control-label no-padding-right">安装后是否启用</label>
			<div class="col-xs-12 col-sm-5">
				<label class="checkbox">
				</label>
				<label>
					<input class="ace" type="checkbox" name="info[status]" value="1" checked />
                    <span class="lbl"></span>
                </label>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-2 control-label no-padding-right">是否需要配置</label>
			<div class="col-xs-12 col-sm-5">
	            <label>
                    <input class="ace" type="checkbox" id="has_config" name="has_config" value="1" />
	                <span class="lbl"></span>
	            </label>
				<label class="width-100 has_config hidden">
					<textarea rows="10" class="autosize-transition span12 form-control" name="config">
&lt;?php
return array(
	'random'=>array(//配置在表单中的键名 ,这个会是config[random]
		'title'=>'是否开启随机:',//表单的文字
		'type'=>'radio',		 //表单的类型：text、textarea、checkbox、radio、select等
		'options'=>array(		 //select 和radion、checkbox的子选项
			'1'=>'开启',		 //值=>文字
			'0'=>'关闭',
		),
		'value'=>'1',			 //表单的默认值
	),
);
					</textarea>
				</label>
				<input type="text" class="width-100 has_config hidden" name="custom_config">
			</div>
			<span class="help-block col-xs-12 col-sm-5 inline has_config hidden">自定义模板,注意：自定义模板里的表单name必须为config[name]这种，获取保存后配置的值用$data.config.name</span>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-2 control-label no-padding-right">是否需要外部访问</label>
			<div class="col-xs-12 col-sm-5">
				<label>
					<input class="ace" type="checkbox" class="checkbox" name="has_outurl" value="1" />
                    <span class="lbl"></span>
                </label>
            </div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-2 control-label no-padding-right">实现的钩子方法</label>
			<div class="col-xs-12 col-sm-5">
				<select class="select" name="hook[]" size="10" multiple required>
					<volist name="Hooks" id="vo">
						<option value="{$vo.name}" title="{$vo.description}">{$vo.name}</option>
					</volist>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-2 control-label no-padding-right">是否需要后台列表</label>
			<div class="col-xs-12 col-sm-5">
                <label>
                    <input class="ace" type="checkbox" id="has_adminlist" name="has_adminlist" value="1" />
                    <span class="lbl"></span> 勾选，扩展里已装插件后台列表会出现插件名的列表菜单，如系统的附件
                </label>
				<label class="width-100 has_adminlist hidden">
					<textarea rows="10" name="admin_list" class="autosize-transition span12 form-control">
'model'=>'Example',		//要查的表
			'fields'=>'*',			//要查的字段
			'map'=>'',				//查询条件, 如果需要可以再插件类的构造方法里动态重置这个属性
			'order'=>'id desc',		//排序,
			'list_grid'=>array( 		//这里定义的是除了id序号外的表格里字段显示的表头名和模型一样支持函数和链接
                'cover_id|preview_pic:封面',
                'title:书名',
                'description:描述',
                'link_id|get_link:外链',
                'update_time|time_format:更新时间',
                'id:操作:[EDIT]|编辑,[DELETE]|删除'
            ),
					</textarea>
				</label>
				<input type="text" class="width-100 has_adminlist hidden" name="custom_adminlist">
			</div>
			<span class="help-block col-xs-12 col-sm-5 inline block has_adminlist hidden">自定义模板,注意：自定义模板里的列表变量为$_list这种,遍历后可以用listkey可以控制表头显示,也可以完全手写，分页变量用$_page</span>
		</div>

        <?=ace_srbtn()?>
	</form>
</block>

<block name="script">
	<script type="text/javascript" src="__JS__/codemirror/codemirror.js"></script>
	<script type="text/javascript" src="__JS__/codemirror/xml.js"></script>
	<script type="text/javascript" src="__JS__/codemirror/javascript.js"></script>
	<script type="text/javascript" src="__JS__/codemirror/clike.js"></script>
	<script type="text/javascript" src="__JS__/codemirror/php.js"></script>

	<script type="text/javascript" src="__STATIC__/thinkbox/jquery.thinkbox.js"></script>

	<script type="text/javascript">
		function bindShow(radio_bind, selectors){
			$(radio_bind).click(function(){
				$(selectors).toggleClass('hidden');
			})
		}

		//配置的动态
		bindShow('#has_config','.has_config');
		bindShow('#has_adminlist','.has_adminlist');

		$('#preview').click(function(){
			var preview_url = '{:U("preview")}';
			console.log($('#form').serialize());
			$.post(preview_url, $('#form').serialize(),function(data){
				$.thinkbox('<div id="preview_window" class="loading"><textarea></textarea></div>',{
					afterShow:function(){
						var codemirror_option = {
							lineNumbers   :true,
							matchBrackets :true,
							mode          :"application/x-httpd-php",
							indentUnit    :4,
							gutter        :true,
							fixedGutter   :true,
							indentWithTabs:true,
							readOnly	  :true,
							lineWrapping  :true,
							height		  :500,
							enterMode     :"keep",
							tabMode       :"shift",
							theme: "{:C('CODEMIRROR_THEME')}"
						};
						var preview_window = $("#preview_window").removeClass(".loading").find("textarea");
						var editor = CodeMirror.fromTextArea(preview_window[0], codemirror_option);
						editor.setValue(data);
						$(window).resize();
					},

					title:'预览插件主文件',
					unload: true,
					actions:['close'],
					drag:true
				});
			});
			return false;
		});

		$('.ajax-post_custom').click(function(){
	        var target,query,form;
	        var target_form = $(this).attr('target-form');
	        var check_url = '{:U('checkForm')}';
			$.ajax({
			   type: "POST",
			   url: check_url,
			   dataType: 'json',
			   async: false,
			   data: $('#form').serialize(),
			   success: function(data){
			    	if(data.status){
    			        if( ($(this).attr('type')=='submit') || (target = $(this).attr('href')) || (target = $(this).attr('url')) ){
				            form = $('.'+target_form);
				            if ( form.get(0).nodeName=='FORM' ){
				                target = form.get(0).action;
				                query = form.serialize();
				            }else if( form.get(0).nodeName=='INPUT' || form.get(0).nodeName=='SELECT' || form.get(0).nodeName=='TEXTAREA') {
				                query = form.serialize();
				            }else{
				                query = form.find('input,select,textarea').serialize();
				            }
				            $.post(target,query).success(function(data){
				                if (data.status==1) {
				                    if (data.url) {
				                        updateAlert(data.info + ' 页面即将自动跳转~','alert-success');
				                    }else{
				                        updateAlert(data.info + ' 页面即将自动刷新~');
				                    }
				                    setTimeout(function(){
				                        if (data.url) {
				                            location.href=data.url;
				                        }else{
				                        	location.reload();
				                        }
				                    },1500);
				                }else{
				                    updateAlert(data.info);
				                }
				            });
				        }
			    	}else{
			    		updateAlert(data.info);
					}
			   }
			});

	        return false;
	    });

	    //导航高亮
	    highlight_subnav('{:U('Addons/index')}');
	</script>
</block>

<extend name="Public/base" />

<block name="body">
<script type="text/javascript" src="__STATIC__/uploadify/jquery.uploadify.min.js"></script>
<!-- 标签页导航 -->
<div class="tabbable">
    <?php
    $tabs = parse_config_attr($model['field_group']);
    if(count($tabs) > 1):
        ?>
        <ul class="nav nav-tabs padding-18">
            <volist name="tabs" id="group">
                <li <eq name="key" value="1">class="active"</eq>><a data-toggle="tab" href="#tab{$key}">{$group}</a></li>
            </volist>
        </ul>
    <?php endif;?>
    <!-- 表单 -->
    <form id="form" action="<?=isset($form_action) ? U($form_action) : U('add',['model'=>$model['id']])?>" method="post" class="form-horizontal">
    <div class="tab-content no-border padding-24">
        <!-- 基础文档模型 -->
		<volist name=":parse_config_attr($model['field_group'])" id="group">
        <div id="tab{$key}" class="tab-pane <eq name="key" value="1">active</eq> tab{$key}">
            <volist name="fields[$key]" id="field">
                <?php
                if($field['type'] == 'hidden'){
                    echo '<input type="hidden" value="'.I($field['name']).'" name="'.$field['name'].'" />';
                    continue;
                }
                ?>
                <if condition="$field['is_show'] == 1 || $field['is_show'] == 2">
                <div class="form-group">
                    <label class="col-xs-12 col-sm-2 control-label no-padding-right">{$field['title']}</label>
                    <div class="col-xs-12 col-sm-6">
                        <switch name="field.type">
                            <case value="num">
                                <input type="text" class="width-100" name="{$field.name}" value="">
                            </case>
                            <case value="string">
                                <input type="text" class="width-100" name="{$field.name}" value="">
                            </case>
                            <case value="textarea">
                                <textarea name="{$field.name}" class="form-control"></textarea>
                            </case>
                            <case value="date">
                                <input type="text" name="{$field.name}" class="width-100 date" value="" placeholder="请选择日期" />
                            </case>
                            <case value="datetime">
                                <input type="text" name="{$field.name}" class="width-100 time" value="" placeholder="请选择时间" />
                            </case>
                            <case value="bool">
                                <select name="{$field.name}">
                                    <volist name=":parse_field_attr($field['extra'])" id="vo">
                                        <option value="{$key}" <eq name="field.value" value="$key">selected</eq>>{$vo}</option>
                                    </volist>
                                </select>
                            </case>
                            <case value="select">
                                <select name="{$field.name}">
                                    <volist name=":parse_field_attr($field['extra'])" id="vo">
                                        <option value="{$key}" <eq name="field.value" value="$key">selected</eq>>{$vo}</option>
                                    </volist>
                                </select>
                            </case>
                            <case value="radio">
                                <volist name=":parse_field_attr($field['extra'])" id="vo">
                                	<label>
                                        <input type="radio" class="ace" value="{$key}" <eq name="field.value" value="$key">checked</eq> name="{$field.name}">
                                        <span class="lbl">{$vo}&nbsp;</span>
                                	</label>
                                </volist>
                            </case>
                            <case value="checkbox">
                                <volist name=":parse_field_attr($field['extra'])" id="vo">
                                	<label>
										<input type="checkbox" class="ace" name="{$field.name}[]" value="{$key}">
										<span class="lbl"> {$vo}&nbsp;</span>
									</label>
                                </volist>
                            </case>
                            <case value="editor">
                                <textarea name="{$field.name}"></textarea>
                                {:hook('adminArticleEdit', array('name'=>$field['name'],'value'=>''))}
                            </case>
                            <case value="picture">
                                <div class="controls" id="picture_{$field.name}">
									<input type="file" id="upload_picture_{$field.name}">
									<input type="hidden" name="{$field.name}" id="cover_id_{$field.name}"/>
									<div class="upload-img-box" style="margin-top:4px;">
									</div>
								</div>
								<script type="text/javascript">
								<?php
								    $thumb = array();
								    foreach (explode("\r\n", $field['extra']) as $k=>$v){
                                        if(empty($v) && !intval($v)){
                                            continue;
                                        }
                                        $thumb[] = "'thumb[$k]':'$v'";
                                    }
								?>
								//上传图片
							    /* 初始化上传插件 */
								$("#upload_picture_{$field.name}").uploadify({
							        "height"          : 30,
							        "swf"             : "__STATIC__/uploadify/uploadify.swf",
							        "fileObjName"     : "download",
							        'formData'        : {<?php echo implode(',', $thumb)?>},
							        "buttonText"      : "上传图片",
							        "uploader"        : "{:U('File/uploadPicture',array('session_id'=>session_id()))}",
							        "width"           : 120,
							        'removeTimeout'	  : 1,
							        'fileTypeExts'	  : '*.jpg; *.png; *.gif;',
							        "onUploadSuccess" : uploadPicture{$field.name},
                                    'onFallback' : function() {
                                        alert('未检测到兼容版本的Flash.');
                                    }
							    });
								function uploadPicture{$field.name}(file, data){
							    	var data = $.parseJSON(data);
							        if(data.status){
                                        $("#cover_id_{$field.name}").val(<eq name="field.extra" value="src">data.url<else/>data.id</eq>);
                                        $("#cover_id_{$field.name}").parent().find('.upload-img-box').html(
							        		'<div class="upload-pre-item"><img width="120" src="' + data.src + '"/></div>'
							        	);

                                        layer.photos({
                                            photos: "#picture_{$field.name}"
                                        });
							        } else {
							        	updateAlert(data.info);
							        	setTimeout(function(){
							                $('#top-alert').find('button').click();
							                $(that).removeClass('disabled').prop('disabled',false);
							            },1500);
							        }
							    }
								</script>
                            </case>
                            <case value="file">
								<div class="controls">
									<input type="file" id="upload_file_{$field.name}">
									<input type="hidden" name="{$field.name}" value="{$data[$field['name']]}"/>
									<div class="upload-img-box">
										<present name="data[$field['name']]">
											<div class="upload-pre-file"><span class="upload_icon_all"></span>{$data[$field['name']]}</div>
										</present>
									</div>
								</div>
								<script type="text/javascript">
								//上传图片
							    /* 初始化上传插件 */
								$("#upload_file_{$field.name}").uploadify({
							        "height"          : 30,
							        "swf"             : "__STATIC__/uploadify/uploadify.swf",
							        "fileObjName"     : "download",
							        "buttonText"      : "上传附件",
							        "uploader"        : "{:U('File/upload',array('session_id'=>session_id()))}",
							        "width"           : 120,
							        'removeTimeout'	  : 1,
							        "onUploadSuccess" : uploadFile{$field.name},
                                    'onFallback' : function() {
                                        alert('未检测到兼容版本的Flash.');
                                    }
							    });
								function uploadFile{$field.name}(file, data){
									var data = $.parseJSON(data);
							        if(data.status){
							        	var name = "{$field.name}";
							        	$("input[name="+name+"]").val(data.data);
							        	$("input[name="+name+"]").parent().find('.upload-img-box').html(
							        		"<div class=\"upload-pre-file\"><span class=\"upload_icon_all\"></span>" + data.info + "</div>"
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
                            </case>
                            <case value="district">
                                <div id="city_{$field.name}"></div>
                                <script>
                                    <?php echo hook('H_XbDistrict', array('id'=>'city_'.$field['name'],'district'=>$field['name']));?>
                                </script>
                            </case>
                            <default/>
                            <input type="text" class="width-100" name="{$field.name}" value="">
                        </switch>
                    </div>
                    <div class="help-block col-xs-12 col-sm-reset inline">
                        <notempty name="field['remark']">（{$field['remark']}）</notempty>
                    </div>
                </div>
                </if>
            </volist>
        </div>
		</volist>

        <?=ace_srbtn()?>
    </div>
    </form>
</div>
</block>
<block name="script">
<link href="__STATIC__/datetimepicker/css/datetimepicker_blue.css" rel="stylesheet" type="text/css">
<link href="__STATIC__/datetimepicker/css/dropdown.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="__STATIC__/datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript" src="__STATIC__/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js" charset="UTF-8"></script>
<script type="text/javascript">

$(function(){
    $('.date').datetimepicker({
        format: 'yyyy-mm-dd',
        language:"zh-CN",
        minView:2,
        autoclose:true
    });
    $('.time').datetimepicker({
        format: 'yyyy-mm-dd hh:ii',
        language:"zh-CN",
        minView:2,
        autoclose:true
    });
    <?php if(isset($active_menu)):?>
    //导航高亮
    highlight_subnav('<?=U($active_menu)?>');
    <?php else:?>
    highlight_subnav('{:U('Model/index')}');
    <?php endif;?>
});
</script>
</block>

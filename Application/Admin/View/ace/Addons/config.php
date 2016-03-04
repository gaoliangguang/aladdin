<extend name="Public/base" />

<block name="body">
	<script type="text/javascript" src="__STATIC__/uploadify/jquery.uploadify.min.js"></script>
	<form action="{:U('saveConfig')}" class="form-horizontal" method="post">
		<empty name="custom_config">
			<foreach name="data['config']" item="form" key="o_key">
				<div class="form-group">
					<label class="col-xs-12 col-sm-2 control-label no-padding-right">
						{$form.title|default=''}
					</label>
						<switch name="form.type">
							<case value="text">
							<div class="col-xs-12 col-sm-5">
								<input type="text" name="config[{$o_key}]" class="text input-large" value="{$form.value}">
							</div>
							</case>
							<case value="password">
							<div class="col-xs-12 col-sm-5">
								<input type="password" name="config[{$o_key}]" class="text input-large" value="{$form.value}">
							</div>
							</case>
							<case value="hidden">
								<input type="hidden" name="config[{$o_key}]" value="{$form.value}">
							</case>
							<case value="radio">
							<div class="col-xs-12 col-sm-5">
								<foreach name="form.options" item="opt" key="opt_k">
									<label>
										<input class="ace" type="radio" name="config[{$o_key}]" value="{$opt_k}" <eq name="form.value" value="$opt_k"> checked</eq>>
                                        <span class="lbl"> </span> {$opt} 
                                    </label>
								</foreach>
							</div>
							</case>
							<case value="checkbox">
							<div class="col-xs-12 col-sm-5">
								<foreach name="form.options" item="opt" key="opt_k">
									<label class="checkbox">
										<php>
											is_null($form["value"]) && $form["value"] = array();
										</php>
										<input type="checkbox" name="config[{$o_key}][]" value="{$opt_k}" <in name="opt_k" value="$form.value"> checked</in>>{$opt}
									</label>
								</foreach>
							</div>
							</case>
							<case value="select">
							<div class="col-xs-12 col-sm-5">
								<select name="config[{$o_key}]">
									<foreach name="form.options" item="opt" key="opt_k">
										<option value="{$opt_k}" <eq name="form.value" value="$opt_k"> selected</eq>>{$opt}</option>
									</foreach>
								</select>
							</div>
							</case>
							<case value="textarea">
							<div class="col-xs-12 col-sm-5">
								<label class="textarea input-large">
									<textarea name="config[{$o_key}]">{$form.value}</textarea>
								</label>
							</div>
							</case>
							<case value="picture_union">
								<div class="col-xs-12 col-sm-5">
								<input type="file" id="upload_picture_{$o_key}">
								<input type="hidden" name="config[{$o_key}]" id="cover_id_{$o_key}" value="{$form.value}"/>
								<div class="upload-img-box">
									<notempty name="form['value']">
									<php> $mulimages = explode(",", $form["value"]); </php>
									<foreach name="mulimages" item="one">
										<div class="upload-pre-item" val="{$one}">
											<img src="{$one|get_cover='path'}"  ondblclick="removePicture{$o_key}(this)"/>
										</div>
									</foreach>
									</notempty>
								</div>
								</div>
								<script type="text/javascript">
									//上传图片
									/* 初始化上传插件 */
									$("#upload_picture_{$o_key}").uploadify({
										"height"          : 30,
										"swf"             : "__STATIC__/uploadify/uploadify.swf",
										"fileObjName"     : "download",
										"buttonText"      : "上传图片",
										"uploader"        : "{:U('File/uploadPicture',array('session_id'=>session_id()))}",
										"width"           : 120,
										'removeTimeout'   : 1,
										'fileTypeExts'    : '*.jpg; *.png; *.gif;',
										"onUploadSuccess" : uploadPicture{$o_key},
										'onFallback' : function() {
								            alert('未检测到兼容版本的Flash.');
								        }
									});

									function uploadPicture{$o_key}(file, data){
										var data = $.parseJSON(data);
										var src = '';
										if(data.status){
											src = data.url || '__ROOT__' + data.path
											$("#cover_id_{$o_key}").parent().find('.upload-img-box').append(
												'<div class="upload-pre-item" val="' + data.id + '"><img src="__ROOT__' + src + '" ondblclick="removePicture{$o_key}(this)"/></div>'
											);
											setPictureIds{$o_key}();
										} else {
											updateAlert(data.info);
											setTimeout(function(){
												$('#top-alert').find('button').click();
												$(that).removeClass('disabled').prop('disabled',false);
											},1500);
										}
									}
									function removePicture{$o_key}(o){
										var p = $(o).parent().parent();
										$(o).parent().remove();
										setPictureIds{$o_key}();
									}
									function setPictureIds{$o_key}(){
										var ids = [];
										$("#cover_id_{$o_key}").parent().find('.upload-img-box').find('.upload-pre-item').each(function(){
											ids.push($(this).attr('val'));
										});
										if(ids.length > 0)
											$("#cover_id_{$o_key}").val(ids.join(','));
										else
											$("#cover_id_{$o_key}").val('');
									}
								</script>
							</case>
							<case value="group">
								<ul class="tab-nav nav">
									<volist name="form.options" id="li">
										<li data-tab="tab{$i}" <eq name="i" value="1">class="current"</eq>><a href="javascript:void(0);">{$li.title}</a></li>
									</volist>
								</ul>
								<div class="tab-content">
								<volist name="form.options" id="tab">
									<div id="tab{$i}" class="tab-pane <eq name="i" value="1">in</eq> tab{$i}">
										<foreach name="tab['options']" item="tab_form" key="o_tab_key">
										<label class="item-label">
											{$tab_form.title|default=''}
											<present name="tab_form.tip">
												<span class="check-tips">{$tab_form.tip}</span>
											</present>
										</label>
										<div class="col-xs-12 col-sm-5">
											<switch name="tab_form.type">
												<case value="text">
													<input type="text" name="config[{$o_tab_key}]" class="text input-large" value="{$tab_form.value}">
												</case>
												<case value="password">
													<input type="password" name="config[{$o_tab_key}]" class="text input-large" value="{$tab_form.value}">
												</case>
												<case value="hidden">
													<input type="hidden" name="config[{$o_tab_key}]" value="{$tab_form.value}">
												</case>
												<case value="radio">
													<foreach name="tab_form.options" item="opt" key="opt_k">
														<label>
															<input class="ace" type="radio" name="config[{$o_tab_key}]" value="{$opt_k}" <eq name="tab_form.value" value="$opt_k"> checked</eq>>
														    <span class="lbl"> </span> {$opt}
													    </label>
													</foreach>
												</case>
												<case value="checkbox">
													<foreach name="tab_form.options" item="opt" key="opt_k">
														<label class="checkbox">
															<php> is_null($tab_form["value"]) && $tab_form["value"] = array();</php>
															<input type="checkbox" name="config[{$o_tab_key}][]" value="{$opt_k}" <in name="opt_k" value="$tab_form.value"> checked</in>>{$opt}
														</label>
													</foreach>
												</case>
												<case value="select">
													<select name="config[{$o_tab_key}]">
														<foreach name="tab_form.options" item="opt" key="opt_k">
															<option value="{$opt_k}" <eq name="tab_form.value" value="$opt_k"> selected</eq>>{$opt}</option>
														</foreach>
													</select>
												</case>
												<case value="textarea">
													<label class="textarea input-large">
														<textarea name="config[{$o_tab_key}]">{$tab_form.value}</textarea>
													</label>
												</case>
												<case value="picture_union">
													<div class="col-xs-12 col-sm-5">
													<input type="file" id="upload_picture_{$o_tab_key}">
													<input type="hidden" name="config[{$o_tab_key}]" id="cover_id_{$o_tab_key}" value="{$tab_form.value}"/>
													<div class="upload-img-box">
														<notempty name="tab_form['value']">
														<php> $mulimages = explode(",", $tab_form["value"]); </php>
														<foreach name="mulimages" item="one">
															<div class="upload-pre-item" val="{$one}">
																<img src="{$one|get_cover='path'}"  ondblclick="removePicture{$o_tab_key}(this)"/>
															</div>
														</foreach>
														</notempty>
													</div>
													</div>
													<script type="text/javascript">
														//上传图片
														/* 初始化上传插件 */
														$("#upload_picture_{$o_tab_key}").uploadify({
															"height"          : 30,
															"swf"             : "__STATIC__/uploadify/uploadify.swf",
															"fileObjName"     : "download",
															"buttonText"      : "上传图片",
															"uploader"        : "{:U('File/uploadPicture',array('session_id'=>session_id()))}",
															"width"           : 120,
															'removeTimeout'   : 1,
															'fileTypeExts'    : '*.jpg; *.png; *.gif;',
															"onUploadSuccess" : uploadPicture{$o_tab_key},
															'onFallback' : function() {
													            alert('未检测到兼容版本的Flash.');
													        }
														});

														function uploadPicture{$o_tab_key}(file, data){
															var data = $.parseJSON(data);
															var src = '';
															if(data.status){
																src = data.url || '__ROOT__' + data.path
																$("#cover_id_{$o_tab_key}").parent().find('.upload-img-box').append(
																	'<div class="upload-pre-item" val="' + data.id + '"><img src="__ROOT__' + src + '" ondblclick="removePicture{$o_tab_key}(this)"/></div>'
																);
																setPictureIds{$o_tab_key}();
															} else {
																updateAlert(data.info);
																setTimeout(function(){
																	$('#top-alert').find('button').click();
																	$(that).removeClass('disabled').prop('disabled',false);
																},1500);
															}
														}
														function removePicture{$o_tab_key}(o){
															var p = $(o).parent().parent();
															$(o).parent().remove();
															setPictureIds{$o_tab_key}();
														}
														function setPictureIds{$o_tab_key}(){
															var ids = [];
															$("#cover_id_{$o_tab_key}").parent().find('.upload-img-box').find('.upload-pre-item').each(function(){
																ids.push($(this).attr('val'));
															});
															if(ids.length > 0)
																$("#cover_id_{$o_tab_key}").val(ids.join(','));
															else
																$("#cover_id_{$o_tab_key}").val('');
														}
													</script>
												</case>
												</switch>
											</div>
										</foreach>
									</div>
								</volist>
								</div>
							</case>
						</switch>
                        <present name="form.tip">
                            <span class="help-block col-xs-12 col-sm-5 inline">{$form.tip}</span>
                        </present>
					</div>
			</foreach>
		<else />
			<present name="custom_config">
				{$custom_config}
			</present>
		</empty>
		<div class="clearfix form-actions">
			<input type="hidden" name="id" value="{:I('id')}" readonly>
            <div class="col-xs-12 center">
                <button type="submit" target-form="form-horizontal" class="btn btn-success ajax-post no-refresh" id="sub-btn">
                    <i class="icon-ok bigger-110"></i> 确认保存
                </button> 
                <button type="reset" class="btn" id="reset-btn">
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
	highlight_subnav('{:U('Addons/index')}');
	if($('ul.tab-nav').length){
		//当有tab时，返回按钮不显示
		$('.btn-return').hide();
	}
	$(function(){
		//支持tab
		showTab();
	})
</script>
</block>

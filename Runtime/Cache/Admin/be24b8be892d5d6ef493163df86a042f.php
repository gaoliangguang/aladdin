<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="cn">
    <head>
        <meta charset="utf-8" />
        
        <title><?php echo ($meta_title); if(!empty($meta_title)): ?>|<?php echo C('WEB_SITE_TITLE'); endif; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <!-- basic styles -->
        <link rel="stylesheet" href="/aladdin/root/Public/Ace/css/bootstrap.min.css"/>
        <link rel="stylesheet" href="/aladdin/root/Public/Ace/css/font-awesome.min.css" />
        <link rel="stylesheet" media="screen" href="/aladdin/root/Public/Ace/css/index-d015ae33935703883cc631dbe9c20c09.css">
        <link rel="stylesheet" href="/aladdin/root/Public/Ace/css/bootstrap-b9db6fb6a7044a11a821eb232dbc425f.css">
        <link rel="stylesheet" href="/aladdin/root/Public/Ace/css/index-fd565b83305d5082827a17211f170ede.css">

        <!--[if IE 7]>
          <link rel="stylesheet" href="/aladdin/root/Public/Ace/css/font-awesome-ie7.min.css" />
        <![endif]-->

        <!-- page specific plugin styles -->

        <!-- fonts -->

        <link rel="stylesheet" href="/aladdin/root/Public/Ace/css/font-googleapis.css" />

        <!-- ace styles -->

        <link rel="stylesheet" href="/aladdin/root/Public/Ace/css/ace.min.css" />
        <link rel="stylesheet" href="/aladdin/root/Public/Ace/css/ace-rtl.min.css" />
        <link rel="stylesheet" href="/aladdin/root/Public/Ace/css/ace-skins.min.css" />
        <link rel="stylesheet" href="/aladdin/root/Public/Admin/css/common.css" />

        <!--[if lte IE 8]>
          <link rel="stylesheet" href="/aladdin/root/Public/Ace/css/ace-ie.min.css" />
        <![endif]-->

        <!-- inline styles related to this page -->
        
        <!-- ace settings handler -->

        <script src="/aladdin/root/Public/Ace/js/ace-extra.min.js"></script>

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->

        <!--[if lt IE 9]>
        <script src="/aladdin/root/Public/Ace/js/html5shiv.js"></script>
        <script src="/aladdin/root/Public/Ace/js/respond.min.js"></script>
        <![endif]-->
        
	    <!--[if lt IE 9]>
	    <script type="text/javascript" src="/aladdin/root/Public/static/jquery-1.10.2.min.js"></script>
	    <![endif]-->
	    <!--[if gte IE 9]><!-->
	    <script type="text/javascript" src="/aladdin/root/Public/static/jquery-2.0.3.min.js"></script>
	    <!--<![endif]-->
    </head>
    
    <body class="skin-2">
        <!--top-->
        <div class="navbar navbar-default" id="navbar">
            <script type="text/javascript">
                try{ace.settings.check('navbar' , 'fixed')}catch(e){}
            </script>
            
            <div class="navbar-container" id="navbar-container">
                <div class="navbar-header pull-left">
                    <a href="#" class="navbar-brand">
                        <small>
                            <i class="icon-leaf"></i>
                            <?php echo C('WEB_SITE_TITLE');?>
                        </small>
                    </a><!-- /.brand -->
                </div><!-- /.navbar-header -->
            
                <div class="navbar-header pull-right" role="navigation">
                    <ul class="nav ace-nav">
                        <li class="purple">
                            <a href="<?=U('information/inbox',['status'=>'NO#'])?>" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="icon-bell-alt icon-animated-bell"></i>
                                <span class="badge badge-important">
                                    <?=$unread_count?>
                                </span>
                            </a>

                            <ul class="pull-right dropdown-navbar navbar-pink dropdown-menu dropdown-caret dropdown-close">

                                <li>
                                    <a href="<?=U('information/inbox',['status'=>'NO#'])?>">
                                        <div class="clearfix">
											<span class="pull-left">
												<i class="btn btn-xs no-hover btn-pink icon-envelope"></i>
												查看新通知
											</span>
                                            <span class="pull-right badge badge-info">+8</span>
                                        </div>
                                    </a>
                                </li>

                                <li>
                                    <a href="<?=U('information/inbox')?>">
                                        查看所有通知
                                        <i class="icon-arrow-right"></i>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="light-blue">
                            <a data-toggle="dropdown" href="#" class="dropdown-toggle">
                                <img class="nav-user-photo" src="/aladdin/root/Public/Ace/avatars/avatar2.png" alt="Jason's Photo" />
                                <span class="user-info">
                                    <small>欢迎光临,</small>
                                    <?php echo session('user_auth.username');?>
                                </span>
            
                                <i class="icon-caret-down"></i>
                            </a>
                            <ul class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">

                                <li>
                                    <a href="<?php echo U('User/updatePassword');?>">
                                        <i class="icon-key"></i>
                                                                                                  修改密码
                                    </a>
                                </li>
            
                                <li>
                                    <a href="<?php echo U('User/updatenickname');?>">
                                        <i class="icon-user"></i>
                                                                                                 修改昵称
                                    </a>
                                </li>
            
                                <li class="divider"></li>
            
                                <li>
                                    <a id="logout" href="javascript:">
                                        <i class="icon-off"></i>
                                                                                                        退出
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul><!-- /.ace-nav -->
                </div><!-- /.navbar-header -->
            </div><!-- /.container -->
        </div>
        <!--top-->
        <script>
        $(document).ready(function(){
            $("#logout").click(function(){
                layer.confirm('您确定退出？',{icon:3},function(index){
                    layer.close(index);
                    $.get('<?php echo U('Public/logout');?>',function(resp){
                        window.location = resp.url;
                    })
                });
                return false;
            })
        })
        </script>
        <div class="main-container" id="main-container">
            <script type="text/javascript">
                try{ace.settings.check('main-container' , 'fixed')}catch(e){}
            </script>

            <div class="main-container-inner">
                <a class="menu-toggler" id="menu-toggler" href="#">
                    <span class="menu-text"></span>
                </a>
                
                <div class="sidebar" id="sidebar">
                    <script type="text/javascript">
                        try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
                    </script>

                    <ul class="nav nav-list">
		                <?php if(!empty($_extra_menu)): ?>
		                    <?php echo extra_menu($_extra_menu,$__MENU__); endif; ?>
                        <?php if(is_array($__MENU__["main"])): $i = 0; $__LIST__ = $__MENU__["main"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu): $mod = ($i % 2 );++$i;?><li class="<?php echo ((isset($menu["class"]) && ($menu["class"] !== ""))?($menu["class"]):''); ?>">
			                    <a <?php if(!empty($menu["child"])): ?>class="dropdown-toggle" href="javascript:"<?php else: ?>href="<?php echo (U($menu["url"])); ?>"<?php endif; ?>>
	                                <i class="<?php echo ($menu["class_fix"]); ?>"></i>
	                                <span class="menu-text"><?php echo ($menu["title"]); ?></span>
	                                <?php if(!empty($menu["child"])): ?><b class="arrow icon-angle-down"></b><?php endif; ?>
	                            </a>
	                            <?php if(!empty($menu["child"])): ?><ul class="submenu">
		                            <?php if(is_array($menu["child"])): foreach($menu["child"] as $key=>$sub_menu): ?><!-- 子导航 -->
		                            <?php if(!empty($sub_menu)): ?><li>
		                                <a href="<?php echo (U($sub_menu["url"])); ?>">
		                                <i class="icon-double-angle-right"></i>
		                                <?php echo ($sub_menu["title"]); ?>
		                                </a>
		                            </li><?php endif; ?>
		                            <!-- /子导航 --><?php endforeach; endif; ?>
                                </ul><?php endif; ?>
			                </li><?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul><!-- /.nav-list -->

                    <div class="sidebar-collapse" id="sidebar-collapse">
                        <i class="icon-double-angle-left" data-icon1="icon-double-angle-left" data-icon2="icon-double-angle-right"></i>
                    </div>

                    <script type="text/javascript">
                        try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
                    </script>
                </div>
                
                <div class="main-content">
                    <div class="breadcrumbs" id="breadcrumbs">
                        <script type="text/javascript">
                            try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
                        </script>

                        <ul class="breadcrumb">
                            <?php $i = '1'; ?>
			                <?php if(is_array($__MENU__["_nav"])): foreach($__MENU__["_nav"] as $k=>$nav): if($i == 1 AND $nav["title"] != '首页'): ?><li class="active">
		                                <i class="icon-home home-icon"></i> 首页
		                            </li><?php endif; ?>
			                    <li <?php if($i == count(__MENU__._nav)): ?>class="active"<?php endif; ?>>
			                        <?php if($nav["title"] == '首页'): ?><i class="icon-home home-icon"></i><?php endif; ?>
	                                <?php echo ($nav["title"]); ?>
	                            </li>
			                    <?php $i = $i+1; endforeach; endif; ?>
                        </ul>
                        <!-- .breadcrumb -->
                    </div> 
                    <!--内容-->
                    <div class="page-content">
                        <div class="row">
                            <div class="col-xs-12">
						        <!-- PAGE CONTENT BEGINS -->
						
						        <!--[if lte IE 7]>
						        <div class="alert alert-block alert-warning">
						            <button type="button" class="close" data-dismiss="alert">
						                <i class="icon-remove"></i>
						            </button>
						
						            <i class="icon-lightbulb "></i>
						            <strong>您使用的浏览器版本过低,请使用IE8以上浏览器 浏览本后台</strong>
						        </div>
						        <![endif]--> 
						        <!--msg -->
                                
								<div id="top-alert" class="alert alert-danger" style="display: none;">
	                                <button data-dismiss="alert" class="close" type="button">
	                                    <i class="icon-remove"></i>
	                                </button>
	                                <div class="alert-content"></div>
	                            </div>
	                            
<script type="text/javascript" src="/aladdin/root/Public/static/uploadify/jquery.uploadify.min.js"></script>
<!-- 标签页导航 -->
<div class="tabbable">
    <?php
 $tabs = parse_config_attr($model['field_group']); if(count($tabs) > 1): ?>
        <ul class="nav nav-tabs padding-18">
            <?php if(is_array($tabs)): $i = 0; $__LIST__ = $tabs;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$group): $mod = ($i % 2 );++$i;?><li <?php if(($key) == "1"): ?>class="active"<?php endif; ?>><a data-toggle="tab" href="#tab<?php echo ($key); ?>"><?php echo ($group); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
    <?php endif;?>
    <!-- 表单 -->
    <form id="form" action="<?=isset($form_action) ? U($form_action) : U('add',['model'=>$model['id']])?>" method="post" class="form-horizontal">
    <div class="tab-content no-border padding-24">
        <!-- 基础文档模型 -->
		<?php $_result=parse_config_attr($model['field_group']);if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$group): $mod = ($i % 2 );++$i;?><div id="tab<?php echo ($key); ?>" class="tab-pane <?php if(($key) == "1"): ?>active<?php endif; ?> tab<?php echo ($key); ?>">
            <?php if(is_array($fields[$key])): $i = 0; $__LIST__ = $fields[$key];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$field): $mod = ($i % 2 );++$i; if($field['type'] == 'hidden'){ echo '<input type="hidden" value="'.I($field['name']).'" name="'.$field['name'].'" />'; continue; } ?>
                <?php if($field['is_show'] == 1 || $field['is_show'] == 2): ?><div class="form-group">
                    <label class="col-xs-12 col-sm-2 control-label no-padding-right"><?php echo ($field['title']); ?></label>
                    <div class="col-xs-12 col-sm-6">
                        <?php switch($field["type"]): case "num": ?><input type="text" class="width-100" name="<?php echo ($field["name"]); ?>" value=""><?php break;?>
                            <?php case "string": ?><input type="text" class="width-100" name="<?php echo ($field["name"]); ?>" value=""><?php break;?>
                            <?php case "textarea": ?><textarea name="<?php echo ($field["name"]); ?>" class="form-control"></textarea><?php break;?>
                            <?php case "date": ?><input type="text" name="<?php echo ($field["name"]); ?>" class="width-100 date" value="" placeholder="请选择日期" /><?php break;?>
                            <?php case "datetime": ?><input type="text" name="<?php echo ($field["name"]); ?>" class="width-100 time" value="" placeholder="请选择时间" /><?php break;?>
                            <?php case "bool": ?><select name="<?php echo ($field["name"]); ?>">
                                    <?php $_result=parse_field_attr($field['extra']);if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($key); ?>" <?php if(($field["value"]) == $key): ?>selected<?php endif; ?>><?php echo ($vo); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                </select><?php break;?>
                            <?php case "select": ?><select name="<?php echo ($field["name"]); ?>">
                                    <?php $_result=parse_field_attr($field['extra']);if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($key); ?>" <?php if(($field["value"]) == $key): ?>selected<?php endif; ?>><?php echo ($vo); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                </select><?php break;?>
                            <?php case "radio": $_result=parse_field_attr($field['extra']);if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><label>
                                        <input type="radio" class="ace" value="<?php echo ($key); ?>" <?php if(($field["value"]) == $key): ?>checked<?php endif; ?> name="<?php echo ($field["name"]); ?>">
                                        <span class="lbl"><?php echo ($vo); ?>&nbsp;</span>
                                	</label><?php endforeach; endif; else: echo "" ;endif; break;?>
                            <?php case "checkbox": $_result=parse_field_attr($field['extra']);if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><label>
										<input type="checkbox" class="ace" name="<?php echo ($field["name"]); ?>[]" value="<?php echo ($key); ?>">
										<span class="lbl"> <?php echo ($vo); ?>&nbsp;</span>
									</label><?php endforeach; endif; else: echo "" ;endif; break;?>
                            <?php case "editor": ?><textarea name="<?php echo ($field["name"]); ?>"></textarea>
                                <?php echo hook('adminArticleEdit', array('name'=>$field['name'],'value'=>'')); break;?>
                            <?php case "picture": ?><div class="controls" id="picture_<?php echo ($field["name"]); ?>">
									<input type="file" id="upload_picture_<?php echo ($field["name"]); ?>">
									<input type="hidden" name="<?php echo ($field["name"]); ?>" id="cover_id_<?php echo ($field["name"]); ?>"/>
									<div class="upload-img-box" style="margin-top:4px;">
									</div>
								</div>
								<script type="text/javascript">
								<?php
 $thumb = array(); foreach (explode("\r\n", $field['extra']) as $k=>$v){ if(empty($v) && !intval($v)){ continue; } $thumb[] = "'thumb[$k]':'$v'"; } ?>
								//上传图片
							    /* 初始化上传插件 */
								$("#upload_picture_<?php echo ($field["name"]); ?>").uploadify({
							        "height"          : 30,
							        "swf"             : "/aladdin/root/Public/static/uploadify/uploadify.swf",
							        "fileObjName"     : "download",
							        'formData'        : {<?php echo implode(',', $thumb)?>},
							        "buttonText"      : "上传图片",
							        "uploader"        : "<?php echo U('File/uploadPicture',array('session_id'=>session_id()));?>",
							        "width"           : 120,
							        'removeTimeout'	  : 1,
							        'fileTypeExts'	  : '*.jpg; *.png; *.gif;',
							        "onUploadSuccess" : uploadPicture<?php echo ($field["name"]); ?>,
                                    'onFallback' : function() {
                                        alert('未检测到兼容版本的Flash.');
                                    }
							    });
								function uploadPicture<?php echo ($field["name"]); ?>(file, data){
							    	var data = $.parseJSON(data);
							        if(data.status){
                                        $("#cover_id_<?php echo ($field["name"]); ?>").val(<?php if(($field["extra"]) == "src"): ?>data.url<?php else: ?>data.id<?php endif; ?>);
                                        $("#cover_id_<?php echo ($field["name"]); ?>").parent().find('.upload-img-box').html(
							        		'<div class="upload-pre-item"><img width="120" src="' + data.src + '"/></div>'
							        	);

                                        layer.photos({
                                            photos: "#picture_<?php echo ($field["name"]); ?>"
                                        });
							        } else {
							        	updateAlert(data.info);
							        	setTimeout(function(){
							                $('#top-alert').find('button').click();
							                $(that).removeClass('disabled').prop('disabled',false);
							            },1500);
							        }
							    }
								</script><?php break;?>
                            <?php case "file": ?><div class="controls">
									<input type="file" id="upload_file_<?php echo ($field["name"]); ?>">
									<input type="hidden" name="<?php echo ($field["name"]); ?>" value="<?php echo ($data[$field['name']]); ?>"/>
									<div class="upload-img-box">
										<?php if(isset($data[$field['name']])): ?><div class="upload-pre-file"><span class="upload_icon_all"></span><?php echo ($data[$field['name']]); ?></div><?php endif; ?>
									</div>
								</div>
								<script type="text/javascript">
								//上传图片
							    /* 初始化上传插件 */
								$("#upload_file_<?php echo ($field["name"]); ?>").uploadify({
							        "height"          : 30,
							        "swf"             : "/aladdin/root/Public/static/uploadify/uploadify.swf",
							        "fileObjName"     : "download",
							        "buttonText"      : "上传附件",
							        "uploader"        : "<?php echo U('File/upload',array('session_id'=>session_id()));?>",
							        "width"           : 120,
							        'removeTimeout'	  : 1,
							        "onUploadSuccess" : uploadFile<?php echo ($field["name"]); ?>,
                                    'onFallback' : function() {
                                        alert('未检测到兼容版本的Flash.');
                                    }
							    });
								function uploadFile<?php echo ($field["name"]); ?>(file, data){
									var data = $.parseJSON(data);
							        if(data.status){
							        	var name = "<?php echo ($field["name"]); ?>";
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
								</script><?php break;?>
                            <?php case "district": ?><div id="city_<?php echo ($field["name"]); ?>"></div>
                                <script>
                                    <?php echo hook('H_XbDistrict', array('id'=>'city_'.$field['name'],'district'=>$field['name']));?>
                                </script><?php break;?>
                            <?php default: ?>
                            <input type="text" class="width-100" name="<?php echo ($field["name"]); ?>" value=""><?php endswitch;?>
                    </div>
                    <div class="help-block col-xs-12 col-sm-reset inline">
                        <?php if(!empty($field['remark'])): ?>（<?php echo ($field['remark']); ?>）<?php endif; ?>
                    </div>
                </div><?php endif; endforeach; endif; else: echo "" ;endif; ?>
        </div><?php endforeach; endif; else: echo "" ;endif; ?>

        <?=ace_srbtn()?>
    </div>
    </form>
</div>

                            </div>
                        </div>
                    </div><!-- /.page-content -->
                </div><!-- /.main-content -->

            </div><!-- /.main-container-inner -->

            <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
                <i class="icon-double-angle-up icon-only bigger-110"></i>
            </a>
        </div><!-- /.main-container -->
	    
	    <script type="text/javascript">
	    (function(){
	        var ThinkPHP = window.Think = {
	            "ROOT"   : "/aladdin/root", //当前网站地址
	            "APP"    : "/aladdin/root/admin.php?s=", //当前项目地址
	            "PUBLIC" : "/aladdin/root/Public", //项目公共目录地址
	            "DEEP"   : "<?php echo C('URL_PATHINFO_DEPR');?>", //PATHINFO分割符
	            "MODEL"  : ["<?php echo C('URL_MODEL');?>", "<?php echo C('URL_CASE_INSENSITIVE');?>", "<?php echo C('URL_HTML_SUFFIX');?>"],
	            "VAR"    : ["<?php echo C('VAR_MODULE');?>", "<?php echo C('VAR_CONTROLLER');?>", "<?php echo C('VAR_ACTION');?>"]
	        }
	    })();
	    </script>
	    <script type="text/javascript" src="/aladdin/root/Public/static/think.js"></script>
	    <script type="text/javascript" src="/aladdin/root/Public/static/layer/layer.min.js"></script>
	    
        <script type="text/javascript">
            if("ontouchend" in document) document.write('<script src="/aladdin/root/Public/Ace/js/jquery.mobile.custom.min.js">'+'</'+'script>');
        </script>
        <script src="/aladdin/root/Public/Ace/js/bootstrap.min.js"></script>
        <script src="/aladdin/root/Public/static/respond.js"></script>
        <!-- 自动补全输入框 js -->
        <script src="/aladdin/root/Public/Ace/js/typeahead-bs2.min.js"></script>
        
        <!-- page specific plugin scripts -->

        <script src="/aladdin/root/Public/Ace/js/jquery-ui-1.10.3.custom.min.js"></script>
        <script src="/aladdin/root/Public/Ace/js/jquery.ui.touch-punch.min.js"></script>

        <!-- ace scripts -->

        <script src="/aladdin/root/Public/Ace/js/ace-elements.min.js"></script>
        <script src="/aladdin/root/Public/Ace/js/ace.min.js"></script>
        <!-- inline scripts related to this page -->
        
	    <script type="text/javascript" src="/aladdin/root/Public/Admin/js/common.js"></script>
	    <script type="text/javascript" src="/aladdin/root/Public/static/common.js"></script>
	    <script type="text/javascript">
	        +function(){
	            /* 左边菜单高亮 */
	            var $subnav = $("#sidebar");
	            url = window.location.pathname + window.location.search;
	            url = url.replace(/(\/(p)\/\d+)|(&\w*=.+)/, "");
	            $subnav.find("a[href='" + url + "']").parent().addClass("active");
	        }();
	    </script>
	    
<link href="/aladdin/root/Public/static/datetimepicker/css/datetimepicker_blue.css" rel="stylesheet" type="text/css">
<link href="/aladdin/root/Public/static/datetimepicker/css/dropdown.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="/aladdin/root/Public/static/datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript" src="/aladdin/root/Public/static/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js" charset="UTF-8"></script>
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
    highlight_subnav('<?php echo U('Model/index');?>');
    <?php endif;?>
});
</script>

    </body>
</html>
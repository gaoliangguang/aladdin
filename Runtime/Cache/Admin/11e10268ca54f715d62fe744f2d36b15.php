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
	                            
<div class="span12">
    <div class="widget-box">
        <div class="widget-header widget-header-blue widget-header-flat">
        </div>

        <div class="widget-body">
            <div class="widget-main">
                <div id="fuelux-wizard" class="row-fluid" data-target="#step-container">
                    <ul class="wizard-steps">
                        <li data-target="#step1" class="active">
                            <span class="step">1</span>
                            <span class="title">提示</span>
                        </li>

                        <li data-target="#step2">
                            <span class="step">2</span>
                            <span class="title">输入资料</span>
                        </li>

                        <li data-target="#step3">
                            <span class="step">3</span>
                            <span class="title">确认重置</span>
                        </li>
                    </ul>
                </div>

                <hr />
                <div class="step-content row-fluid position-relative" id="step-container">
                    <div class="step-pane active" id="step1">
                        <div class="alert alert-danger">
                            <strong>警告！</strong>
                            本功能仅在用户有需要的时候才会使用！
                            点击下一步进入重置用户登录密码页面
                            <br>
                        </div>
                    </div>

                    <div class="step-pane" id="step2">
                        <form id="sample-form" class="form-horizontal">
                            <div class="form-group">
                                <label class="col-xs-12 col-sm-3 control-label no-padding-right" for="inputInfo">
                                    手机号码
                                </label>

                                <div class="col-xs-12 col-sm-5">
                                    <span class="block input-icon input-icon-right">
                                        <input type="text" class="width-100" id="mobile_num" name="mobile_num">
                                        <i class="icon-mobile-phone"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-12 col-sm-3 control-label no-padding-right" for="inputInfo">
                                    身份证号
                                </label>

                                <div class="col-xs-12 col-sm-5">
                                    <span class="block input-icon input-icon-right">
                                        <input type="text" class="width-100" id="id_num" name="id_num">
                                        <i class="icon-info"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-12 col-sm-3 control-label no-padding-right" for="inputInfo">
                                    真实姓名
                                </label>

                                <div class="col-xs-12 col-sm-5">
                                    <span class="block input-icon input-icon-right">
                                        <input type="text" class="width-100" id="real_name" name="real_name">
                                        <i class="icon-user"></i>
                                    </span>
                                </div>
                            </div>

                        </form>
                    </div>

                    <div class="step-pane" id="step3">
                        <div class="center">
                            <div class="alert alert-warning">
                                用户已经查到到，请点击确认重置完成操作，如需取消，请离开本页面即可！
                                <br>
                            </div>
                        </div>
                    </div>

                </div>

                <hr />
                <div class="row-fluid wizard-actions">
                    <button class="btn btn-white btn-prev">
                        <i class="icon-arrow-left"></i>
                        上一步
                    </button>

                    <button class="btn btn-white btn-next" data-last="确认重置 ">
                        下一步
                        <i class="icon-arrow-right icon-on-right"></i>
                    </button>
                </div>
            </div><!-- /widget-main -->
        </div><!-- /widget-body -->
    </div>
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
	    

<script src="/aladdin/root/Public/Ace/js/fuelux/fuelux.wizard.min.js"></script>

<script>
$(function(){
    window.ace.click_event=$.fn.tap?"tap":"click";
    var user_exist = false;
    $('#fuelux-wizard').ace_wizard().on('change' , function(e, info){
        var wizard = $(this).data("wizard")
        if(info.step == 2 && info.direction == 'next' && !user_exist) {

            var mobile_num = $.trim($("#mobile_num").val());
            if(mobile_num == ''){
                layer.alert('手机号码不能为空',{icon:2});
                return false;
            }
            var id_num = $.trim($("#id_num").val());
            if(id_num == ''){
                layer.alert('身份证号不能为空',{icon:2});
                return false;
            }
            var real_name = $.trim($("#real_name").val());
            if(real_name == ''){
                layer.alert('真实姓名不能为空',{icon:2});
                return false;
            }

            $.post(
                '<?=U('')?>',
                {mobile_num:mobile_num,id_num:id_num,real_name:real_name,method:'check_user'},
                function(resp){
                    if(resp.status == '1'){
                        user_exist = true;
                        wizard.next();
                    }else{
                        layer.alert(resp.info,{icon:2});
                    }
                },
                'json'
            );
            return false;
        }else if(info.step == 2 && info.direction == 'next' && user_exist){
            user_exist = false;
        }
    }).on('finished', function(e) {
        $.post('<?=U('')?>',$("#sample-form").serializeArray(),function(resp){
            if(resp.status == '1'){
                layer.msg('重置成功',{icon:1},function(){
                    window.location = window.location;
                });
            }else{
                layer.alert(resp.info,{icon:2});
            }
        },'json');

    }).on('stepclick', function(e){
        //return false;//prevent clicking on steps
    });
})


</script>

    </body>
</html>
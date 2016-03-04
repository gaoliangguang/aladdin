<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="cn">
    <head>
        <meta charset="utf-8" />
        
        <title><?php echo ($meta_title); if(!empty($meta_title)): ?>|<?php echo C('WEB_SITE_TITLE'); endif; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <!-- basic styles -->
        <link rel="stylesheet" href="/aladdin/root/Public/Ace/css/bootstrap.min.css"/>
        <link rel="stylesheet" href="/aladdin/root/Public/Ace/css/font-awesome.min.css" />

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
	                            
    <style>
    .category {
    	margin: 10px 0;
    	border-bottom-width: 0;
    	background-color: #fff;
    }
    .category .hd {
    	font-weight: bold;
    	border-bottom: 1px solid #d4d4d4;
    	color:#fff;
    	background-color: #353535;
    }
    .category .cate-item dt {
    	border-bottom: 1px solid #E7E7E7;
    }
    .category dl,
    .category dd,
    .category input {
    	margin: 0;
    }
    .category .check,
    .category .fold,
    .category .order,
    .category .name {
    	float: left;
    	height: 35px;
    	line-height: 35px;
    }
    .category .opt {
    	float: right;
    	width: 120px;
    	height: 35px;
    	line-height: 35px;
    	text-align: center;
    }
    .opt-btn {
    	float: right;
    	margin: 5px 10px 0 0;
    }
    .category .check {
    	width: 40px;
    	text-align: center;
    }
    .category .fold {
    	width: 50px;
    	text-align: center;
    }
    .category .fold i {
    	display: inline-block;
    	vertical-align: middle;
    	width: 17px;
    	height: 17px;
    	background-repeat: no-repeat;
    }
    .category .fold .icon-fold,
    .category .fold .icon-unfold {
    	cursor: pointer;
    	background: url(/aladdin/root/Public/Admin/images/bg_icon.png) no-repeat;
    }
    .category .fold .icon-fold {
    	background-position: -100px -25px;
    }
    .category .fold .icon-unfold {
    	background-position: -125px -25px;
    }
    .category .order,
    .category .order input {
    	text-align: center;
    }
    .category .order {
    	width: 90px;
    }
    .category .order input {
    	margin-bottom: 2px;
    	width: 40px;
    }
    .category .name input {
    	margin-bottom: 2px;
    }
    .category .add-sub-cate {
    	margin-left: 10px;
    }
    .category .add-sub-cate:hover {
    	text-decoration: none;
    	border-bottom: 0 none;
    }
    .category .btn-mod {
    	margin-left: 15px;
    }
    .category .root {
    	font-weight: bold;
    }
    .category .tab-sign {
    	display: inline-block;
    	margin-left: 15px;
    	height: 21px;
    	vertical-align: middle;
    	background-image: url(/aladdin/root/Public/Admin/images/tab_sign.png);
    	background-repeat: no-repeat;
    }
    .category .name .msg {
    	vertical-align: top;
    	font-weight: normal;
    }
    .category .name .error {
    	color: #B94A48;
    }
    .category .name .success {
    	color: #468847;
    }
    /* 顶级分类 */
    .category > dl > dt .tab-sign {
    	display: none;
    }
    
    /* 二级分类 */
    .category > dl > dd > dl > dt .tab-sign {
    	width: 55px;
    	background-position: 0 0;
    }
    .category > dl > dd > dl:last-child > dt .tab-sign {
    	background-position: -55px 0;
    }
    
    /* 三级分类 */
    .category > dl > dd > dl > dd > dl > dt  .tab-sign {
    	width: 110px;
    	background-position: 0 -30px;
    }
    .category > dl > dd > dl > dd > dl:last-child > dt .tab-sign {
    	background-position: 0 -60px;
    }
    
    .category > dl > dd > dl:last-child > dd > dl > dt .tab-sign {
    	background-position: 0 -90px;
    }
    .category > dl > dd > dl:last-child > dd > dl:last-child > dt .tab-sign {
    	background-position: 0 -120px;
    }
    .category > dl > dd > dl:last-child > dd > dl:last-child > dt .add-sub-cate{
    }
    .icon-add {
    	display: inline-block !important;
    	width: 16px;
    	height: 16px;
    	vertical-align: middle;
    	background: url(/aladdin/root/Public/Admin/images/bg_icon.png) no-repeat 0 0;
    }
    .add-on {
    	width: 20px;
    	height: 20px;
    	display: inline-block;
    	position: relative;
    	top: 7px;
    	right: 25px;
    }
    .sort_bottom {
    	margin-top: 105px;
    }
    .sort_option select {
    	height: 250px;
    	width: 220px;
    }
    .sort_top {
    	margin-bottom: 10px;
    }
    .sort_top input {
    	line-height: 26px;
    	margin-right: 30px;
    	border: 1px solid #ccc;
    	padding-left:5px;
    }
    .sort_btn button{
    	display: block;
    	margin-bottom: 15px;
    }
    .sort_option {
    	float: left;
    	margin-right: 16px;
    }
    .sort_confirm {
    	float: left;
    }
    .update-version {
    	font-size: 18px;
        line-height: 3;
        text-align: center;
        width: 85%;
    }
    .update-version .error {
        color: #B94A48;
    }
    .update-version .success {
        color: #468847;
    }
    .category .hd {
    	border-bottom-color: #d4d4d4;
    	color:#fff;
    	background-color: #307ecc;
    }
    .category .cate-item dt {
    	border-bottom-color: #E7E7E7;
    }
    .category .name .error {
    	color: #B94A48;
    }
    .category .name .success {
    	color: #468847;
    }
    
    .close {
        color: #000000;
        text-shadow: 0 1px 0 #ffffff;
        opacity: 0.2;
        filter: alpha(opacity=20);
    }
        
    </style>
	<!-- 表格列表 -->
	<div class="tb-unit posr">
		<div class="category">
			<div class="hd cf">
				<div class="fold">折叠</div>
				<div class="order">排序</div>
				<div class="order">发布</div>
				<div class="name">名称</div>
				<div style="clear: both;"></div>
			</div>
			<?php echo R('Category/tree', array($tree));?>
			<div style="clear: both;"></div>
		</div>
	</div>

    <div class="tb-unit-bar">
        <a class="btn btn-white" href="<?php echo U('add');?>">新 增</a>
    </div>
	<!-- /表格列表 -->

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
	    
	<script type="text/javascript">
		(function($){
			/* 分类展开收起 */
			$(".category dd").prev().find(".fold i").addClass("icon-unfold")
				.click(function(){
					var self = $(this);
					if(self.hasClass("icon-unfold")){
						self.closest("dt").next().slideUp("fast", function(){
							self.removeClass("icon-unfold").addClass("icon-fold");
						});
					} else {
						self.closest("dt").next().slideDown("fast", function(){
							self.removeClass("icon-fold").addClass("icon-unfold");
						});
					}
				});

			/* 三级分类删除新增按钮 */
			$(".category dd dd .add-sub").remove();

			/* 实时更新分类信息 */
			$(".category")
				.on("submit", "form", function(){
					var self = $(this);
					$.post(
						self.attr("action"),
						self.serialize(),
						function(data){
							/* 提示信息 */
							var name = data.status ? "success" : "error", msg;
							msg = self.find(".msg").addClass(name).text(data.info)
									  .css("display", "inline-block");
							setTimeout(function(){
								msg.fadeOut(function(){
									msg.text("").removeClass(name);
								});
							}, 1000);
						},
						"json"
					);
					return false;
				})
                .on("focus","input",function(){
                    $(this).data('param',$(this).closest("form").serialize());

                })
                .on("blur", "input", function(){
                    if($(this).data('param')!=$(this).closest("form").serialize()){
                        $(this).closest("form").submit();
                    }
                });
		})(jQuery);
	</script>

    </body>
</html>
<!DOCTYPE html>
<html lang="cn">
    <head>
        <meta charset="utf-8" />
        
        <title>{$meta_title}<notempty name="meta_title">|{:C('WEB_SITE_TITLE')}</notempty></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <!-- basic styles -->
        <link rel="stylesheet" href="__ACE__/css/bootstrap.min.css"/>
        <link rel="stylesheet" href="__ACE__/css/font-awesome.min.css" />
        <link rel="stylesheet" media="screen" href="__ACE__/css/index-d015ae33935703883cc631dbe9c20c09.css">
        <link rel="stylesheet" href="__ACE__/css/bootstrap-b9db6fb6a7044a11a821eb232dbc425f.css">
        <link rel="stylesheet" href="__ACE__/css/index-fd565b83305d5082827a17211f170ede.css">

        <!--[if IE 7]>
          <link rel="stylesheet" href="__ACE__/css/font-awesome-ie7.min.css" />
        <![endif]-->

        <!-- page specific plugin styles -->

        <!-- fonts -->

        <link rel="stylesheet" href="__ACE__/css/font-googleapis.css" />

        <!-- ace styles -->

        <link rel="stylesheet" href="__ACE__/css/ace.min.css" />
        <link rel="stylesheet" href="__ACE__/css/ace-rtl.min.css" />
        <link rel="stylesheet" href="__ACE__/css/ace-skins.min.css" />
        <link rel="stylesheet" href="__PUBLIC__/Admin/css/common.css" />

        <!--[if lte IE 8]>
          <link rel="stylesheet" href="__ACE__/css/ace-ie.min.css" />
        <![endif]-->

        <!-- inline styles related to this page -->
        <block name="style"></block>
        <!-- ace settings handler -->

        <script src="__ACE__/js/ace-extra.min.js"></script>

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->

        <!--[if lt IE 9]>
        <script src="__ACE__/js/html5shiv.js"></script>
        <script src="__ACE__/js/respond.min.js"></script>
        <![endif]-->
        
	    <!--[if lt IE 9]>
	    <script type="text/javascript" src="__STATIC__/jquery-1.10.2.min.js"></script>
	    <![endif]-->
	    <!--[if gte IE 9]><!-->
	    <script type="text/javascript" src="__STATIC__/jquery-2.0.3.min.js"></script>
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
                            {:C('WEB_SITE_TITLE')}
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
                                <img class="nav-user-photo" src="__ACE__/avatars/avatar2.png" alt="Jason's Photo" />
                                <span class="user-info">
                                    <small>欢迎光临,</small>
                                    {:session('user_auth.username')}
                                </span>
            
                                <i class="icon-caret-down"></i>
                            </a>
                            <ul class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">

                                <li>
                                    <a href="{:U('User/updatePassword')}">
                                        <i class="icon-key"></i>
                                                                                                  修改密码
                                    </a>
                                </li>
            
                                <li>
                                    <a href="{:U('User/updatenickname')}">
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
                    $.get('{:U('Public/logout')}',function(resp){
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
                <block name="sidebar">
                <div class="sidebar" id="sidebar">
                    <script type="text/javascript">
                        try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
                    </script>

                    <ul class="nav nav-list">
		                <notempty name="_extra_menu">
		                    {// 动态扩展菜单 //}
		                    {:extra_menu($_extra_menu,$__MENU__)}
		                </notempty>
                        <volist name="__MENU__.main" id="menu">
			                <li class="{$menu.class|default=''}">
			                    <a <notempty name="menu.child">class="dropdown-toggle" href="javascript:"<else />href="{$menu.url|U}"</notempty>>
	                                <i class="{$menu.class_fix}"></i>
	                                <span class="menu-text">{$menu.title}</span>
	                                <notempty name="menu.child">
                                    <b class="arrow icon-angle-down"></b>
                                    </notempty>
	                            </a>
	                            <notempty name="menu.child">
                                <ul class="submenu">
		                            <foreach name="menu.child" item="sub_menu">
		                            <!-- 子导航 -->
		                            <notempty name="sub_menu">
		                            <li>
		                                <a href="{$sub_menu.url|U}">
		                                <i class="icon-double-angle-right"></i>
		                                {$sub_menu.title}
		                                </a>
		                            </li>
		                            </notempty>
		                            <!-- /子导航 -->
			                        </foreach>
                                </ul>
                                </notempty>
			                </li>
			            </volist>
                    </ul><!-- /.nav-list -->

                    <div class="sidebar-collapse" id="sidebar-collapse">
                        <i class="icon-double-angle-left" data-icon1="icon-double-angle-left" data-icon2="icon-double-angle-right"></i>
                    </div>

                    <script type="text/javascript">
                        try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
                    </script>
                </div>
                </block>
                <div class="main-content">
                    <div class="breadcrumbs" id="breadcrumbs">
                        <script type="text/javascript">
                            try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
                        </script>

                        <ul class="breadcrumb">
                            <assign name="i" value="1" />
			                <foreach name="__MENU__._nav" item="nav" key="k">
			                    <if condition="$i eq 1 AND $nav.title neq '首页'">
		                            <li class="active">
		                                <i class="icon-home home-icon"></i> 首页
		                            </li>
                                </if>
			                    <li <if condition="$i eq count(__MENU__._nav)"> class="active"</if>>
			                        <if condition="$nav.title eq '首页'">
                                        <i class="icon-home home-icon"></i>
	                                </if>
	                                {$nav.title}
	                            </li>
			                    <assign name="i" value="$i+1" />
			                </foreach>
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
	                            <block name="body"> </block>
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
	            "ROOT"   : "__ROOT__", //当前网站地址
	            "APP"    : "__APP__", //当前项目地址
	            "PUBLIC" : "__PUBLIC__", //项目公共目录地址
	            "DEEP"   : "{:C('URL_PATHINFO_DEPR')}", //PATHINFO分割符
	            "MODEL"  : ["{:C('URL_MODEL')}", "{:C('URL_CASE_INSENSITIVE')}", "{:C('URL_HTML_SUFFIX')}"],
	            "VAR"    : ["{:C('VAR_MODULE')}", "{:C('VAR_CONTROLLER')}", "{:C('VAR_ACTION')}"]
	        }
	    })();
	    </script>
	    <script type="text/javascript" src="__STATIC__/think.js"></script>
	    <script type="text/javascript" src="__STATIC__/layer/layer.min.js"></script>
	    
        <script type="text/javascript">
            if("ontouchend" in document) document.write('<script src="__ACE__/js/jquery.mobile.custom.min.js">'+'</'+'script>');
        </script>
        <script src="__ACE__/js/bootstrap.min.js"></script>
        <script src="__STATIC__/respond.js"></script>
        <!-- 自动补全输入框 js -->
        <script src="__ACE__/js/typeahead-bs2.min.js"></script>
        
        <!-- page specific plugin scripts -->

        <script src="__ACE__/js/jquery-ui-1.10.3.custom.min.js"></script>
        <script src="__ACE__/js/jquery.ui.touch-punch.min.js"></script>

        <!-- ace scripts -->

        <script src="__ACE__/js/ace-elements.min.js"></script>
        <script src="__ACE__/js/ace.min.js"></script>
        <!-- inline scripts related to this page -->
        
	    <script type="text/javascript" src="__JS__/common.js"></script>
	    <script type="text/javascript" src="__STATIC__/common.js"></script>
	    <script type="text/javascript">
	        +function(){
	            /* 左边菜单高亮 */
	            var $subnav = $("#sidebar");
	            url = window.location.pathname + window.location.search;
	            url = url.replace(/(\/(p)\/\d+)|(&\w*=.+)/, "");
	            $subnav.find("a[href='" + url + "']").parent().addClass("active");
	        }();
	    </script>
	    <block name="script"></block>
    </body>
</html>

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
        
<style>
    .dragsort {
        width:400px;
    }
    .dragsort li {
        margin-bottom: 5px;
        padding: 0 6px;
        height: 30px;
        line-height: 30px;
        border: 1px solid #eee;
        background-color: #fff;
    	overflow: hidden;
    }
    .dragsort li em {
        font-style: normal;
    }
    .dragsort li b {
        display: none;
        float: right;
        padding: 0 6px;
        font-weight: bold;
        color: #000;
    }
    .dragsort li:hover b {
        display: block;
    }
    .dragsort .draging-place {
        border-style: dashed;
        border-color: #ccc;
    }
</style>

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
	                            
<?php  echo ace_form_open('updateHook'); $options = array( 'label_text'=>'钩子名称', 'help'=>'（需要在程序中先添加钩子，否则无效）', ); echo ace_input_m($options ,'name',$data['name']); echo ace_textarea(array('label_text'=>'钩子描述','help'=>'钩子的描述信息'),'description',$data['description']); $options = array('label_text'=>'钩子类型','help'=>'区分钩子的主要用途'); echo ace_dropdown($options,'pid',C('HOOKS_TYPE'),$data['type']); ?>
    <?php if(isset($data)): ?><div class="form-group">
			<label class="col-xs-12 col-sm-2 control-label no-padding-right">钩子挂载的插件排序</label>
			<div class="col-xs-12 col-sm-5">
				<input type="hidden" name="addons" value="<?php echo ($data["addons"]); ?>" readonly>
				<?php if(empty($data["addons"])): ?>暂无插件，无法排序
				<?php else: ?>
				<ul id="sortUl" class="dragsort">
					<?php $_result=explode(',',$data['addons']);if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$addons_vo): $mod = ($i % 2 );++$i;?><li class="getSort"><b>&times;</b><em><?php echo ($addons_vo); ?></em></li><?php endforeach; endif; else: echo "" ;endif; ?>
				</ul>
				<script type="text/javascript">
					$(function(){
						$("#sortUl").dragsort({
                            dragSelector:'li',
                            placeHolderTemplate: '<li class="draging-place">&nbsp;</li>',
                            dragEnd:function(){
                            	updateVal();
                            }
                        });

						$('#sortUl li b').click(function(){
                        	$(this).parent().remove();
                        	updateVal();
                        });

						// 更新排序后的隐藏域的值
                        function updateVal() {
                        	var sortVal = [];
                        	$('#sortUl li').each(function(){
                        		sortVal.push($('em',this).text());
                        	});
                            $("input[name='addons']").val(sortVal.join(','));
                        }
					})
				</script><?php endif; ?>
			</div>
			<span class="help-block col-xs-12 col-sm-reset inline">拖动后保存顺序，影响同一个钩子挂载的插件执行先后顺序</span>
		</div><?php endif; ?>
	<input type="hidden" name="id" value="<?php echo ($data["id"]); ?>">
<?php  echo ace_srbtn(); echo ace_form_close() ?>

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
	    
	<?php if(isset($data)): ?><script type="text/javascript" src="/aladdin/root/Public/static/jquery.dragsort-0.5.2.min.js"></script><?php endif; ?>
	<script type="text/javascript">
		$(function(){
			//导航高亮
			highlight_subnav('<?php echo U('Addons/hooks');?>');
		})
	</script>

    </body>
</html>
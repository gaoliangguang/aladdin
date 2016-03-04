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
        <?php if(is_array($__MENU__["main"])): $i = 0; $__LIST__ = $__MENU__["main"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu): $mod = ($i % 2 );++$i;?><li class="<?php if($menu['id'] == 2) :?>active open<?php endif;?>" id="menu-<?php echo ($menu["id"]); ?>">
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
        <?php if(is_array($nodes)): $i = 0; $__LIST__ = $nodes;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sub_menu): $mod = ($i % 2 );++$i;?><!-- 子导航 -->
            <?php if(!empty($sub_menu)): ?><li class="<?php if(($sub_menu['current']) == "1"): ?>active open<?php endif; ?>">
                    <a <?php if(!empty($sub_menu["_child"])): ?>class="dropdown-toggle" href="javascript:"<?php else: ?>href="<?php echo (U($sub_menu["url"])); ?>"<?php endif; ?>>
                        <i class="<?php echo ($sub_menu["groups"]); ?>"></i>
                        <span class="menu-text"><?php echo ($sub_menu["title"]); ?></span>
                        <?php if(!empty($sub_menu["_child"])): ?><b class="arrow icon-angle-down"></b><?php endif; ?>
                    </a>
                
                    <ul class="submenu <?php if(($sub_menu["current"]) != "1"): ?>open<?php endif; ?>">
                        <?php if(is_array($sub_menu['_child'])): $i = 0; $__LIST__ = $sub_menu['_child'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu): $mod = ($i % 2 );++$i;?><li <?php if($menu['id'] == $cate_id or $menu['current'] == 1): ?>class="active"<?php endif; ?>>
                                <?php if(($menu['allow_publish']) > "0"): ?><a class="item" href="<?php echo (U($menu["url"])); ?>"><i class="icon-double-angle-right"></i><?php echo ($menu["title"]); ?></a>
                                <?php else: ?>
                                <a class="item" href="javascript:void(0);"><i class="icon-double-angle-right"></i><?php echo ($menu["title"]); ?></a><?php endif; ?>
        
                                <!-- 一级子菜单 -->
                                <?php if(isset($menu['_child'])): ?><ul class="submenu" style="display: block;">
                                	<?php if(is_array($menu['_child'])): foreach($menu['_child'] as $key=>$three_menu): ?><li>
                                        <?php if(($three_menu['allow_publish']) > "0"): ?><a class="item" href="<?php echo (U($three_menu["url"])); ?>"><?php echo ($three_menu["title"]); ?></a><?php else: ?><a class="item" href="javascript:void(0);"><?php echo ($three_menu["title"]); ?></a><?php endif; ?>
                                        <!-- 二级子菜单 -->
                                        <?php if(isset($three_menu['_child'])): ?><ul class="submenu" style="display: block;">
                                        	<?php if(is_array($three_menu['_child'])): foreach($three_menu['_child'] as $key=>$four_menu): ?><li>
                                                <?php if(($four_menu['allow_publish']) > "0"): ?><a class="item" href="<?php echo U('index','cate_id='.$four_menu['id']);?>"><?php echo ($four_menu["title"]); ?></a><?php else: ?><a class="item" href="javascript:void(0);"><?php echo ($four_menu["title"]); ?></a><?php endif; ?>
                                                <!-- 三级子菜单 -->
                                                <?php if(isset($four_menu['_child'])): ?><ul class="submenu" style="display: block;">
                                                	<?php if(is_array($four_menu['_child'])): $i = 0; $__LIST__ = $four_menu['_child'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$five_menu): $mod = ($i % 2 );++$i;?><li>
                                                    	<?php if(($five_menu['allow_publish']) > "0"): ?><a class="item" href="<?php echo U('index','cate_id='.$five_menu['id']);?>"><?php echo ($five_menu["title"]); ?></a><?php else: ?><a class="item" href="javascript:void(0);"><?php echo ($five_menu["title"]); ?></a><?php endif; ?>
                                                    </li><?php endforeach; endif; else: echo "" ;endif; ?>
                                                </ul><?php endif; ?>
                                                <!-- end 三级子菜单 -->
                                            </li><?php endforeach; endif; ?>
                                        </ul><?php endif; ?>
                                        <!-- end 二级子菜单 -->
                                    </li><?php endforeach; endif; ?>
                                </ul><?php endif; ?>
                                <!-- end 一级子菜单 -->
                            </li><?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                </li><?php endif; ?>
            <!-- /子导航 --><?php endforeach; endif; else: echo "" ;endif; ?>
        <!-- 回收站 -->
    	<?php if(($show_recycle) == "1"): ?><li>
            <a href="<?php echo U('article/recycle');?>">
                <i class="icon-trash"></i>
                <span class="menu-text">回收站</span>
            </a>
        </li><?php endif; ?>
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
	                            
<!-- 标题 -->
<div class="page-header">
	<h1>

	<small>
    文档列表(<?php echo ($_total); ?>)
    [
	<?php if(!empty($rightNav)): if(is_array($rightNav)): $i = 0; $__LIST__ = $rightNav;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$nav): $mod = ($i % 2 );++$i;?><a href="<?php echo U('index','cate_id='.$nav['id']);?>"><?php echo ($nav["title"]); ?></a>
		<?php if(count($rightNav) > $i): ?><i class="ca"></i><?php endif; endforeach; endif; else: echo "" ;endif; ?>
	<?php if(isset($article)): ?>：<a href="<?php echo U('index','cate_id='.$cate_id.'&pid='.$article['id']);?>"><?php echo ($article["title"]); ?></a><?php endif; ?>
	<?php else: ?>
	<?php if(empty($position)): ?>全部<?php else: ?><a href="<?php echo U('article/index');?>">全部</a><?php endif; ?>
		<?php if(is_array(C("DOCUMENT_POSITION"))): foreach(C("DOCUMENT_POSITION") as $key=>$vo): if(($position) != $key): ?><a href="<?php echo U('index',array('position'=>$key));?>"><?php echo ($vo); ?></a><?php else: echo ($vo); endif; ?>&nbsp;<?php endforeach; endif; endif; ?>
	]
	<?php if(($allow) == "0"): ?>（该分类不允许发布内容）<?php endif; ?>
	<?php if(count($model) > 1): ?>[ 模型：<?php if(empty($model_id)): ?><strong>全部</strong><?php else: ?><a href="<?php echo U('index',array('pid'=>$pid,'cate_id'=>$cate_id));?>">全部</a><?php endif; ?>
		<?php if(is_array($model)): $i = 0; $__LIST__ = $model;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if(($model_id) != $vo): ?><a href="<?php echo U('index',array('pid'=>$pid,'cate_id'=>$cate_id,'model_id'=>$vo));?>"><?php echo (get_document_model($vo,'title')); ?></a><?php else: ?><strong><?php echo (get_document_model($vo,'title')); ?></strong><?php endif; ?>&nbsp;<?php endforeach; endif; else: echo "" ;endif; ?>
	]<?php endif; ?>
    <!--
	<?php if(!empty($groups)): ?>[ 分组：
        <?php if(empty($group_id)): ?><strong>全部</strong><?php else: ?><a href="<?php echo U('index',array('pid'=>$pid,'cate_id'=>$cate_id));?>">全部</a><?php endif; ?>
		<?php if(is_array($groups)): foreach($groups as $key=>$vo): if(($group_id) != $key): ?><a href="<?php echo U('index',array('pid'=>$pid,'cate_id'=>$cate_id,'model_id'=>$model_id,'group_id'=>$key));?>">
                <?php echo ($vo); ?>
            </a>
        <?php else: ?>
        <strong><?php echo ($vo); ?></strong><?php endif; ?>&nbsp;<?php endforeach; endif; ?>
	    ]<?php endif; ?>
    -->
	</small>
	</h1>
</div>

<!-- 数据表格 -->
<div class="table-responsive">
    <div class="dataTables_wrapper">   
        <div class="row">
            <form method="get" action="/aladdin/root/admin.php?s=/article/index.html" class="search-form">
                <div class="col-sm-12 row">
                    
                    <label>状&nbsp; &nbsp; &nbsp; &nbsp; 态： 
                       <?php  $status = array('所有','禁用','正常','待审核'); echo form_dropdown('status',$status,I('status'));s ?>
                    </label>
                    <label>
                		更新时间：
                		<input type="text" id="time-start" name="time-start" class="text input-2x" value="" placeholder="起始时间" /> -
                		<input type="text" id="time-end" name="time-end" class="text input-2x" value="" placeholder="结束时间" />
                	</label>
                	<label>
                		创建者：
                		<input type="text" name="nickname" class="text input-2x" value="" placeholder="请输入用户名">
                	</label>
                    <label>
                        <button class="btn btn-sm btn-primary" type="button" id="search-btn" url="/aladdin/root/admin.php?s=/article/index.html">
                           <i class="icon-search"></i>搜索
                        </button>
                    </label>
                </div>
            </form>
        </div>
        <table class="table table-striped table-bordered table-hover dataTable">
            <!-- 表头 -->
            <thead>
                <tr>
                    <th class="row-selected">
                       <label>
                           <input class="ace check-all" type="checkbox"/>
                           <span class="lbl"></span>
                       </label>
                    </th>
                    <?php if(is_array($list_grids)): $i = 0; $__LIST__ = $list_grids;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$field): $mod = ($i % 2 );++$i;?><th><?php echo ($field["title"]); ?></th><?php endforeach; endif; else: echo "" ;endif; ?>
                </tr>
            </thead>

            <!-- 列表 -->
            <tbody>
                <?php if(!empty($list)): if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?><tr>
                        <td>
                            <label>
                                <input class="ace ids" type="checkbox" name="ids[]" value="<?php echo ($data['id']); ?>" />
                                <span class="lbl"></span>
                            </label>
                        </td>
                        <?php if(is_array($list_grids)): $i = 0; $__LIST__ = $list_grids;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$grid): $mod = ($i % 2 );++$i;?><td><?php echo get_list_field($data,$grid);?></td><?php endforeach; endif; else: echo "" ;endif; ?>
                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                <?php else: ?>
                <tr><td colspan="9" class="text-center"> aOh! 暂时还没有内容! </td></tr><?php endif; ?>
            </tbody>
        </table>
        <div class="row">
            <div class="col-sm-12">
                <?php if(($allow) > "0"): ?><div class="btn-group">
                        <button style="border-width: 1px;" data-toggle="dropdown" class="btn btn-white document_add dropdown-toggle" <?php if(count($model) == 1): ?>url="<?php echo U('article/add',array('cate_id'=>$cate_id,'pid'=>I('pid',0),'model_id'=>$model[0],'group_id'=>$group_id));?>"<?php endif; ?>>
                            新 增
                            <?php if(count($model) > 1): ?><i class="icon-angle-down icon-on-right"></i><?php endif; ?>
                        </button>
                        <?php if(count($model) > 1): ?><ul class="dropdown-menu dropdown-danger nav-list">
                                <?php if(is_array($model)): $i = 0; $__LIST__ = $model;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><a href="<?php echo U('article/add',array('cate_id'=>$cate_id,'model_id'=>$vo,'pid'=>I('pid',0),'group_id'=>$group_id));?>"><?php echo (get_document_model($vo,'title')); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
                            </ul><?php endif; ?>
                    </div>
                    <?php else: ?>
                    <button class="btn btn-sm disabled" >新 增
                        <?php if(count($model) > 1): ?><i class="icon-angle-down icon-on-right"></i><?php endif; ?>
                    </button><?php endif; ?>
                <button style="border-width: 1px;" class="btn btn-white ajax-post" target-form="ids" url="<?php echo U("Article/setStatus",array("status"=>1));?>">启 用</button>
                <button class="btn btn-white ajax-post" target-form="ids" url="<?php echo U("Article/setStatus",array("status"=>0));?>">禁 用</button>
                <button class="btn btn-white ajax-post" target-form="ids" url="<?php echo U("Article/move");?>">移 动</button>
                <button class="btn btn-white ajax-post" target-form="ids" url="<?php echo U("Article/copy");?>">复 制</button>
                <button class="btn btn-white ajax-post" target-form="ids" hide-data="true" url="<?php echo U("Article/paste");?>">粘 贴</button>
                <input type="hidden" class="hide-data" name="cate_id" value="<?php echo ($cate_id); ?>"/>
                <input type="hidden" class="hide-data" name="pid" value="<?php echo ($pid); ?>"/>
                <button class="btn btn-white ajax-post confirm" target-form="ids" url="<?php echo U("Article/setStatus",array("status"=>-1));?>">删 除</button>
                <!-- <button class="btn document_add" url="<?php echo U('article/batchOperate',array('cate_id'=>$cate_id,'pid'=>I('pid',0)));?>">导入</button> -->
                <a class="btn btn-white list_sort" href="<?php echo U('sort',array('cate_id'=>$cate_id,'pid'=>I('pid',0)),'');?>">排序</a>
            </div>
            <div class="col-sm-12">
                                <div class="dataTables_paginate paging_bootstrap">
                    <ul class="pagination">
                    <?php echo ($_page); ?>
                    </ul>
                </div>
            </div>
        </div>
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
	    
<link href="/aladdin/root/Public/static/datetimepicker/css/dropdown.css" rel="stylesheet" type="text/css">
<link href="/aladdin/root/Public/static/datetimepicker/css/datetimepicker.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="/aladdin/root/Public/static/datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript" src="/aladdin/root/Public/static/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js" charset="UTF-8"></script>
<script type="text/javascript">
$(function(){

	/* 状态搜索子菜单 */
	$(".search-form").find(".drop-down").hover(function(){
		$("#sub-sch-menu").removeClass("hidden");
	},function(){
		$("#sub-sch-menu").addClass("hidden");
	});
	
	$("#sub-sch-menu li").find("a").each(function(){
		$(this).click(function(){
			var text = $(this).text();
			$("#sch-sort-txt").text(text).attr("data",$(this).attr("value"));
			$("#sub-sch-menu").addClass("hidden");
		})
	});

	//只有一个模型时，点击新增
	$('.document_add').click(function(){
		var url = $(this).attr('url');
		if(url != undefined && url != ''){
			window.location.href = url;
		}
	});

	//点击排序
	$('.list_sort').click(function(){
		var url = $(this).attr('url');
		var ids = $('.ids:checked');
		var param = '';
		if(ids.length > 0){
			var str = new Array();
			ids.each(function(){
				str.push($(this).val());
			});
			param = str.join(',');
		}

		if(url != undefined && url != ''){
			window.location.href = url + '/ids/' + param;
		}
	});

    //回车自动提交
    $('.search-form').find('input').keyup(function(event){
        if(event.keyCode===13){
            $("#search").click();
        }
    });

    $('#time-start').datetimepicker({
        format: 'yyyy-mm-dd',
        language:"zh-CN",
	    minView:2,
	    autoclose:true
    });

    $('#time-end').datetimepicker({
        format: 'yyyy-mm-dd',
        language:"zh-CN",
	    minView:2,
	    autoclose:true
    });
})
</script>

    </body>
</html>
<!DOCTYPE html>
<html lang="cn">
    <head>
        <meta charset="utf-8" />
        
        <title>{$meta_title}<notempty name="meta_title">|{:C('WEB_SITE_TITLE')}</notempty></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <!-- basic styles -->
        <link rel="stylesheet" href="__ACE__/css/bootstrap.min.css"/>
        <link rel="stylesheet" href="__ACE__/css/font-awesome.min.css" />

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
    </head>
    
	<body>	

    <div class="main-container" id="main-container">
			

        <div class="main-container-inner">
            <div class="row">
                <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS -->

                    <div class="error-container">
                        <div class="well">
                            <h1 class="grey lighter smaller">
                                <span class="blue bigger-125">
                                    <i class="icon-random"></i>

                                </span>
                                非常抱歉
                            </h1>

                            <hr>
                            <h3 class="lighter smaller"><?php echo($error); ?>
                            </h3>

                            <div class="space"></div>


                            <hr>
                            <div class="space"></div>

                            <div class="center">
                                <a  class="btn btn-grey" href="<?php echo($jumpUrl); ?>">
                                    <i class="icon-arrow-left"></i>
                            返回
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- PAGE CONTENT ENDS -->
                </div><!-- /.col -->
            </div><!-- /.row -->
            <!-- /#ace-settings-container -->
        </div><!-- /.main-container-inner -->

        <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
            <i class="icon-double-angle-up icon-only bigger-110"></i>
        </a>
    </div><!-- /.main-container -->

    <!-- basic scripts -->

    <!--[if !IE]> -->
</body>

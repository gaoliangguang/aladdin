<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>欢迎您登录{:C('WEB_SITE_TITLE')}</title>
        <meta name="keywords" content="Bootstrap" />
        <meta name="description" content="" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <!-- basic styles -->

        <link rel="stylesheet" href="__ACE__/css/bootstrap.min.css" rel="stylesheet" />
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
        <style>
            body{overflow: hidden;}
            #login_bg {
              position: absolute;
              z-index: -1;
            }
        </style>
        <!--[if lte IE 8]>
          <link rel="stylesheet" href="__ACE__/css/ace-ie.min.css" />
        <![endif]-->

        <!-- inline styles related to this page -->

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->

        <!--[if lt IE 9]>
        <script src="__ACE__/js/html5shiv.js"></script>
        <script src="__ACE__/js/respond.min.js"></script>
        <![endif]-->
    </head>

    <body class="login-layout" id="login-page">
        <div id="login_bg"><img src="" alt="" style="display: none;" /></div>
        <div class="main-container">
            <div class="main-content">
                <div class="row">
                    <div class="col-sm-10 col-sm-offset-1">
                        <div class="login-container">
                            <div class="center">
                                <h1>
                                    <img alt="" src="__IMG__/login_logo.png" style="margin-bottom: 6px;">
                                    <span class="white">{:C('WEB_SITE_TITLE')}</span>
                                </h1>
                                <h4 class="blue">&copy; 创金谷</h4>
                            </div>

                            <div class="space-6"></div>

                            <div class="position-relative">
                                <div id="login-box" class="login-box visible widget-box no-border">
                                    <div class="widget-body">
                                        <div class="widget-main">
                                            <h4 class="header blue lighter bigger">
                                                <i class="icon-coffee green"></i> 请输入您的登录信息
                                            </h4>

                                            <div class="space-6"></div>

                                            <form action="{:U('login')}" method="post">
                                                <fieldset>
                                                    <label class="block clearfix">
                                                        <span class="block input-icon input-icon-right">
                                                            <input type="text" class="form-control" autocomplete="off" placeholder="请填写用户名" name="username">
                                                            <i class="icon-user"></i>
                                                        </span>
                                                    </label>

                                                    <label class="block clearfix">
                                                        <span class="block input-icon input-icon-right">
                                                            <input type="password" class="form-control" autocomplete="off" placeholder="请填写密码" name="password">
                                                            <i class="icon-lock"></i>
                                                        </span>
                                                    </label>
                                                    
                                                    <label class="block clearfix">
                                                        <span class="block input-icon input-icon-right">
                                                            <input type="text" class="form-control" autocomplete="off" placeholder="请填写验证码" name="verify">
                                                            <i class="icon-certificate"></i>
                                                        </span>
                                                    </label>
                                                    
                                                    <label class="block clearfix">
                                                        <span class="block input-icon input-icon-right">
                                                            <img class="verifyimg reloadverify" style="width: 100%" src="{:U('Public/verify')}" title="看不清，点击换一张">
                                                        </span>
                                                    </label>
                                                    
                                                    <div class="space"></div>

                                                    <div class="clearfix">
                                                        <button type="reset" class="width-30 pull-left btn btn-sm">
                                                            <i class="icon-refresh"></i> 重置
                                                        </button>

                                                        <button type="submit" class="width-65 pull-right btn btn-sm btn-success">
                                                            <span>登录</span><i class="icon-arrow-right icon-on-right"></i>
                                                        </button>
                                                    </div>

                                                    <div class="space-4"></div>
                                                </fieldset>
                                            </form>
                                        </div><!-- /widget-main -->

<!--                                         <div class="toolbar clearfix"> -->
<!--                                             <div> -->
<!--                                                 <a href="#" onclick="show_box('forgot-box'); return false;" class="forgot-password-link"> -->
<!--                                                     <i class="icon-arrow-left"></i> 首次登录/忘记密码 -->
<!--                                                 </a> -->
<!--                                             </div> -->

<!--                                             <div> -->
<!--                                             </div> -->
<!--                                         </div> -->
                                    </div><!-- /widget-body -->
                                </div><!-- /login-box -->

                                <div id="forgot-box" class="forgot-box widget-box no-border">
                                    <div class="widget-body">
                                        <div class="widget-main">
                                            <h4 class="header red lighter bigger">
                                                <i class="icon-key"></i> 重置密码
                                            </h4>

                                            <form action="{:U('resetpwd')}" method="post">
                                                <fieldset>
                                                    <label class="block clearfix">
                                                        <span class="block input-icon input-icon-right">
                                                            <input type="text" class="form-control mobile" maxlength="11" autocomplete="off" placeholder="请填写手机号码" name="username">
                                                            <i class="icon-mobile-phone"></i>
                                                        </span>
                                                    </label>
                                                    
                                                    <label class="input-group">
                                                        <input type="text" maxlength="6" autocomplete="off" placeholder="请填写手机验证码" class="form-control input-mask-date only-num" name="verify">
                                                        <span class="input-group-btn">
                                                            <button class="btn btn-sm btn-danger get-sms-code" type="button">
                                                                <i class="icon-lightbulb"></i>
                                                                <span>获取验证码</span>
                                                            </button>
                                                        </span>
                                                    </label>
                                                    
                                                    <label class="block clearfix">
                                                        <span class="block input-icon input-icon-right">
                                                            <input type="password" maxlength="20" class="form-control" autocomplete="off" placeholder="请填写新密码" name="password">
                                                            <i class="icon-lock"></i>
                                                        </span>
                                                    </label>
                                                    
                                                    <label class="block clearfix">
                                                        <span class="block input-icon input-icon-right">
                                                            <input type="password" maxlength="20" autocomplete="off" placeholder="请填写确认密码" name="rpassword" class="form-control">
                                                            <i class="icon-retweet"></i>
                                                        </span>
                                                    </label>
                                                    
                                                    <div class="clearfix">

                                                        <button class="width-30 pull-left btn btn-sm reg-reset-btn" type="reset">
                                                            <i class="icon-refresh"></i>
                                                            <span>重置</span>
                                                        </button>
                                                        
                                                        <button class="width-65 pull-right btn btn-sm btn-danger" type="submit">
                                                            <i class="icon-key"></i>
                                                            <span>提交</span>
                                                        </button>
                                                    </div>
                                                </fieldset>
                                            </form>
                                        </div><!-- /widget-main -->

                                        <div class="toolbar center">
                                            <a href="#" onclick="show_box('login-box'); return false;" class="back-to-login-link">
                                                <span>返回登录</span> <i class="icon-arrow-right"></i>
                                            </a>
                                        </div>
                                    </div><!-- /widget-body -->
                                </div><!-- /forgot-box -->

                                <div id="signup-box" class="signup-box widget-box no-border">
                                    <div class="widget-body">
                                        <div class="widget-main">
                                            <h4 class="header green lighter bigger">
                                                <i class="icon-group blue"></i>手机短信验证码登录
                                            </h4>

                                            <div class="space-6"></div>
                                            <p> 请输入您的登录信息: </p>

                                            <form action="{:U('login2')}" method="post">
                                                <fieldset>
                                                    <label class="block clearfix">
                                                        <span class="block input-icon input-icon-right">
                                                            <input type="text" class="form-control mobile" maxlength="11" autocomplete="off" placeholder="请填写手机号码" name="username">
                                                            <i class="icon-mobile-phone"></i>
                                                        </span>
                                                    </label>
                                                    
                                                    <label class="input-group">
                                                        <input type="text" maxlength="6" autocomplete="off" placeholder="请填写手机验证码" class="form-control input-mask-date only-num" name="verify">
                                                        <span class="input-group-btn">
                                                            <button class="btn btn-sm btn-danger get-sms-code" type="button">
                                                                <i class="icon-lightbulb"></i>
                                                                <span>获取验证码</span>
                                                            </button>
                                                        </span>
                                                    </label>

                                                    <div class="space-24"></div>

                                                    <div class="clearfix">
                                                        <button type="reset" class="width-30 pull-left btn btn-sm">
                                                            <i class="icon-refresh"></i> 重置
                                                        </button>

                                                        <button type="submit" class="width-65 pull-right btn btn-sm btn-success">
                                                            <span>登录</span><i class="icon-arrow-right icon-on-right"></i>
                                                        </button>
                                                    </div>
                                                </fieldset>
                                            </form>
                                        </div>

<!--                                         <div class="toolbar center"> -->
<!--                                             <a href="#" onclick="show_box('login-box'); return false;" class="back-to-login-link"> -->
<!--                                                 <i class="icon-arrow-left"></i> -->
<!--                                                 Back to login -->
<!--                                             </a> -->
<!--                                         </div> -->
                                    </div><!-- /widget-body -->
                                </div><!-- /signup-box -->
                            </div><!-- /position-relative -->
                        </div>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div>
        </div><!-- /.main-container -->
	<!--[if lt IE 9]>
    <script type="text/javascript" src="__STATIC__/jquery-1.10.2.min.js"></script>
    <![endif]-->
    <!--[if gte IE 9]><!-->
    <script type="text/javascript" src="__STATIC__/jquery-2.0.3.min.js"></script>
    <!--<![endif]-->
    <script type="text/javascript">
        if("ontouchend" in document) document.write("<script src='__ACE__/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
    </script>
    
    <script src="__STATIC__/respond.js"></script>
    <script type="text/javascript" src="__STATIC__/layer/layer.min.js"></script>
    <script type="text/javascript" src="__STATIC__/common.js"></script>

    <!-- inline scripts related to this page -->

    <script type="text/javascript">
        function show_box(id) {
			jQuery('.widget-box.visible').removeClass('visible');
			jQuery('#'+id).addClass('visible');
        }
        var loading;

    	//表单提交
    	$("form").submit(function(){
    		var self = $(this);
    		$("button:submit").addClass("log-in").attr("disabled", true);
            loading = layer.load();
            
    		$.post(self.attr("action"), self.serialize(), success, "json").always(function(){

                $("button:submit").removeClass("log-in").attr("disabled", false);
                layer.close(loading);
            });;
    		return false;

    		function success(data){
    			if(data.status){
    				layer.msg(data.info,{icon:1},function(){
    					window.location.href = data.url;
    				});
    			} else {
    				if(data.url != ''){
    					layer.msg(data.info,{icon:2},function(){
                            show_box("signup-box");
    					});
    				}else{
    					layer.alert(data.info,{icon:2});
    				}
    				//刷新验证码
    				$(".reloadverify").click();
    			}
    		}
    	})

		$(function(){
			//初始化选中手机号码输入框
			$("#login-box").find("input[name=username]").focus();
			//刷新验证码
			var verifyimg = $(".verifyimg").attr("src");
            $(".reloadverify").click(function(){
                if( verifyimg.indexOf('?')>0){
                    $(".verifyimg").attr("src", verifyimg+'&random='+Math.random());
                }else{
                    $(".verifyimg").attr("src", verifyimg.replace(/\?.*$/,'')+'?'+Math.random());
                }
            });
            
            $(".get-sms-code").click(function(){
                var mobile = $(this).closest('form').find("input[name=username]").val();
                if(/^1\d{10}$/.test(mobile)){
                    $.post("{:U('getAuthCode')}",{mobile:mobile}).done(function(resp){
                        if(resp.status == 1){
                            layer.msg(resp.info,{icon:1});
                        }else{
                            layer.alert(resp.info,{icon:2});
                        }
                    }).fail(function(){
                        
                        layer.alert('验证码获取失败！',{icon:2});
                    });
                }else{
                	layer.alert('请输入正确的手机号码！',{icon:2});
                }
            });
            
            //随机背景
            //setInterval(function(){
            //},3000)
            var list = ['1.jpg','2.jpg','3.jpg'];
            
            var ranNum=parseInt((list.length)*Math.random());
            var src = '__ACE__/images/background/'+list[ranNum];
            $.get(src,function(){
                $("#login_bg img").attr('src',src).fadeIn(500);
            });
            
            //屏幕自适应
            $(window).resize(change)
                
            change();
            function change(){
                var w=$(window).width();
                var h=$(window).height();
                $("#login_bg img,#lay").css({
                    'width':w,
                    'height':h
                    })
                $("#login_bg img").animate({opacity:1})
                $("#login_box").css({
                    'left':(w-364)/2,
                    'top':(h-264)/2
                })
            }
		});
    </script>
    </body>
</html>

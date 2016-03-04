<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.thinkphp.cn>
// +----------------------------------------------------------------------

/**
 * 前台配置文件
 * 所有除开系统级别的前台配置
 */
return array(
    'APPINFO'              => array(
        'appId'=>'accountant_portal',
        'appKey'=>'1234567890',
    ),
    'APIURI'               =>[
                            ],
    'SMS_EXPIRE'           => 600, // 短信验证码过期时间
    'SMS_API'              => array(
                                    'url'=>'http://115.29.211.3:8094/SMSSenderGateway/sms/send',
                                    'user'=>'imap',
                                    'password'=>'imapsmsgd',
                                    'content'=>'您的短信验证是%s，有效期10分钟！',
				                    "gatewayId"=>"GUODU",
                                ), //SMS接口地址和账号信息

    'URL_CASE_INSENSITIVE' => true, //默认false 表示URL区分大小写 true则表示不区分大小写
    
    /* 数据缓存设置 */
    'DATA_CACHE_PREFIX'    => 'collect_', // 缓存前缀
    'DATA_CACHE_TYPE'      => 'File', // 数据缓存类型
    'URL_MODEL'            => 3, //URL模式
    
    /* 全局过滤配置 */
    'DEFAULT_FILTER' => '', //全局过滤函数
    'DEFAULT_THEME'    =>    'ace',
        
    /* 文件上传相关配置 */
    'DOWNLOAD_UPLOAD' => array(
        'mimes'    => '', //允许上传的文件MiMe类型
        'maxSize'  => 5*1024*1024, //上传的文件大小限制 (0-不做限制)
        'exts'     => 'jpg,gif,png,jpeg,zip,rar,tar,gz,7z,doc,docx,txt,xls', //允许上传的文件后缀
        'autoSub'  => true, //自动子目录保存文件
        'subName'  => array('date', 'Y-m-d'), //子目录创建方式，[0]-函数名，[1]-参数，多个参数使用数组
        'rootPath' => SITE_PATH.'/Uploads/Download/', //保存根路径
		'urlPath'  => '/Uploads/Download/', //url访问根目录
        'savePath' => '', //保存路径
        'saveName' => array('uniqid', ''), //上传文件命名规则，[0]-函数名，[1]-参数，多个参数使用数组
        'saveExt'  => '', //文件保存后缀，空则使用原后缀
        'replace'  => false, //存在同名是否覆盖
        'hash'     => true, //是否生成hash编码
        'callback' => false, //检测文件是否存在回调函数，如果存在返回文件信息数组
    ), //下载模型上传配置（文件上传类配置）

    /* 图片上传相关配置 */
    'PICTURE_UPLOAD' => array(
		'mimes'    => '', //允许上传的文件MiMe类型
		'maxSize'  => 2*1024*1024, //上传的文件大小限制 (0-不做限制)
		'exts'     => 'jpg,gif,png,jpeg', //允许上传的文件后缀
		'autoSub'  => true, //自动子目录保存文件
//		'subName'  => array('date', 'Y-m-d'), //子目录创建方式，[0]-函数名，[1]-参数，多个参数使用数组
        'subName'  => '',
		'rootPath' => '', //保存根路径
		'urlPath'  => '', //url访问根目录
		'savePath' => '', //保存路径
		'saveName' => array('uniqid', ''), //上传文件命名规则，[0]-函数名，[1]-参数，多个参数使用数组
		'saveExt'  => '', //文件保存后缀，空则使用原后缀
		'replace'  => false, //存在同名是否覆盖
		'hash'     => true, //是否生成hash编码
		'callback' => false, //检测文件是否存在回调函数，如果存在返回文件信息数组
    ), //图片上传相关配置（文件上传类配置）

    'PICTURE_UPLOAD_DRIVER'=>'qiniu',
    //本地上传文件驱动配置
    'UPLOAD_LOCAL_CONFIG'=>array(),
    'UPLOAD_BCS_CONFIG'=>array(
        'AccessKey'=>'=',
        'SecretKey'=>'=',
        'bucket'=>'=',
        'rename'=>true
    ),
    'UPLOAD_QINIU_CONFIG'=>array(
        'accessKey'=>'6EZmwsqQYeHvlaA44_LwiBAePez-rjpOv4jwg4t4',
        'secrectKey'=>'nFJExmiVlpJnPD5l02hLAPjJ8rnfgvCrjR3Ve0Nj',
        'bucket'=>'xianlian',
        'domain'=>'7xnpxw.com2.z0.glb.qiniucdn.com',
        'timeout'=>3600,
    ),


    /* 编辑器图片上传相关配置 */
    'EDITOR_UPLOAD' => array(
		'mimes'    => '', //允许上传的文件MiMe类型
		'maxSize'  => 2*1024*1024, //上传的文件大小限制 (0-不做限制)
		'exts'     => 'jpg,gif,png,jpeg', //允许上传的文件后缀
		'autoSub'  => true, //自动子目录保存文件
		'subName'  => array('date', 'Y-m-d'), //子目录创建方式，[0]-函数名，[1]-参数，多个参数使用数组
		'rootPath' => SITE_PATH.'/Uploads/Editor/', //保存根路径
		'urlPath'  => '/Uploads/Editor/', //url访问根目录
		'savePath' => '', //保存路径
		'saveName' => array('uniqid', ''), //上传文件命名规则，[0]-函数名，[1]-参数，多个参数使用数组
		'saveExt'  => '', //文件保存后缀，空则使用原后缀
		'replace'  => false, //存在同名是否覆盖
		'hash'     => true, //是否生成hash编码
		'callback' => false, //检测文件是否存在回调函数，如果存在返回文件信息数组
    ),

    /* 模板相关配置 */
    'TMPL_PARSE_STRING' => array(
            '__PUBLIC__' => __ROOT__ . '/Public',
            '__STATIC__' => __ROOT__ . '/Public/static',
            '__ADDONS__' => __ROOT__ . '/Public/' . MODULE_NAME . '/Addons',
            '__IMG__'    => __ROOT__ . '/Public/' . MODULE_NAME . '/images',
            '__CSS__'    => __ROOT__ . '/Public/' . MODULE_NAME . '/css',
            '__JS__'     => __ROOT__ . '/Public/' . MODULE_NAME . '/js',
            '__ACE__'    => __ROOT__ . '/Public/Ace',
    ),

    /* SESSION 和 COOKIE 配置 */
	'SESSION_PREFIX' => 'onethink_admin', //session前缀
//     'SESSION_TYPE'  => 'redis',
    'REDIS_AUTH'    => '',
    'SESSION_NAMESPACE' => 'adminbaby_session',
    'COOKIE_PREFIX'  => 'onethink_admin_', // Cookie前缀 避免冲突
    'VAR_SESSION_ID' => 'session_id',	//修复uploadify插件无法传递session_id的bug

    /* 后台错误页面模板 */
    'TMPL_ACTION_ERROR'     =>  MODULE_PATH.'View/Public/error.php', // 默认错误跳转对应的模板文件
    'TMPL_ACTION_SUCCESS'   =>  MODULE_PATH.'View/Public/success.php', // 默认成功跳转对应的模板文件
    'TMPL_EXCEPTION_FILE'   =>  MODULE_PATH.'View/Public/exception.php',// 异常页面的模板文件
    

);

<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------
namespace Admin\Controller;

/**
 * 模型数据管理控制器
 * @author 麦当苗儿 <zuojiazi@vip.qq.com>
 */
class BannerController extends ThinkController {

    public function index($p=0){

        $this->assign('active_menu','banner/index');
        $this->lists('xxfb_advertisement',$p,[]);
    }

    public function add(){
        $_POST['insert_time'] = time_format();
        parent::add(22,'banner/index');
    }

    public function edit($id = 0){
        $this->assign('active_menu','banner/index');
        parent::edit(22,$id,'banner/index');
    }
}
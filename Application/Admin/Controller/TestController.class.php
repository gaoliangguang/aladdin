<?php
namespace Admin\Controller;
use Think\Controller;
// +----------------------------------------------------------------------
// | Date:2016年2月23日
// +----------------------------------------------------------------------
// | Author: EK_熊<1439527494@qq.com>
// +----------------------------------------------------------------------
// | Description: 此文件作用于****
// +----------------------------------------------------------------------
class TestController extends Controller{
    
    public function index(){
        $test = M('ConfigCommon')->select();
        dump($test);
    }
    
}
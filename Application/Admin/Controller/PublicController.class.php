<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------

namespace Admin\Controller;
use User\Api\UserApi;

/**
 * 后台首页控制器
 * @author 麦当苗儿 <zuojiazi@vip.qq.com>
 */
class PublicController extends \Think\Controller {

    /**
     * 后台用户登录
     * @author 麦当苗儿 <zuojiazi@vip.qq.com>
     */
    public function login($username = null, $password = null, $verify = null){
        if(IS_POST){
            /* 检测验证码 TODO: */
            if(!check_verify($verify)){
                $this->error('验证码输入错误！');
            }

            /* 调用UC登录接口登录 */
            $User = new UserApi;
            $uid = $User->login($username, $password);
            if(0 < $uid){ //UC登录成功
                /* 登录用户 */
                $Member = D('Member');
                if($Member->login($uid)){ //登录用户
                    //TODO:跳转到登录前页面
                    $this->success('登录成功！', U('Index/index'));
                } else {
                    $this->error($Member->getError());
                }

            } else { //登录失败
                switch($uid) {
                    case -1: $error = '用户不存在或被禁用！'; break; //系统级别禁用
                    case -2: $error = '密码错误！'; break;
                    default: $error = '未知错误！'; break; // 0-接口参数错误（调试阶段使用）
                }
                $this->error($error);
            }
        } else {
            if(is_login()){
                $this->redirect('Index/index');
            }else{
                /* 读取数据库中的配置 */
                $config	=	S('DB_CONFIG_DATA');
                if(!$config){
                    $config	=	D('Config')->lists();
                    S('DB_CONFIG_DATA',$config);
                }
                C($config); //添加配置
                
                $this->display();
            }
        }
    }

    /* 退出登录 */
    public function logout(){
        if(is_login()){
            D('Member')->logout();
            session('[destroy]');
            $this->success('退出成功！', U('login'));
        } else {
            $this->redirect('login');
        }
    }

    public function verify(){
        $verify = new \Think\Verify(['length'=>4]);
        $verify->entry(1);
	exit;
    }

    /**
     * 获取验证码
     */
    public function getAuthCode(){
        $mobileNum = I('post.mobile');
        if(!preg_match("/^1[0-9]{10}$/",$mobileNum)){
            $this->error('请输入正确的手机号码');
        }
        
        $api    = new \Admin\Service\ApiService();
        
        $data   = C('SMS_API');
        $url    = array_shift($data);
        $code   = mt_rand(1000,9999);
        //将短信验证码、手机、创建时间保存至会话中
        session('sms-autu-info',array('code'=>$code,'mobile'=>$mobileNum,'time'=>time()));
        $data['mobileNum']  = $mobileNum;
        //$data['content']    = urlencode(sprintf($data['content'],$code));
        $data['content']    = sprintf($data['content'],$code);
        $resp = $api->setApiUrl($url)->setData2($data,FALSE)->send('');
       
        if($resp['errcode'] == 0){ 
            $this->success('发送验证码成功！');
        }else{
            $this->error($api->errmsg);
        }
    }

}

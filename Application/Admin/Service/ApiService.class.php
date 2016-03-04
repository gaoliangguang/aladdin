<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 王雪兵 <406964108@qq.com>
// +----------------------------------------------------------------------
namespace Admin\Service;
use Think\Log;

class ApiService{
    private $api_url;
    
    protected $data;
    public $errcode=-1;
    public $errmsg='接口调用发生错误,请联系管理员!';
    public $error;
    
    public function __construct($api_url=''){
        $this->api_url = $api_url;
    }
    
    public function setApiUrl($url){
        $this->api_url = $url;
        return $this;
    }
    
    public function setData(Array $data=array(),$flag=TRUE){

        $data = ['body'=>$data];

        if($flag && !array_key_exists('app',$data)){
            $data['app'] = get_app();
        }
    
        $this->data = json_encode($data,JSON_UNESCAPED_UNICODE);
        return $this;
    }

    public function setData2(Array $data=array(),$flag=true){

        if($flag && !array_key_exists('app',$data)){
            $data['app'] = get_app();
        }

        $this->data = json_encode($data,JSON_UNESCAPED_UNICODE);
        return $this;
    }
    
    public function send($path){

        Log::write('发送URL:'.$this->api_url.$path,'INFO');
        Log::write('发送数据:'.$this->data,'INFO');
        $resp = curlRequest($this->api_url.$path,$this->data);
        Log::write('收到数据:'.$resp,'INFO');
    
        return json_to_array($resp);
    }
}
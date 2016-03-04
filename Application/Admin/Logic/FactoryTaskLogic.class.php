<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: huajie <banhuajie@163.com>
// +----------------------------------------------------------------------

namespace Admin\Logic;
use Think\Model;

/**
 * 应用模型
 */
class FactoryTaskLogic extends Model{

    /* 自动验证规则 */
    protected $_validate = array(
        array('productId', 'require', '产品ID不能为空', self::MUST_VALIDATE , 'regex', self::MODEL_INSERT),
        array('productName', 'require', '产品名称不能为空', self::MUST_VALIDATE , 'regex', self::MODEL_INSERT),
        array('taskName', 'require', '任务名称不能为空', self::MUST_VALIDATE , 'regex', self::MODEL_INSERT),
        array('amount', 'require', '制作号码数量不能为空', self::MUST_VALIDATE , 'regex', self::MODEL_BOTH),
        array('amount', '/^[0-9]*$/', '制作号码数量不合法，只能输入数字', self::VALUE_VALIDATE, 'regex', self::MODEL_BOTH),
    );

    /* 自动完成规则 */
    protected $_auto = array(
        array('status', 'CRT', self::MODEL_INSERT, 'string'),
        array('startTime', 'time_format', self::MODEL_INSERT, 'function'),
        array('amount', 'getAmount', self::MODEL_INSERT, 'callback'),
    );

    protected function getAmount(){
        $amount = I('post.amount');
        return intval($amount * 10000);
    }
    
    /**
     * 新增或更新一个文档
     * @return boolean fasle 失败 ， int  成功 返回完整的数据
     * @author huajie <banhuajie@163.com>
     */
    public function addNew(){
        $data = $this->create('',self::MODEL_INSERT);
        
        if(empty($data)){
            return false;
        }

        /* 添加内容 */
        if(empty($this->add())){
            $this->error = '新增任务出错！';
            return false;
        }
        //内容添加或更新完成
        return $data;
    }
}
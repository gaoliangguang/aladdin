<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 王雪兵 <406964108@qq.com>
// +----------------------------------------------------------------------

namespace Admin\Controller;

use Admin\Service\ApiService;
/**
 * 分期管理控制器
 * @author 王雪兵 <406964108@qq.com>
 */
class FactoryController extends AdminController {

    protected function _initialize(){
        
        parent::_initialize();
    }
    
    /**
     * 分期卡账户管理首页
     * @author 王雪兵 <406964108@qq.com>
     */
    public function accountlist(){

        $REQUEST    =   (array)I('request.');
        
        $where      = array();
        $status     = I('get.status',0,'intval');
        $status_list = array(
                            '0'=>'--所有--',
                            'NUS'=>'未使用',
                            'USD'=>'已使用',
                            'NAV'=>'不可用',
                            'VIP'=>'VIP'
                        );
        
        $status_keys = array_keys($status_list);
        if($status AND array_key_exists($status, $status_keys)){
            $where['status'] = $status_keys[$status];
        }
        $accountType     = I('get.accountType',0,'intval');
        $accountTypeList = array(
                            '0'=>'--所有--',
                            'PA#'=>'资金账户',
                            'PP#'=>'工程款账户',
                        );
        
        $type_keys = array_keys($accountTypeList);
        if($accountType AND array_key_exists($accountType, $type_keys)){
            $where['accountType'] = $type_keys[$accountType];
        }
        
        $accountId = I('get.accountId');
        if(!empty($accountId)){
            $where['accountId'] = array('like', '%'.(string)$accountId.'%');
        }
        
        $list = $this->lists('factory_account_id',$where);
        
        $this->assign('_list', $list);
        $this->assign('status_list', $status_list);
        $this->assign('accountTypeList', $accountTypeList);
        $statusCcList = array(
                'NUS'=>'未使用',
                'NAV'=>'不可用',
                'VIP'=>'VIP'
        );
        $this->assign('statusCcList',$statusCcList);
        
        $this->meta_title = '营销账号管理';
        
        $this->display();
    }

    public function changeStatus($method=null){
        $id = I('id',array());
        if ( empty($id) ) {
            $this->error('请选择要操作的数据!');
        }

        $statusCcList = array(
                'NUS',
                'NAV',
                'VIP'
        );
        $where = array('accountId'=>array('in',$id),'status'=>array('in',$statusCcList));
        $data = array('status'=>$method);
        $this->editRow('factory_account_id', $data, $where);
    }
    
    /**
     * 分期卡产品管理首页
     * @author 王雪兵 <406964108@qq.com>
     */
    public function tasklist(){

        $REQUEST    =   (array)I('request.');

        $where      = array();
        $status     = I('get.status',0,'intval');
        $status_list = array(
            '0'=>'--所有--',
            'CRT'=>'创建任务',
            'DNG'=>'执行中',
            'OK#'=>'执行完成',
            'DEL'=>'任务撤销',
            'FLS'=>'执行失败'
        );
        $status_keys = array_keys($status_list);
        if($status AND array_key_exists($status, $status_keys)){
            $where['status'] = $status_keys[$status];
        }

        $list       = $this->lists('factory_task',$where);

        $this->assign('_list', $list);
        $this->assign('status_list', $status_list);

        $this->meta_title = '任务管理';

        $this->display();
    }
    
    /**
     * 
     */
    public function addTask(){
        if(IS_POST){
            $model = D('FactoryTask','Logic');

            $id = $model->addNew();
            if($id){
                //TODO通知java接口
                $api = new ApiService();
                $api->send('console/accountGenerationTrigger');
                
                $this->success('新增成功', U('factory/tasklist'));
            } else {
                $this->error($model->getError());
            }
        }
        
        $accountTypeList = M('account_id_prefix')->getField('accountType,name');
        $productList = array();
        foreach (M('product')->getField('productId,ProductName,accountType') as $product){
            $productList[$product['accounttype']][] = $product;
        }
        $unit_list = M('unit_id')->getField('unitid,name');
        $unit_list = is_array($unit_list) ? $unit_list : array();
        $this->assign('unit_list',$unit_list);
        $this->assign('productList',json_encode($productList));
        $this->assign('accountTypeList',$accountTypeList);
        $this->meta_title = '新增任务';
        $this->display();
    }
}

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
class PfcapitalController extends AdminController {

    /**
     * 交易列表
     */
    public function dealindex(){

        $where = [
        ];

        $order_id = I('order_id','','trim');
        if(!empty($order_id)){
            $where['a.order_id'] = ['like', '%'.(string)$order_id.'%'];
        }

        $flow_direction = I('flow_direction','','trim');
        if(!empty($flow_direction)){
            $where['a.flow_direction'] = $flow_direction;
        }


        $type = I('type','','trim');
        if(!empty($type)){
            $where['a.type'] = $type;
        }

        $order_id = I('order_id','','trim');
        if(!empty($order_id)){
            $where['a.order_id'] = ['like', '%'.(string)$order_id.'%'];
        }

        $prefix = C('DB_PREFIX');
        $model = M()->table($prefix.'project_payment_account_order a');

        $fields = 'a.*';

        $list = $this->lists($model,$where,'a.insert_time desc',$fields);
        $this->assign('list',$list);

        $this->meta_title = '交易管理';

        $this->assign('type_array',['SGC'=>'平台方收工程款','FGC'=>'平台方付工程款']);
        $this->assign('flow_array',['IN#'=>'转入','OUT'=>'转出']);
        $this->display();
    }

    /**
     * 交易详情
     */
    public function viewdeal($order_id=''){

        $where = [
            'order_id'=>$order_id
        ];

        $prefix = C('DB_PREFIX');
        $model = M()->table($prefix.'project_payment_account_order a');

        $fields = 'a.*';

        $this->assign('item',$model->where($where)->field($fields)->find());
        $this->meta_title = '交易管理详情';

        $this->assign('type_array',['SGC'=>'平台方收工程款','FGC'=>'平台方付工程款']);
        $this->assign('flow_array',['IN#'=>'转入','OUT'=>'转出']);
        $this->display();
    }

    /**
     * 正在招标中的列表
     */
    public function danbaoindex(){

        $where = [
        ];

        $order_id = I('order_id','','trim');
        if(!empty($order_id)){
            $where['a.order_id'] = ['like', '%'.(string)$order_id.'%'];
        }

        $object_no = I('object_no','','trim');
        if(!empty($object_no)){
            $where['c.object_no'] = ['like', '%'.(string)$object_no.'%'];
        }

        $prefix = C('DB_PREFIX');
        $model = M()->table($prefix.'ztgl_object_bond_record a')
            ->join($prefix.'qyzz_bidder b on b.id = a.company_id')
            ->join($prefix.'ztgl_object c on c.object_id = a.object_id')
            ->join($prefix.'user d on d.id = b.user_id');

        $fields = 'a.*,
                    c.object_no,
                    c.object_name,
                    d.mobile_num';

        $list = $this->lists($model,$where,'a.insert_time desc',$fields);
        $this->assign('list',$list);

        $this->meta_title = '撮合担保金管理';

        $this->assign('type_array',['FOZ'=>'冻结(投标)','PAY'=>'缴纳(中标)','REV'=>'返还(未中标)']);
        $this->display();
    }

    /**
     * 正在招标中的列表
     */
    public function feeindex(){

        $where = [
        ];

        $id = I('id','','trim');
        if(!empty($id)){
            $where['a.id'] = ['like', '%'.(string)$id.'%'];
        }

        $object_no = I('object_no','','trim');
        if(!empty($object_no)){
            $where['c.object_no'] = ['like', '%'.(string)$object_no.'%'];
        }

        $prefix = C('DB_PREFIX');
        $model = M()->table($prefix.'ztgl_fee_pay_record a')
            ->join($prefix.'qyzz_bidder b on b.id = a.company_id')
            ->join($prefix.'ztgl_object c on c.object_id = a.object_id')
            ->join($prefix.'user d on d.id = b.user_id');

        $fields = 'a.*,
                    c.object_no,
                    c.object_name,
                    d.mobile_num';

        $list = $this->lists($model,$where,'a.insert_time desc',$fields);
        $this->assign('list',$list);

        $this->meta_title = '撮合手续费管理';

        $this->assign('type_array',['PAY'=>'缴纳手续费','REV'=>'退还手续费']);
        $this->display();
    }

}
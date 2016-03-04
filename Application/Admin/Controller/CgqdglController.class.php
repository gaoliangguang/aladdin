<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------
namespace Admin\Controller;
use Admin\Service\ApiService;

/**
 * 采购抢单管理
 * @author 麦当苗儿 <zuojiazi@vip.qq.com>
 */
class CgqdglController extends AdminController {

    public function zbsort(){

        $prefix = C('DB_PREFIX');
        if(IS_POST){
            $purchase_nos  = I('post.selected');
            $datas = [];
            foreach($purchase_nos as $key=>$purchase_no){
                $tmp = [
                    'purchase_no'=>$purchase_no,
                    'sort_no'=>($key+1),
                    'insert_time'=>time_format(),
                    'creator'=>session('user_auth.username'),
                ];
                $datas[] = $tmp;
            }

            M()->execute('delete from '.$prefix.'tjnr_object_recommend');

            if(empty($datas) || M('tjnr_object_recommend')->addAll($datas)){
                $this->success('推荐成功！');
            }else{

                $this->error('保存失败，请重新再试！');
            }
        }

        $pList = M('ztgl_object')
                ->where(['object_status'=>'PUB','object_publish_type'=>'PUB'])
                ->getField('purchase_no,purchase_no,purchase_name');

        $selected = M()->table($prefix.'tjnr_object_recommend a')
            ->join($prefix.'ztgl_object b on b.purchase_no = a.purchase_no')
            ->order('sort_no')
//            ->where(['b.object_status'=>'PUB'])
            ->getField('a.purchase_no,b.purchase_no,b.purchase_name');

        $this->assign('plist',$pList);
        $this->meta_title = '标的推荐';
        $this->assign('selected',$selected);
        $this->display();
    }

    public function viewqdjg($id=0){

        $prefix = C('DB_PREFIX');
        $fields = [
                    'a.*',
                  ];
        $item = M()->table($prefix.'cggl_purchase_response a')
            ->where(['a.id'=>$id,'status'=>'WIN'])
            ->field($fields)
            ->find();
        if(empty($item)){
            $this->error('抢单信息不存在！');
        }
        $fields2 = [
            'a.item_amount',
            'b.purchase_detail',
            'c.name'
        ];
            $purchase_list = M()->table($prefix.'cggl_purchase_detail_response a ')
            ->join($prefix.'cggl_purchase_detail b on b.id = a.detail_id')
            ->join($prefix.'cggl_purchase_category c on c.id = b.productId')
            ->where(['a.response_id'=>$id])
            ->field($fields2)
            ->select();

        $this->assign('item',$item);
        $this->assign('purchase_list',$purchase_list);

        $this->meta_title = '中标详情';

        $this->display();
    }
    /**
     * 抢单结果的列表
     */
    public function qdjgindex(){

        $where = [
            'object_status'=>'SEL',
            'b.status'=>'WIN'
        ];

        $purchase_no = I('purchase_no','','trim');
        if(!empty($purchase_no)){
            $where['z.purchase_no'] = ['like', '%'.(string)$purchase_no.'%'];
        }
        $purchase_name = I('purchase_name','','trim');
        if(!empty($purchase_name)){
            $where['z.purchase_name'] = ['like', '%'.(string)$purchase_name.'%'];
        }
        $industry_id= I('industry_id','','trim');
        if(!empty($industry_id)){
            $where['z.industry_id'] = $industry_id;
        }

        $industry = M('base_industry')->getField('id,industry_name');

        $prefix = C('DB_PREFIX');
        $model = M()->table($prefix.'cggl_purchase z')
            ->join($prefix.'cggl_purchase_response b on b.purchase_no = z.purchase_no')
            ->join($prefix.'user c on c.id = b.user_id');

        $fields = 'z.purchase_no,
                    z.evaluation_amount,
                    z.purchase_no,
                    z.purchase_name,
                    z.insert_time,
                    bid_open_date,
                    b.id as bid,
                    b.user_id,
                    b.bid_amount,
                    b.insert_time as toubiao_time,
                    c.nick_name
                    ';

        $list = $this->lists($model,$where,'z.insert_time desc',$fields);
        $this->assign('list',$list);

        $purchase_nos = [];
        foreach($list as $item){
            $purchase_nos[] = $item['purchase_no'];
        }

        $this->assign('industry',$industry);
        $this->meta_title = '已中标的';

        $this->display();
    }

    /**
     * 查看采购详情
     * @param string $purchase_no
     */
    public function cgxqindex($purchase_no = '',$active='a'){

        if(IS_POST){
            $this->_viewzb($purchase_no);
            die;
        }
        $this->meta_title = '采购信息详情';
        $this->assign('purchase_no',$purchase_no);

        $active_url = [
            'a'=>U('cgqdgl/cgxmindex'),
            'b'=>U('ztglobject/qdjgindex'),
        ];
        $this->assign('active_menu',$active_url[$active]);
        $this->display();
    }

    private function _viewzb($purchase_no){

        $type = I('post.type');

        $where = ['purchase_no'=>$purchase_no];
        $tpl = '_viewzb_item';
        $list = [];
        $item = [];

        switch($type){
            case 'xqjbxx':

                $cloumn_data = [
                    'purchase_no'=>'采购项目编号',
                    'purchase_name'=>'采购需求名称',
                    'purchase_description'=>'采购需求简述',
                    'project_site_province,project_site_city,project_site_town,project_site'=>'项目地点',
                    'purchase_principal'=>'采购经办人',
                    'qq'=>'采购经办人QQ',
                    'email'=>'采购经办人邮箱',
                    'wechat'=>'采购经办人微信',
                    'purchase_telephone'=>'采购经办人电话',
                    'evaluation_amount'=>'采购估价',
                    'evaluation_amount_visiable'=>'估价是否公开',
                ];

                $item = M('cggl_purchase')
                        ->where($where)
                        ->field(array_keys($cloumn_data))
                        ->find();

                $currency = ['ENB'=>'公开','DIS'=>'不公开'];
                $item['evaluation_amount_visiable'] = $currency[$item['evaluation_amount_visiable']];
                $item['evaluation_amount'] = price_format($item['evaluation_amount']);

                break;

            case 'xqlb':

                $cloumn_data = [
                    'name'=>'采购类别',
                    'purchase_detail'=>'采购需求明细',
                    'project_expect_start_date'=>'工程预计开始时间',
                    'project_expect_period'=>'标准工期',
                ];
                $prefix = C('DB_PREFIX');
                $list = M()->table($prefix.'cggl_purchase_detail a')
                        ->join($prefix.'cggl_purchase_category b on b.id = a.productId')
                        ->where($where)->field(array_keys($cloumn_data))->select();

                $this->assign('list',$list);
                $this->assign('title_icon','采购需求');
                $this->assign('cloumn_data',$cloumn_data);

                $html = $this->fetch('_viewzb_list');

                echo $html;
                die;

                break;

            case 'bzj':
                $cloumn_data = [
                    'need_bid_bond'=>'是否需要保证金',
                    'bid_bond_amount'=>'抢单保证金额'
                ];
                $item = M('cggl_purchase')
                        ->where($where)
                        ->field(array_keys($cloumn_data))
                        ->find();
                $need_bid_bond = ['YES'=>'需要','NO#'=>'不需要'];
                $item['need_bid_bond'] = $need_bid_bond[$item['need_bid_bond']];
                $item['bid_bond_amount'] = price_format($item['bid_bond_amount']);

                break;
            case 'sjyq':

                $cloumn_data = [
                    'announcement_begin_time'=>'公告开始日期',
                    'announcement_end_time'=>'公告结束日期',
                    'bidding_end_time'=>'投标截止时间',
                    'bid_open_date'=>'开标时间',
                ];
                $item = M('cggl_purchase')
                        ->where($where)
                        ->field(array_keys($cloumn_data))
                        ->find();


                break;

        }

        $this->assign('cloumn_data',$cloumn_data);
        $this->assign('item',$item);
        $this->display($tpl);
    }
    /**
     * 正在采购中的列表
     */
    public function cgxmindex(){

        $where = [
            'object_status'=>['neq','CRT']
        ];

        $purchase_no = I('purchase_no','','trim');
        if(!empty($purchase_no)){
            $where['z.purchase_no'] = ['like', '%'.(string)$purchase_no.'%'];
        }
        $purchase_name = I('purchase_name','','trim');
        if(!empty($purchase_name)){
            $where['z.purchase_name'] = ['like', '%'.(string)$purchase_name.'%'];
        }


        $prefix = C('DB_PREFIX');
        $model = M()->table($prefix.'cggl_purchase z');
        $fields = 'purchase_no,
                    evaluation_amount,
                    purchase_name,
                    insert_time,
                    bid_open_date,
                    object_status,
                    project_site_town,
                    project_site_city,
                    project_site_province,
                    bidding_end_time';

        $list = $this->lists($model,$where,'z.insert_time desc',$fields);
        $this->assign('list',$list);

        $purchase_nos = [];
        foreach($list as $item){
            $purchase_nos[] = $item['purchase_no'];
        }

        $tb_counts = M('cggl_purchase_response')
            ->where(['purchase_no'=>['IN',implode(',',$purchase_nos)]])
            ->group('purchase_no')
            ->getField('purchase_no,count(*) as tb_count');

        $this->assign('tb_counts',$tb_counts);
        $this->meta_title = '正在采购';

        $this->display();
    }

    public function cancel()
    {
        if(!IS_POST){
	        $objectId = I('purchase_no');
            $this->meta_title = '采购信息详情';
            $this->assign('purchase_no',$objectId);
            $this->display();
            die;
        }
	$objectId = I('purchase_no');
	$revokeReason = I('revokeReason');
	if(empty($revokeReason))
	{
            $this->error('撤销原因不能为空!');
	}
	if(empty($objectId))
	{
            $this->error('采购项目不存在!');
	}
        $api = new ApiService();
        $resp = $api->setApiUrl(C('APIURI.paas1'))
            ->setData(['objectId'=>$objectId,'revokeReason'=>$revokeReason])->send('backendPurchaseManager/revokePurchase');
        if(!check_resp($resp))
        {
            $this->error('系统错误,请稍后再试');
        }
        $this->success('撤销成功',U("cgqdgl/cgxmindex"));

    }
}

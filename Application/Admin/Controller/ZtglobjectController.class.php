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
 * 模型数据管理控制器
 * @author 麦当苗儿 <zuojiazi@vip.qq.com>
 */
class ZtglobjectController extends AdminController {

    public function zbsort(){

        $prefix = C('DB_PREFIX');
        if(IS_POST){
            $object_ids  = I('post.selected');
            $datas = [];
            foreach($object_ids as $key=>$object_id){
                $tmp = [
                    'object_id'=>$object_id,
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
                ->getField('object_id,object_no,object_name');

        $selected = M()->table($prefix.'tjnr_object_recommend a')
            ->join($prefix.'ztgl_object b on b.object_id = a.object_id')
            ->order('sort_no')
//            ->where(['b.object_status'=>'PUB'])
            ->getField('a.object_id,b.object_no,b.object_name');

        $this->assign('plist',$pList);
        $this->meta_title = '标的推荐';
        $this->assign('selected',$selected);
        $this->display();
    }

    public function viewzhongbiao($id=0){

        $prefix = C('DB_PREFIX');
        $fields = [
                    'b.company_name',
                    'b.business_license_type',
                    'b.new_business_license',
                    'b.business_license',
                    'b.org_code_certificate',
                    'b.tax_registration_certificate',
                    'b.business_license_url',
                    'a.*',
                  ];
        $item = M()->table($prefix.'ztgl_bid_record a')
            ->join($prefix.'qyzz_bidder b on b.id = a.bidder_id')
            ->where(['a.id'=>$id,'bid_status'=>'WIN'])
            ->field($fields)
            ->find();
        if(empty($item)){
            $this->error('投标信息不存在！');
        }
        $tbzz_list = M('ztgl_bid_certification')->where(['bid_id'=>$id])->getField('id,certification_name');
        $tbfj_list = M('ztgl_bid_attachment')->where(['bid_id'=>$id])->select();

        $item['bzj'] = M('ztgl_object_bond_record')->where(['bid_id'=>$id,'bond_type'=>'BID'])->getField('bond_amount');
        $this->assign('item',$item);
        $this->assign('item',$item);
        $this->assign('tbzz_list',$tbzz_list);
        $this->assign('tbfj_list',$tbfj_list);

        $this->meta_title = '中标详情';

        $this->display();
    }
    /**
     * 正在招标中的列表
     */
    public function yzbindex(){

        $where = [
            'object_status'=>'SEL',
            'b.bid_status'=>'WIN'
        ];

        $object_no = I('object_no','','trim');
        if(!empty($object_no)){
            $where['z.object_no'] = ['like', '%'.(string)$object_no.'%'];
        }
        $object_name = I('object_name','','trim');
        if(!empty($object_name)){
            $where['z.object_name'] = ['like', '%'.(string)$object_name.'%'];
        }
        $industry_id= I('industry_id','','trim');
        if(!empty($industry_id)){
            $where['z.industry_id'] = $industry_id;
        }

        $industry = M('base_industry')->getField('id,industry_name');

        $prefix = C('DB_PREFIX');
        $model = M()->table($prefix.'ztgl_object z')
            ->join($prefix.'ztgl_bid_record b on b.object_id = z.object_id')
            ->join($prefix.'qyzz_bidder c on c.id = b.bidder_id');

        $fields = 'z.object_id,
                    z.evaluation_amount,
                    z.object_no,
                    z.industry_id,
                    z.object_name,
                    z.insert_time,
                    bid_open_date,
                    b.id as bid,
                    b.bidder_id,
                    b.bid_amount,
                    b.insert_time as toubiao_time,
                    c.company_name
                    ';

        $list = $this->lists($model,$where,'z.insert_time desc',$fields);
        $this->assign('list',$list);

        $object_ids = [];
        foreach($list as $item){
            $object_ids[] = $item['object_id'];
        }

        $this->assign('industry',$industry);
        $this->meta_title = '已中标的';

        $this->display();
    }

    /**
     * 查看标的详情
     * @param string $object_id
     */
    public function viewzb($object_id = '',$active='a'){

        if(IS_POST){
            $this->_viewzb($object_id);
            die;
        }
        $this->meta_title = '招标信息详情';
        $this->assign('object_id',$object_id);

        $active_url = [
            'a'=>U('ztglobject/zzzbindex'),
            'b'=>U('ztglobject/yzbindex'),
        ];
        $this->assign('active_menu',$active_url[$active]);
        $this->display();
    }

    private function _viewzb($object_id){

        $type = I('post.type');

        $where = ['object_id'=>$object_id];
        $tpl = '_viewzb_item';
        $list = [];
        $item = [];

        switch($type){
            case 'xmjbxx':

                $cloumn_data = [
                    'object_no'=>'招标项目编号',
                    'object_name'=>'招标项目名称',
                    'object_scope'=>'招标项目范围',
                    'biddee_company_principal'=>'招标经办人',
                    'currency'=>'采用币种',
                    'evaluation_amount'=>'标的估价',
                    'contract_type'=>'承包方式',
                ];

                $item = M('ztgl_object')
                        ->where($where)
                        ->field(array_keys($cloumn_data))
                        ->find();

                $currency = ['CNY'=>'人民币','USD'=>'美元'];
                $item['currency'] = $currency[$item['currency']];
                $item['evaluation_amount'] = price_format($item['evaluation_amount']);

                break;
            case 'gcjbxx':
                $cloumn_data = [
//                    'industry_name'=>'工程类别',
                    'project_name'=>'工程名称',
                    'project_site_province,project_site_city,project_site_town,project_site'=>'工程地点',
                    'project_scale'=>'工程规模及特征',
                    'employer'=>'建设单位',
                    'employer_principal'=>'建设单位经办人',
                    'employer_telephone'=>'建设单位办公电话',
                ];
                $prefix = C('DB_PREFIX');
                $item = M()->table($prefix.'ztgl_object_project_info i')
                        ->join($prefix.'ztgl_object o on o.object_id = i.object_id')
//                        ->join($prefix.'base_industry bi on bi.id = o.industry_id')
                        ->where(['i.object_id'=>$object_id])
                        ->field(array_keys($cloumn_data))
                        ->find();

                break;
            case 'gcsgzm':

                $cloumn_data = [
                    'construction_prove_type'=>'工程施工证明类型',

                    'land_use_certificate_No'=>'国有土地使用证编号',
                    'land_use_certificate_enddate'=>'国有土地使用证有效期',
                    'land_use_certificate_url'=>'国有土地使用证附件',

                    'construction_land_use_permit_No'=>'建设用地规划许可证编号',
                    'construction_land_use_permit_enddate'=>'建设用地规划许可证有效期',
                    'construction_land_use_permit_url'=>'建设用地规划许可证附件',

                    'building_permit_No'=>'建设工程规划许可证编号',
                    'building_permit_enddate'=>'建设工程规划许可证有效期',
                    'building_permit_url'=>'建设用地规划许可证附件',

                    'letter_of_acceptance_url'=>'中标通知书附件',

                    'building_construction_permit_No'=>'建设工程施工许可证编号',
                    'building_construction_permit_enddate'=>'建设工程施工许可证有效期',
                    'building_construction_permit_url'=>'建设工程施工许可证附件',
                ];
                $item = M('ztgl_object_project_info')
                        ->where($where)
                        ->field(array_keys($cloumn_data))
                        ->find();
                $item['land_use_certificate_url'] = '<a class="" href="'.imageMogr2($item['land_use_certificate_url'],100,100).'">查看</a>';
                $item['construction_land_use_permit_url'] = '<a class="ace-thumbnails" href="'.imageMogr2($item['construction_land_use_permit_url'],100,100).'">查看</a>';
                $item['building_permit_url'] = '<a class="ace-thumbnails" href="'.imageMogr2($item['building_permit_url'],100,100).'">查看</a>';
                $item['letter_of_acceptance_url'] = '<a href="'.get_qiniu_file_durl($item['letter_of_acceptance_url'],100,100).'">下载</a>';
                $item['building_construction_permit_url'] = '<a class="ace-thumbnails" href="'.imageMogr2($item['building_construction_permit_url'],100,100).'">查看</a>';

                if($item['construction_prove_type'] == 'ZCB'){
                    $cloumn_data = array_slice($cloumn_data,0,11);
                }elseif($item['construction_prove_type'] == 'KFS'){
                    $cloumn_data = array_slice($cloumn_data,0,10);
                }else{
                    $cloumn_data = ['construction_prove_type'=>$cloumn_data['construction_prove_type']]+array_slice($cloumn_data,11,3);
                }
                $type_array = ['BCP'=>'有施工许可','KFS'=>'开发商','ZCB'=>'总承包'];
                $item['construction_prove_type'] = $type_array[$item['construction_prove_type']];

                break;
            case 'gqyq':

                $cloumn_data = [
                    'project_expect_start_date'=>'计划开工日期',
                    'project_expect_period'=>'标准工期（日历天）',
                ];
                $item = M('ztgl_object_project_info')
                    ->where($where)
                    ->field(array_keys($cloumn_data))
                    ->find();
                break;
            case 'zzyq':

                $cloumn_data = [
                    'certification_name'=>'资质名称',
                    'industry_name'=>'工程类别',
                ];
                $prefix = C('DB_PREFIX');
                $list = M()->table($prefix.'ztgl_object_certification_requirement a')
                        ->join($prefix.'base_industry b on b.id = a.industry_id')
                        ->where($where)->field(array_keys($cloumn_data))->select();

                $this->assign('list',$list);
                $this->assign('title_icon','投标人资质等级要求');
                $this->assign('cloumn_data',$cloumn_data);

                $html = $this->fetch('_viewzb_list');

                $cloumn_data = [
                    'need_pm_certification'=>'需要投标人项目经理',
                    'need_constructor_certification'=>'需要投标人建造师',
                    'need_safety_permit'=>'需要安全生产许可证',
                    'need_pm_safety_certification'=>'需要项目经理安全生产考核合格证',
                ];
                $item = M('ztgl_object')
                    ->where($where)
                    ->field(array_keys($cloumn_data))
                    ->find();

                $this->assign('title_icon','投标人需要提供的资料');
                $this->assign('cloumn_data',$cloumn_data);
                foreach($item as &$val){
                    $val = ($val == 'YES') ? '是' : '否';
                }
                $this->assign('item',$item);
                echo $html.$this->fetch($tpl);
                die;

                break;

            case 'bzj':
                $cloumn_data = [
                    'bid_bond_amount'=>'投标保证金额'
                ];
                $item = M('ztgl_object')
                        ->where($where)
                        ->field(array_keys($cloumn_data))
                        ->find();

                echo '
                    <div class="center">
                        <span class="btn btn-app btn-sm btn-yellow no-hover" style="width: auto;">
                            <span class="line-height-1 bigger-170 blue"> ￥'.price_format($item['bid_bond_amount']).' </span>
                            <br>
                            <span class="line-height-1 smaller-90"> 元 </span>
                        </span>
                    </div>';
                die;
                break;
            case 'zbfs':
                $cloumn_data = [
                    'object_publish_type'=>'投标方式'
                ];
                $item = M('ztgl_object')
                    ->where($where)
                    ->field(array_keys($cloumn_data))
                    ->find();

                $html = '';
                if($item['object_publish_type'] == 'INV'){
                    $cloumn_data2 = [
                        'company_name'=>'公司名称',
                        'legal_person'=>'法人名称',
                       'contact_name'=>'联系人',
                    ];

                    $prefix = C('DB_PREFIX');
                    $list = M()->table($prefix.'ztgl_bid_invite_bidder a')
                            ->join($prefix.'qyzz_bidder b on b.id = a.bidder_id')
                            ->where($where)->field(array_keys($cloumn_data2))->select();

                    $this->assign('cloumn_data',$cloumn_data2);
                    $this->assign('list',$list);
                    $this->assign('title_icon','<i class="icon-table"></i>邀请投标公司');
                    $html = $this->fetch('_viewzb_list');
                }

                $type_array = ['PUB'=>'公开招标','INV'=>'邀请招标'];
                $item['object_publish_type'] = $type_array[$item['object_publish_type']];
                $this->assign('title_icon','');
                $this->assign('cloumn_data',$cloumn_data);
                $this->assign('item',$item);
                echo $this->fetch($tpl).$html;
                die;

                break;
            case 'ztbwjyq':

                $cloumn_data = [
                    'attachment_url'=>'投标文件',
                    'need_certification_checkup_file'=>'需要资格审查文件电子标书',
                    'need_business_standard'=>'需要商务标部分电子标书',
                    'need_technical_standard'=>'需要技术标部分电子标书',
                ];
                $prefix = C('DB_PREFIX');
                $item = M()->table($prefix.'ztgl_object a')
                    ->join($prefix.'ztgl_object_attachment b on b.object_id = a.object_id','left')
                    ->where(['a.object_id'=>$object_id])->field(array_keys($cloumn_data))->find();

                $item['attachment_url'] = '<a href="'.get_qiniu_file_durl($item['attachment_url']).'">下载</a>';
                foreach($item as $key=>&$val){
                    if($key == 'attachment_url') {
                        continue;
                    }
                    $val = ($val == 'YES') ? '是' : '否';
                }
                break;
            case 'dyfs':

                $cloumn_data = [
                    'answer_start_date'=>'答疑开始日期',
                    'answer_end_date'=>'答疑结束日期',
                    'is_qq_answer'=>'',
                    'is_email_answer'=>'',
                    'is_tel_answer'=>'',
                    'is_meetng_answer'=>'',
                    'qq_no'=>'qq群号',
                    'qq_password'=>'qq群密码',
                    'email'=>'邮件地址',
                    'telephone'=>'电话号码',
                    'address'=>'答疑地址',
                    'answer_time'=>'答疑时间',
                    'answer_date'=>'答疑日期',
                ];
                $item = M('ztgl_qanda')
                        ->where($where)
                        ->field(array_keys($cloumn_data))
                        ->find();
                $html = '';
                $this->assign('item',$item);
                $this->assign('cloumn_data',array_slice($cloumn_data,0,2));
                $html .= $this->fetch($tpl);

                if($item['is_qq_answer'] == 'YES'){

                    $this->assign('title_icon','QQ答疑');
                    $this->assign('cloumn_data',array_slice($cloumn_data,6,2));

                    $html .= $this->fetch($tpl);
                }
                if($item['is_email_answer'] == 'YES'){

                    $this->assign('title_icon','<i class="icon-envelope"></i>邮件答疑');
                    $this->assign('cloumn_data',array_slice($cloumn_data,8,1));

                    $html .= $this->fetch($tpl);
                }
                if($item['is_tel_answer'] == 'YES'){

                    $this->assign('title_icon','<i class="icon-phone"></i>电话答疑');
                    $this->assign('cloumn_data',array_slice($cloumn_data,9,1));

                    $html .= $this->fetch($tpl);
                }
                if($item['is_meetng_answer'] == 'YES'){

                    $this->assign('title_icon','<i class="icon-home"></i>现场答疑');
                    $this->assign('cloumn_data',array_slice($cloumn_data,10,3));

                    $html .= $this->fetch($tpl);
                }
                echo $html;
                die;

                break;
            case 'pbfs':
                $cloumn_data = [
                    'bid_evaluation_type'=>'评标方法及标准',
                    'bid_evaluation_site'=>'技术评标地点',
                    'bid_winner_determine_way'=>'中标人的确定方法',
                    'vote_win_way'=>'票决方式',
                ];
                $item = M('ztgl_object_baseinfo')
                    ->where($where)
                    ->field(array_keys($cloumn_data))
                    ->find();
                $type_array = ['QLT'=>'定性评审法','CRE'=>'信用商户评审法','OVE'=>'综合评估法'];
                $item['bid_evaluation_type'] = $type_array[$item['bid_evaluation_type']];

                $type_array = ['ORV'=>'直接票决定标','MRV'=>'逐轮票决定标','VDM'=>'票决筹钱定标'];
                $item['bid_winner_determine_way'] = $type_array[$item['bid_winner_determine_way']];

                $type_array = ['SMP'=>'简单铎书法','CPN'=>'对比胜出法'];
                $item['vote_win_way'] = $type_array[$item['vote_win_way']];

                break;
        }

        $this->assign('cloumn_data',$cloumn_data);
        $this->assign('item',$item);
        $this->display($tpl);
    }
    /**
     * 正在招标中的列表
     */
    public function zzzbindex(){

        $where = [
            'object_status'=>['neq','CRT']
        ];

        $object_no = I('object_no','','trim');
        if(!empty($object_no)){
            $where['z.object_no'] = ['like', '%'.(string)$object_no.'%'];
        }
        $object_name = I('object_name','','trim');
        if(!empty($object_name)){
            $where['z.object_name'] = ['like', '%'.(string)$object_name.'%'];
        }
        $industry_id= I('industry_id','','trim');
        if(!empty($industry_id)){
            $where['z.industry_id'] = $industry_id;
        }

        $industry = M('base_industry')->getField('id,industry_name');

        $prefix = C('DB_PREFIX');
        $model = M()->table($prefix.'ztgl_object z')
                     ->join($prefix.'ztgl_object_baseinfo b on b.object_id = z.object_id')
                     ->join($prefix.'ztgl_object_project_info c on c.object_id = z.object_id');
        $fields = 'z.object_id,
                    z.evaluation_amount,
                    z.object_no,
                    z.industry_id,
                    z.object_name,
                    z.insert_time,
                    z.object_status,
                    c.project_site_town,
                    c.project_site_city,
                    c.project_site_province,
                    bid_open_date,
                    b.bidding_end_time';

        $list = $this->lists($model,$where,'z.insert_time desc',$fields);
        $this->assign('list',$list);

        $object_ids = [];
        foreach($list as $item){
            $object_ids[] = $item['object_id'];
        }

        $tb_counts = M('ztgl_bid_record')
            ->where(['object_id'=>['IN',implode(',',$object_ids)]])
            ->group('object_id')
            ->getField('object_id,count(*) as tb_count');

        $this->assign('tb_counts',$tb_counts);
        $this->assign('industry',$industry);
        $this->meta_title = '正在招标';

        $this->display();
    }

    public function cancel()
    {
        if(!IS_POST){
	    $objectId = I('object_id');
            $this->meta_title = '招标信息详情';
            $this->assign('object_id',$objectId);
            $this->display();
            die;
        }
	$objectId = I('object_id');
	$revokeReason = I('revokeReason');
	if(empty($revokeReason))
	{
            $this->error('撤销原因不能为空!');
	}
	if(empty($objectId))
	{
            $this->error('招标项目不存在!');
	}
        $api = new ApiService();
        $resp = $api->setApiUrl(C('APIURI.paas1'))
            ->setData(['objectId'=>$objectId,'revokeReason'=>$revokeReason])->send('tender/revokeBid');
        if(!check_resp($resp))
        {
            $this->error('系统错误,请稍后再试');
        }
        $this->success('撤销成功',U("ztglobject/zzzbindex"));

    }
}

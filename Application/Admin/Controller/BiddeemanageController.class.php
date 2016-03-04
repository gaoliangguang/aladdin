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

class BiddeemanageController extends AdminController {

    public function index()
    {
        if(!empty(I('short_name')))
        {
            $map['short_name']= ['like','%'.I("short_name").'%'];
        }
        if(!empty(I('nick_name')))
        {
            $map['nick_name']= ['like','%'.I("nick_name").'%'];
        }
        $prefix = C('DB_PREFIX');
        $model = M('qyzz_biddee a')->join('t_user b on a.user_id=b.id');
        $list   =   $this->lists($model, $map,'certificate_time desc','a.*,b.nick_name,mobile_num');
        $this->assign('_list', $list);
        $this->meta_title = '招标人列表';
        $this->display();
    }
    public function show()
    {
        $id = I('id');
        $item = $model = M('qyzz_biddee a')->join('t_user_bankcard b on a.user_id=b.user_id and user=\'BEE\'','left')->where(['a.id'=>$id])->find();
        if(empty($item))
        {
            $this->error('招标人信息不存在');
        }
        $this->assign('item', $item);
        $this->meta_title = '招标人详情';
        $this->display();
    }
    public function verify()
    {
        if(!empty(I('company_name')))
        {
            $map['company_name']= ['like','%'.I("company_name").'%'];
        }
        if(!empty(I('real_name')))
        {
            $map['real_name']= ['like','%'.I("real_name").'%'];
        }
        $prefix = C('DB_PREFIX');
        $map['a.status'] = 'APY';
        $model = M('qyzz_biddee_certicate a')->join('t_user_auth b on a.user_id=b.user_id');
        $list   =   $this->lists($model, $map,'apply_time desc','a.*,b.real_name');
        $this->assign('_list', $list);
        $this->meta_title = '招标人待审核列表';
        $this->display();
    }
    public function verifyshow()
    {
        $id = I('id');
        $item =  M('qyzz_biddee_certicate a')->join('t_qyzz_biddee_bankcard_certicate b on a.user_id=b.user_id','left')->where(['a.id'=>$id])->field('a.*,bank_name,account_no,account_name,b.tax_no,b.address as address2 ,b.telephone')->find();
        if(empty($item))
        {
            $this->error('招标人信息不存在');
        }
        $user = M("user a")->join('t_user_auth b on a.id=b.user_id')->where(['id'=>$item['user_id']])->find();
        $this->assign('item', $item);
        $this->assign('user', $user);
        $this->meta_title = '招标人详情';
        $this->display();
    }
    public function check()
    {
        $data = $this->getData();
        $api = new ApiService();
        $resp = $api->setApiUrl(C('APIURI.paas1'))
            ->setData($data)->send('myBiddee/authInfo/checkApplication');
        if(!check_resp($resp))
        {
            $this->error('系统错误,请稍后再试');
        }
        $this->success('审核完成',U("biddeemanage/verify"));

    }
    private function getData(){
        $data = [];
        $get = [
            'baseInfoCheck'=>
                [
                    'company_name'=>'company_name',
                    'short_name'=>'short_name',
                    'contact_mobile_num'=>'contact_mobile_num',
                    'email'=>'email',
                    'description'=>'description',
                    'logo'=>'logo',
                    'registered_capital'=>'registered_capital'
                ],
            'legalPersonCheck'=>[
                'legal_person'=>'legal_person',
                'legal_person_idcard'=>'legal_person_idcard',
                'legal_person_idcard_front_url'=>'legal_person_idcard_front_url',
                'legal_person_idcard_back_url'=>'legal_person_idcard_back_url',
                'legal_person_authority_book'=>'legal_person_authority_book'
            ],
            'registeredInfoCheck'=>[
                'unified_social_credit_code_url'=>'unified_social_credit_code_url',
                'unified_social_credit_code'=>'unified_social_credit_code',
                'business_license'=>'business_license',
                'business_license_url'=>'business_license_url',
                'tax_registration_certificate'=>'tax_registration_certificate',
                'tax_registration_certificate_url'=>'tax_registration_certificate_url',
                'org_code_certificate'=>'org_code_certificate',
                'org_code_certificate_url'=>'org_code_certificate_url',
                'business_license_expire_time'=>'business_license_expire_time',
                'reg_time'=>'reg_time',
                'business_scope'=>'business_scope',
                'address'=>'address'
            ],
            'bankInfoCheck'=>[
                'bank_name'=>'bank_name',
                'account_no'=>'account_no',
                'account_name'=>'account_name',
                'telephone'=>'telephone',
                'tax_no'=>'tax_no',
                'address'=>'address2'
            ]
        ];
        foreach($get as $k=>$v)
        {
            foreach($v as $key=>$val)
            {
                $ret = I('post.'.$val)=='Y'?'OK#':'FLS';
                $data[$k][$key] = ["result"=>$ret,"msg"=>I('post.'.$val.'_msg')];
            }
        }

        if(I('post.business_license_type')=='NEW')
        {
            $data['registeredInfoCheck']['business_license'] = ['result'=>'OK#','msg'=>''];
            $data['registeredInfoCheck']['business_license_url'] = ['result'=>'OK#','msg'=>''];
            $data['registeredInfoCheck']['org_code_certificate'] = ['result'=>'OK#','msg'=>''];
            $data['registeredInfoCheck']['org_code_certificate_url'] = ['result'=>'OK#','msg'=>''];
            $data['registeredInfoCheck']['tax_registration_certificate'] = ['result'=>'OK#','msg'=>''];
            $data['registeredInfoCheck']['tax_registration_certificate_url'] = ['result'=>'OK#','msg'=>''];
        }else{
            $data['registeredInfoCheck']['unified_social_credit_code_url'] = ['result'=>'OK#','msg'=>''];
            $data['registeredInfoCheck']['unified_social_credit_code'] = ['result'=>'OK#','msg'=>''];
        }
        $data['baseInfoCheck']['biddee_id']=I('post.id');
        return $data;
    }
}

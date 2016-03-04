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

class CapitalController extends AdminController {

	public function index()
	{
		if(!empty(I('account_id')))
		{
			$map['account_id']= ['like','%'.I("account_id").'%'];
		}
		if(!empty(I('nick_name')))
		{
			$map['nick_name']= ['like','%'.I("nick_name").'%'];
		}
		if(!empty(I('status')))
		{
			$map['a.status']= I("status");
		}
		$prefix = C('DB_PREFIX');
		$model = M('project_account a')->join('t_user b on a.user_id=b.id');
		$list   =   $this->lists($model, $map,'update_time desc','a.*,b.nick_name');
		$this->assign('_list', $list);
		$this->meta_title = '用户资金账户列表';
		$this->display();
	}
	public function showitem()
	{
		$id = I("id");
		$model = M('project_account_order a');
		$list   =   $this->lists($model, ['account_id'=>$id],'insert_time desc','*');
		$this->assign('_list', $list);
		$this->meta_title = '用户资金账户列表';
		$this->display();
	}
	public function withdraw()
	{
		$where_str = [];
		if(!empty(I('mobilenum')))
		{
			$map['mobile_num']= ['like','%'.I("mobilenum").'%'];
		}
		if(!empty(I('real_name')))
		{
			$map['real_name']= ['like','%'.I("real_name").'%'];
		}
		if(!empty(I('nick_name')))
		{
			$map['nick_name']= ['like','%'.I("nick_name").'%'];
		}
		if(!empty(I('sdate')))
		{
			$where_str[] = " a.insert_time >='".I("sdate")."'";
		}
		if(!empty(I('edate')))
		{
			$where_str[] = " a.insert_time <='".I("edate")."'";
		}
		$str = join($where_str,'and') ;
		if(!empty($str))
		{
			$map['_string'] = $str;
		}
		$model = M('ddgl_withdraw_apply a')->join('t_user b on a.user_id=b.id')->join('t_user_auth d on d.user_id=a.user_id')->join('t_project_account c on c.user_id=a.user_id');
		$list   =   $this->lists($model, $map,'a.insert_time desc','*,a.status');
		$this->assign('_list', $list);
		$this->meta_title = '提现申请列表';
		$this->display();
	}
	public function recharge()
	{
		$where_str = [];
		if(!empty(I('mobilenum')))
		{
			$map['mobile_num']= ['like','%'.I("mobilenum").'%'];
		}
		if(!empty(I('real_name')))
		{
			$map['real_name']= ['like','%'.I("real_name").'%'];
		}
		if(!empty(I('nick_name')))
		{
			$map['nick_name']= ['like','%'.I("nick_name").'%'];
		}
		if(!empty(I('sdate')))
		{
			$where_str[] = " a.insert_time >='".I("sdate")."'";
		}
		if(!empty(I('edate')))
		{
			$where_str[] = " a.insert_time <='".I("edate")."'";
		}
		$str = join($where_str,'and') ;
		if(!empty($str))
		{
			$map['_string'] = $str;
		}
		$model = M('ddgl_recharge_apply a')->join('t_user b on a.user_id=b.id')->join('t_user_auth d on d.user_id=a.user_id')->join('t_project_account c on c.user_id=a.user_id');
		$list   =   $this->lists($model, $map,'a.insert_time desc','*,a.status');
		$this->assign('_list', $list);
		$this->meta_title = '充值申请列表';
		$this->display();
	}
	function rechargecheck ()
	{
		if(IS_POST){
			$uid= session('user_auth')['uid'];
			$remark=I('post.remark');
			$status=I('post.status');
			$id =I('post.order_id');
			$data = ['orderId'=>$id,'checkResult'=>$status,'remark'=>$remark,'operator'=>$uid];
			$api = new ApiService();
			$resp = $api->setApiUrl(C('APIURI.paas3'))
				->setData($data)->send('capitalManage/checkRechargeApply');
			if($resp===false||$resp['errcode']!=0)
			{
				$this->error('系统错误,请稍后再试');
			}
			$this->success('审核完成',U('recharge'));
		}
		$id = I('get.id');
		$item = M('ddgl_recharge_apply a')->join('t_user b on a.user_id=b.id')->where(['a.order_id'=>$id])->field('a.*,b.nick_name')->find();
		$this->assign('item', $item);
		$this->meta_title = '充值申请审核';
		$this->display();
	}
	function withdrawcheck()
	{
		if(IS_POST){
			$uid= session('user_auth')['uid'];
			$remark=I('post.remark');
			$status=I('post.status');
			$transferTime =I('post.transferTime');
			$id =I('post.order_id');
			$checkWithdrawalsNo =I('post.voucher');
			$voucherFileUrl =I('post.voucherFileUrl');
			$amount =I('post.amount')*100;
			$data = ['orderId'=>$id,'voucherNo'=>$checkWithdrawalsNo,'checkResult'=>$status,'remark'=>$remark,'operator'=>$uid,'amount'=>$amount,'voucherFileUrl'=>$voucherFileUrl,'transferTime'=>$transferTime];
			$api = new ApiService();
			$resp = $api->setApiUrl(C('APIURI.paas3'))
				->setData($data)->send('capitalManage/checkWithdrawalsApply');
			if($resp===false||$resp['errcode']!=0)
			{
				$this->error('系统错误,请稍后再试');
			}
			$this->success('审核完成',U('withdraw'));
		}
		$id = I('get.id');
		$item = M('ddgl_withdraw_apply a')->join('t_user b on a.user_id=b.id')->join('t_user_bankcard c on c.id=a.user_bankcard_id')->join('t_user_auth d on d.user_id=a.user_id')->join('t_project_account e on c.user_id=a.user_id')->where(['a.order_id'=>$id])->field('*')->find();
		$this->assign('item', $item);
		$this->meta_title = '转账';
		$this->display();
	}
}

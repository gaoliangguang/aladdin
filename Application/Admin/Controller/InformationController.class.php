<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------

namespace Admin\Controller;

class InformationController extends AdminController {

    public function setbox(){

        $post_status = intval(I('get.status'));

        $status = ['NO#', 'YES','FLS'];

        if(!array_key_exists($post_status,$status)){
            $this->error('状态参数错误！');
        }

        $ids = I('id',[]);
        if(empty($ids)){
            $this->error('请选择要处理的数据！');
        }

        M('xxfb_platform_notices')->where("id in (".implode(',',$ids).")")->save(['status'=>$status[$post_status]]);
        $this->success('处理成功！');
    }

    public function boxdetail(){

        $id = I('id');

        $prefix = C('DB_PREFIX');
        $item = M()->table($prefix.'xxfb_platform_notices a')
            ->join($prefix.'user b on a.sender = b.id')
            ->field('a.*,b.mobile_num,b.head_image')
            ->where(['a.id'=>$id])
            ->find();

        if(empty($item)){
            $this->error('数据不存在！');
        }

        if($item['status'] == 'NO#'){

            M('xxfb_platform_notices')->where(['id'=>$id])->save(['status'=>'YES']);
        }

        $this->assign('item',$item);
        $this->display();
    }

    public function inbox(){

        $where = [];
        $type = I('type');
        if(!empty($type)){
            $where['a.notice_type'] = $type;
        }
        $status = I('status');
        if(!empty($status)){
            $where['a.status'] = $status;
        }else{
            $where['a.status'] = ['neq','FLS'];
        }
        $keyword = I('keyword');
        if(!empty($keyword)){
            $where['a.notice_title'] = ['like', '%'.(string)$keyword.'%'];
        }


        $prefix = C('DB_PREFIX');
        $unread_count = M('xxfb_platform_notices')->where(['status'=>'NO#'])->count();
        $model = M()->table($prefix.'xxfb_platform_notices a')
            ->join($prefix.'user b on a.sender = b.id');

        $list = $this->lists($model, $where,'a.insert_time desc','a.*,b.mobile_num');

        $this->assign('list', $list);
        $this->assign('unread_count', $unread_count);
        $this->meta_title = '通知信息';

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

	public function information()
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
		$model = M('xxfb_user_information a')->join('t_user b on a.user_id=b.id')->join('t_user_auth d on d.user_id=a.user_id')->join('t_project_account c on c.user_id=a.user_id');
		$list   =   $this->lists($model, $map,'a.insert_time desc','a.*,b.mobile_num,b.nick_name,d.real_name,a.district district2');

		$this->assign('_list', $list);
		$this->meta_title = '项目信息发布列表';
		$this->display();
	}
	function check ()
	{
		if(IS_POST){
			$uid= session('user_auth')['uid'];
            $id=I('id');
            if(empty($id)){
                $this->error('修改失败');
            }
            $status=I('status');

            if(M('xxfb_user_information')->where(['id'=>$id])->save(['status'=>$status,'auditor'=>$uid,'audit_time'=>date('Y-m-d H:i:s')])){
                $this->success('审核成功！',U('information'));

            }else{
                $this->error('修改失败，请重新再试！');
            }
		}
		$id = I('get.id');
		$item = M('zxgl_user_information a')->join('t_user b on a.user_id=b.id')->where(['a.id'=>$id])->field('a.*,b.nick_name')->find();
		$this->assign('item', $item);
		$this->meta_title = '项目信息发布审核';
		$this->display();
	}

}

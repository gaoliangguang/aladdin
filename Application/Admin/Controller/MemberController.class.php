<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: han <han@163.com>
// +----------------------------------------------------------------------

namespace Admin\Controller;

/**
 * 管理控制器
 * @author han <glghan@sina.com>
 */
class MemberController extends AdminController{
	
	/**
	 * 会员列表
	 * @author han <glghan@sina.com>
	 */
	public function index(){
		$nickname = I('nickname');
        if(!empty($nickname)){
            $map['u.nick_name']    =   array('like', '%'.(string)$nickname.'%');
        }
        $mobile_num = I('mobile');
        if(!empty($mobile_num)){
            $map['u.mobile_num']    =   array('like', '%'.(string)$mobile_num.'%');
        }
        $sort = I('sort');
        if($sort != 'all'&&$sort != ''){
        	var_dump($sort);exit;
        	$map['u.sort'] = array('like','%'.(string)$sort.'%');
        }
        

        $prefix = C('DB_PREFIX');
        $model = M()->table($prefix.'user u')
                    ->join($prefix.'wx_user ua on ua.mqID = u.id','left');
        $list   = $this->lists($model, $map,'','u.*,ua.openid,ua.country');
        $this->assign('_list', $list);
        $this->assign('detail',$detail);
        $this->meta_title = '会员列表';
        $this->display();
	}
	
}
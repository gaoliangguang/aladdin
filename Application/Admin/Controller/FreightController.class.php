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
 * 运费模板管理控制器
 * @author han <glghan@sina.com>
 */
class FreightController extends AdminController{
	/**
	 * 运费模板列表
	 * @author han <glghan@sina.com>
	 */
	public function freightList(){
		$this->meta_title = '运费模板列表';
		$list       =   M('freight_tpl')->select();
		$request    =   (array)I('request.');
        $total      =   $list? count($list) : 1 ;
        $listRows   =   C('LIST_ROWS') > 0 ? C('LIST_ROWS') : 10;
        $page       =   new \Think\Page($total, $listRows, $request);
        $voList     =   array_slice($list, $page->firstRow, $page->listRows);
        $p          =   $page->show();
        //echo '<pre>';
        //var_dump($voList);exit;
		$this->assign('_list', $voList);
		$this->assign('_page', $p? $p: '');
		// 记录当前列表页的cookie
		Cookie('__forward__',$_SERVER['REQUEST_URI']);
		$this->display();
	}
	
	/**
	 * 添加运费模板
	 * @author han <glghan@sina.com>
	 */
	public function addFreight(){
		
		if(IS_POST){
			$freight = M('freight_tpl');
			$data = $freight->create();
			if(!$data['fullStatus']){$data['fullStatus'] = 'FOR';$data['fullSum'] = '0';}
			//var_dump($data);exit();
			$data['status'] = 'OK#';
			$data['uid'] = UID;
			$data['supplyID'] = 2;
			$data['sortOrder'] =3;
			$data['createTime'] = date('Y-m-d H:i:s',time());
			$data['updateTime'] = date('Y-m-d H:i:s',time());
            if($data){
                $id = $freight->add($data);
                if($id){
                    session('ADMIN_MENU_LIST',null);
                    //记录行为
                    action_log('update_freight_tpl', 'freight_tpl', $id, UID);
                    $this->success('新增成功', Cookie('__forward__'));exit;
                } else {
                    $this->error('新增失败');
                }
            } else {
                $this->error($freight->getError());
            }
		}
		$this->display();
	}
	
	/**
	 * 编辑运费模板
	 * @author han <glghan@sina.com>
	 */
	public function editFreight(){
		
		if(IS_POST){
			$freight = M('freight_tpl');
            $data = $freight->create();
            $data['updateTime'] = date('Y-m-d H:i:s',time());
            if($data){
            	$result = $freight->save($data);
                if($result){
                    session('ADMIN_MENU_LIST',null);
                    //记录行为
                    action_log('update_freight', 'freight', $data['id'], UID);
                    $this->success('更新成功', Cookie('__forward__'));exit;
                } else {
                    $this->error('更新失败');
                }
            } else {
                $this->error($freight->getError());
            }
		}
		
		$id = I('get.id');
		$info = M('freight_tpl')->field(true)->find($id);
		$this->assign('info', $info);
		$this->display();
	}
	

	/**
	 * 删除运费模板
	 * @author han <glghan@sina.com>
	 */
	public function delFreight($id=''){
		$freight = M('freight_tpl');
		$data['ID'] = $id;
		$data['status'] = 'DEL';
		$data['delTime'] = date('Y-m-d H:i:s',time());
		if($data){
			$result = $freight->save($data);
			if($result){
				session('ADMIN_MENU_LIST',null);
				//记录行为
				action_log('delete_freight', 'freight', $data['id'], UID);
				$this->success('删除成功', Cookie('__forward__'));exit;
			} else {
				$this->error('删除失败');
			}
		} else {
			$this->error($freight->getError());
		}
	}
	
	/**
	 * 指定地区
	 * @author han <glghan@sina.com>
	 */
	public function areaList(){
		$this->meta_title = '指定地区列表';
		$freightID = I('get.id');
		$list       =   M('freight_tpl_except')->where('freightTplID='.$freightID)->select();
		$request    =   (array)I('request.');
		$total      =   $list? count($list) : 1 ;
		$listRows   =   C('LIST_ROWS') > 0 ? C('LIST_ROWS') : 10;
		$page       =   new \Think\Page($total, $listRows, $request);
		$voList     =   array_slice($list, $page->firstRow, $page->listRows);
		$p          =   $page->show();
		$this->assign('id',$freightID);
		$this->assign('_list', $voList);
		$this->assign('_page', $p? $p: '');
		// 记录当前列表页的cookie
		Cookie('__forward__',$_SERVER['REQUEST_URI']);
		$this->display();
	}
	
	/**
	 * 添加指定地区
	 * @author han <glghan@sina.com>
	 */
	public function addArea(){
		$freightID = I('get.id');
		if(IS_POST){
			
		}
		$country = M('xbdistrict')->where('pid=0')->select();
		//echo '<pre>';
		//header('content-type:text/html;charset=utf-8');
		//var_dump($country);exit;
		$this->assign('country',$country);
		$this->assign('id',$freightID);
		$this->display();
	}
}	

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
 * 供应商管理控制器
 * @author han <glghan@sina.com>
 */
class SupplierController extends AdminController{
	
	/**
	 * 供应商列表
	 * @author han <glghan@sina.com>
	 */
	public function supplierList(){
		$this->display();
	}
	
	/**
	 * 新增供应商
	 * @author han <glghan@sina.com>
	 */
	public function addSupplier(){
		$this->display();
	}
	
}
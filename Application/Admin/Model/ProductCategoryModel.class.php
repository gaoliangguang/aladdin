<?php
// +----------------------------------------------------------------------
// | ShareiHome [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2014 http://www.shareihome.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: 王雪兵 <406964108@qq.com>
// +----------------------------------------------------------------------

namespace Admin\Model;

/**
 * 产品分类模型
 * @author 王雪兵 <406964108@qq.com>
 */
class ProductCategoryModel extends CategoryModel{

	protected $_validate = array(
			array('title', 'require', '名称不能为空', self::MUST_VALIDATE , 'regex', self::MODEL_BOTH),
	);
	
	protected $_auto = array(
			array('status', '1', self::MODEL_BOTH),
	);
}

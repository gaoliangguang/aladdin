<?php
// +----------------------------------------------------------------------
// | 中国城市三四级联动
// +----------------------------------------------------------------------
// | Copyright (c) 2014 http://www.shareihome.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: xuebing <406964108@qq.com> <http://www.shareihome.com>
// +----------------------------------------------------------------------


/**
 * 中国省市区三四级联动插件
 * @author xuebing
 */

namespace Addons\XbDistrict\Controller;
use Admin\Controller\AddonsController;

class XbDistrictController extends AddonsController{
	
	//获取中国省份信息
	public function getData($level=4){
	    
		if (IS_AJAX){
		    $cache_key = 'xbdistrict'.$level;
			$data = S($cache_key);
            $data = [];
			if(!$data){
    			foreach (M('xbdistrict')->where(array('level'=>array('lt',$level)))->select() as $tmp){
    			    $data[$tmp['pid']][$tmp['id']] = array($tmp['id'],$tmp['name']);
    			}
    			S($cache_key,$data);
			}
			
			$this->ajaxReturn($data,'json',JSON_UNESCAPED_UNICODE);
		}
	}
}
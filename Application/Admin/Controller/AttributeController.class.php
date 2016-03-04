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
 * 属性控制器
 * @author han <glghan@sina.com>
 */
class AttributeController extends AdminController {

    /**
     * 获取商品属性
     * @author han <glghan@sina.com>
     */
    public function getAttr(){
    	//$productID = 1;
        $productID = I('get.productID');
		$productAttr = D('Product_attr');
		
		if($productID){
			// 获取对应商品下的属性及属性值
			$info = $productAttr->field("a.*, b.attrValue,b.ID as valueID")
			->join(" a left join t_product_attr_value b on a.ID = b.attrID ")
			->where("productID = $productID")->select(); 
			
		}else{
			$this->error('请选择商品');
		}
		$this->assign('attr',$info);
    }
    
    /**
     * 商品属性入库 
     * @author han <glghan@sina.com>
     */
	public function addAttr($productID='',$attr=array(),$sttr=array()){
		//商品id(唯一)
		$productID = 3;
		//操作员id
		$uid = UID;
		//属性及属性值数据
		$attr = array(
				'颜色'=>array('白'),
				'尺寸'=>array(21,22)			
			);
		
		//sku数据
		$sttr = array(
			'1-4' =>array (
					'key' =>  '1-4' ,
					'name' =>  '颜色:白,尺寸:22' ,
					'price' =>  '0.0' ,
					'supply_price' =>  '0.0' ,
					'quantity' =>  '50'
			),
			'1-3' =>array(
					'key' => '1-3' ,
					'name' =>  '颜色:白,尺寸:21' ,
					'price' =>  '0.0' ,
					'supply_price' =>  '0.0' ,
					'quantity' =>  '50' ,
			),
	);
		
	if(is_array($sttr)){
		foreach($sttr as $k=>$v){
			$name = $sttr[$k]['name'];	
			$name = explode(',',$name);
			foreach ($name as $k1=>$v1){
				$attrValue = explode(':',$name[$k1]);
				$attrName = $attrValue[0];
				$value1 = $attrValue[1];
				$newAttr[$attrName] = $value1;
			}
			$sttr[$k]['name'] = $newAttr;		
		}
	}else{
		return false;
	}
		
		//导入属性
		if(is_array($attr)){
			foreach ($attr as $k=>$v){
				$productAttrModel = M('Product_attr');
				
				//构建数据		
				$data['attrName'] = $k;
				$data['productID'] = $productID;
				$data['sortOrder'] = 0;
				$data['uid'] = $uid;
				$data['createTime'] = date('Y-m-d H:i:s',time());
				
				$attrID = $productAttrModel->add($data);
				
				//导入属性值
				if($attrID){
					foreach ($v as $k1=>$v1){
						$productAttrValueModel = M('Product_attr_value');
						
						//构建数据
						$value['attrValue'] = $v1;
						$value['attrID'] = $attrID;
						$value['uid'] = $uid;
						$value['sortOrder'] = 1;
						$value['createTime'] = date('Y-m-d H:i:s',time());
						
						$attrValueID = $productAttrValueModel->add($value);
	
						if(!$attrValueID){
							return  $productAttrValueModel->getError();
						}
					}
				}else{
					
					return  $productAttrModel->getError();
				}
			}
		}else {
			return false;
		}
		
		//导入sku
		if(is_array($sttr)){
			foreach ($sttr as $k=>$v){
				$productSkuModel = M('Product_sku');
				
				//构建数据
				$skuData['productID'] = $productID;
				$skuData['uid'] = $uid;
				$skuData['applyPrice'] = $sttr[$k]['supply_price'];
				$skuData['skuPrice'] = $sttr[$k]['price'];
				$skuData['skuStock'] = $sttr[$k]['quantity'];
				$skuData['createTime'] = date('Y-m-d H:i:s',time());
				
				$skuID = $productSkuModel->add($skuData);
				
				//导入sku_attr
				if($skuID){
					foreach ($v['name'] as $k1=>$v1){
						$productSkuAttrModel = M('Product_sku_attr');
						
						/*构建数据*/
						$skuAttr['skuID'] = $skuID;
						$skuAttr['uid'] = $uid;
						$skuAttr['sortOrder'] = 3;
						$skuAttr['createTime'] = date('Y-m-d H:i:s',time());	
						//获取attrID及attrValueID
						$attriBute = $productAttrModel->where('productID='.$productID.' and attrName='."'{$k1}'")
						->select();
						$skuAttr['attrID'] = $attriBute[0]['id'];
						 $attriButeValue= $productAttrValueModel->where('attrID='.$skuAttr['attrID'].' and attrValue='."'{$v1}'")
						->select();
						 $skuAttr['attrValueID'] = $attriButeValue[0]['id'];
						 
						$skuAttrID = $productSkuAttrModel->add($skuAttr);
						if(!$skuAttrID){
							return  $productSkuAttrModel->getError();
						}
					}
				}else {
					return  $productSkuModel->getError();
				}
			}
		}else {
			return false;
		}
		return true;
	}
    
}

<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: huajie <banhuajie@163.com>
// +----------------------------------------------------------------------

namespace Admin\Model;
use Think\Model;
use Admin\Model\AuthGroupModel;

/**
 * 文档基础模型
 */
class ProductModel extends Model{

    /**
     * 生成推荐位的值
     * @return number 推荐位
     * @author huajie <banhuajie@163.com>
     */
    protected function getPosition(){
        $position = I('post.position');
        if(!is_array($position)){
            return 0;
        }else{
            $pos = 0;
            foreach ($position as $key=>$value){
                $pos += $value;		//将各个推荐位的值相加
            }
            return $pos;
        }
    }
    /**
     * 获取第一张图片
     * @return number 图片
     * @author 王雪兵 <406964108@qq.com>
     */
    protected function getPic(){
        return I('post.pic0');
    }


    /**
     * 删除状态为-1的数据（包含扩展模型）
     * @return true 删除成功， false 删除失败
     * @author huajie <banhuajie@163.com>
     */
    public function remove(){
        //查询假删除的基础数据
        if ( is_administrator() ) {
            $map = array('status'=>-1);
        }else{
            $cate_ids = AuthGroupModel::getAuthCategories(UID);
            $map = array('status'=>-1,'category_id'=>array( 'IN',trim(implode(',',$cate_ids),',') ));
        }
        $base_list = $this->where($map)->field('id,model_id')->select();
        //删除扩展模型数据
        $base_ids = array_column($base_list,'id');
        //孤儿数据
        $orphan   = get_stemma( $base_ids,$this, 'id,model_id');

        $all_list  = array_merge( $base_list,$orphan );
        foreach ($all_list as $key=>$value){
            $logic = $this->logic($value['model_id']);
            $logic->delete($value['id']);
        }

        //删除基础数据
        $ids = array_merge( $base_ids, (array)array_column($orphan,'id') );
        if(!empty($ids)){
            $res = $this->where( array( 'id'=>array( 'IN',trim(implode(',',$ids),',') ) ) )->delete();
        }

        return $res;
    }

}
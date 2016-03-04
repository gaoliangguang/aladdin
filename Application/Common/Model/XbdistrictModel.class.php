<?php
namespace Common\Model;

/**
 * 生成多层树状下拉选框的工具模型
 */
class XbdistrictModel extends \Think\Model {
    
    public function getParentsText($id){
        
        $parents = $this->getParents($id);
        krsort($parents);
        $text = '';
        foreach ($parents as $tmp){
            $text .= $tmp['name'].' ';
        }
        return $text;
    }
    
    public function getParents($id){
        
        static $parents;
        $item = $this->where(array('id'=>$id))->find();
        if(!empty($item)){
            
            $parents[] = $item;
            if($item['pid'] > 0){
               $this->getParents($item['pid']); 
            }
        }
        
        return $parents;
    }
}
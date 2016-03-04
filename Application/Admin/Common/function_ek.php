<?php
// +----------------------------------------------------------------------
// | Date:2016年2月23日
// +----------------------------------------------------------------------
// | Author: EK_熊<1439527494@qq.com>
// +----------------------------------------------------------------------
// | Description: 此文件作用于业务公共方法
// +----------------------------------------------------------------------


/**
 * 设置业务配置信息
 * 对应的表 t_configcommon
 * @param string $label   标签名称
 * @param array $config   配置信息 数组格式
 * @return 
 * date:2016年2月23日
 * author: EK_熊
 */
function set_config_common($label='',$config=array()){
    if (!is_array($config)) {
        return false;
    }
    
    $configModel = M('ConfigCommon');
    $configJson = json_encode($config);
    $findLabel = $configModel->where("label='$label'")->find();
    
    if (empty($findLabel)) { //不存在该标签，进行添加操作
        $add = array(
            'label'  => $label,
            'config' => $configJson,
            'update' => time(),
        );
        $setRet = $configModel->add($add);
    }else{                  //存在该配置标签，进行更新配置信息
        $save = array(
            'config' =>$configJson,
            'update' =>time(),
        );
        $setRet = $configModel->where('id='.$findLabel['id'])->save($save);
    }
    if ($setRet){
        F('cfg_com_'.$label, $config);//配置信息，写入文件缓存
        return $setRet;
    }
    return false;
}

/**
 * 根据标签名称，获取业务公共配置信息；
 * 从缓存文件获取，返回数组格式
 * @param unknown $label 配置标签名称
 * date:2016年2月23日
 * author: EK_熊
 */
function get_config_common($label){

    $cacheCfg = F('cfg_com_'.$label);
    return $cacheCfg;
    
}

/**
 * 转换秒数
 * @param unknown $name 年，月，日，小时
 * @param unknown $num 数量
 * @return number
 * date:2016年2月23日
 * author: EK_熊
 */
function switchToSecond($name, $num){
    switch ($name) {
        case 'day' :
            $sec = $num*86400;
            break;
        case 'month':
            $sec = $num*30*8600;
            break;
        case 'hour':
            $sec = $num*60*60;
            break;
    }
    return $sec;
}

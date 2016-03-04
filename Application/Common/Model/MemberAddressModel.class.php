<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: xuebing <406961008@qq.com>
// +----------------------------------------------------------------------

namespace Common\Model;
use Think\Model;
use User\Api\UserApi;

/**
 * 会员收货地址模型
 */
class MemberAddressModel extends Model{

    /* 自动验证规则 */
    protected $_validate = array(
            array('consignee', 'require', '收件人不能为空', self::MUST_VALIDATE, 'regex', self::MODEL_BOTH),
            array('consignee', '1,60', '收件人长度不能超过60个字符', self::MUST_VALIDATE, 'length', self::MODEL_BOTH),
            array('zipcode', 'require', '邮编不能为空', self::MUST_VALIDATE, 'regex', self::MODEL_BOTH),
            array('zipcode', '/^[\d]+$/', '邮编只能填数字', self::VALUE_VALIDATE, 'regex', self::MODEL_BOTH),
            array('district', 'require', '区域必须选择', self::MUST_VALIDATE, 'regex', self::MODEL_BOTH),
            array('address', 'require', '收货地址不能为空', self::MUST_VALIDATE, 'regex', self::MODEL_BOTH),
            array('address', '1,500', '收件人长度不能超过500个字符', self::VALUE_VALIDATE, 'length', self::MODEL_BOTH),
            array('mobile', 'require', '联系电话不能为空', self::MUST_VALIDATE, 'regex', self::MODEL_BOTH),
            array('mobile', '1,20', '联系电话长度不能超过20个字符', self::VALUE_VALIDATE, 'length', self::MODEL_BOTH),
    );
    
    /* 用户模型自动完成 */
    protected $_auto = array(
        array('uid', 'is_login', self::MODEL_BOTH,'function'),
        array('create_time', NOW_TIME, self::MODEL_INSERT),
        array('update_time', NOW_TIME, self::MODEL_BOTH),
        array('status', 1, self::MODEL_INSERT),
    );
    
}

<?php
/**
 * Created by PhpStorm.
 * User: Timi
 * Date: 2015/12/16
 * Time: 18:49
 */
namespace Admin\Controller;
use Admin\Service\ApiService;

/**
 * 后台投诉举报控制器
 * @author 麦当苗儿 <zuojiazi@vip.qq.com>
 */
class ComplainController extends AdminController{
    /*
     * 投诉
     */
    public function complainList(){
        $prefix = C('DB_PREFIX');
        $model = M()->table($prefix.'xxfb_complain xc')
            ->join($prefix.'user u on xc.user_id = u.id','left');

        $this->assign('_list',$this->lists($model,[],'','xc.*,u.nick_name'));

        $this->meta_title = '投诉列表';
        $this->display();
    }
    /*
     * 举报
     */
    public function reportList(){
        $prefix = C('DB_PREFIX');
        $model = M()->table($prefix.'xxfb_report xc')
                    ->join($prefix.'user u on xc.user_id = u.id','left');

        $this->assign('_list',$this->lists($model,[],'','xc.*,u.nick_name'));

        $this->meta_title = '举报列表';
        $this->display();
    }
}
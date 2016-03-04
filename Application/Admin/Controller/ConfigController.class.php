<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------

namespace Admin\Controller;

/**
 * 后台配置控制器
 * @author 麦当苗儿 <zuojiazi@vip.qq.com>
 */
class ConfigController extends AdminController {

    /**
     * 采购类别管理列表
     * @author 麦当苗儿 <zuojiazi@vip.qq.com>
     */
    public function category(){
        $tree = D('cggl_purchase_category')->getTree(0,'id,category,description,name,parent_id,status');
        $this->assign('tree', $tree);
        C('_SYS_GET_CATEGORY_TREE_', true); //标记系统获取分类树模板
        $this->meta_title = '分类管理';
        $this->display();
    }

    /**
     * 禁用和启用
     * @author 麦当苗儿 <zuojiazi@vip.qq.com>
     */
    public function setSt(){
        $data['status']=I('status');
        if(empty($data['status'])){
            $this->error("状态查询失败，请刷新再试！");
        }
        $where['id']=I('id');
        if(empty($where['id'])){
            $this->error("编号查询失败，请刷新再试！");
        }
        if($data['status']=="OFF"){
            $data['status']="OK#";
        }else{
            $data['status']="OFF";
        }
//        $Category->_sql();
//        die;
        if(false !== M('cggl_purchase_category')->where($where)->save($data)){
            $this->success('编辑成功！');
        } else {
            $error = M('cggl_purchase_category')->getError();
            $this->error(empty($error) ? '未知错误！' : $error);
        }

    }

    /**
     * 显示分类树，仅支持内部调
     * @param  array $tree 分类树
     * @author 麦当苗儿 <zuojiazi@vip.qq.com>
     */
    public function tree($tree = null){
        C('_SYS_GET_CATEGORY_TREE_') || $this->_empty();
        $this->assign('tree', $tree);
        $this->display('tree');
    }

    /* 编辑分类 */
    public function editcategory($id = null, $pid = 0){
        $Category = D('cggl_purchase_category');

        if(IS_POST){ //提交表单
            if(false !== $Category->update()){
                $this->success('编辑成功！', U('category'));
            } else {
                $error = $Category->getError();
                $this->error(empty($error) ? '未知错误！' : $error);
            }
        } else {
            $cate = '';
            if($pid){
                /* 获取上级分类信息 */
                $cate = $Category->info($pid, 'id,name,category,status');
                if(!($cate && 'OK#' == $cate['status'])){
                    $this->error('指定的上级分类不存在或被禁用！');
                }
            }

            /* 获取分类信息 */
            $info = $id ? $Category->info($id) : '';

            $this->assign('info',       $info);
            $this->assign('category',   $cate);
            $this->meta_title = '编辑分类';
            $this->display();
        }
    }

    /* 新增分类 */
    public function addcategory($pid = 0){
        $Category = D('cggl_purchase_category');

        if(IS_POST){ //提交表单
            if(false !== $Category->update()){
                $this->success('新增成功！', U('category'));
            } else {
                $error = $Category->getError();
                $this->error(empty($error) ? '未知错误！' : $error);
            }
        } else {
            $cate = array();
            if($pid){
                /* 获取上级分类信息 */
                $cate = $Category->info($pid, 'id,category,name,status');
                if(!($cate && 'OK#' == $cate['status'])){
                    $this->error('指定的上级分类不存在或被禁用！');
                }
            }

            /* 获取分类信息 */
            $this->assign('info',       null);
            $this->assign('category', $cate);
            $this->meta_title = '新增分类';
            $this->display('editcategory');
        }
    }

    /**
     * 删除一个分类
     * @author huajie <banhuajie@163.com>
     */
    public function removecategory(){
        $cate_id = I('id');
        if(empty($cate_id)){
            $this->error('参数错误!');
        }

        //判断该分类下有没有子分类，有则不允许删除
        $child = M('cggl_purchase_category')->where(array('parent_id'=>$cate_id))->field('id')->select();
        if(!empty($child)){
            $this->error('请先删除该分类下的子分类');
        }

        //判断该分类下有没有内容
        $_where='productId='.$cate_id.' or category='.$cate_id;
        $document_list = M('cggl_purchase_detail')->where($_where)->field('id')->select();
        if(!empty($document_list)){
            $this->error('该类别被用户使用中，无法删除！');
        }
        echo M()->_sql();
        //删除该分类信息
        $res = M('cggl_purchase_category')->delete($cate_id);
        if($res !== false){
            //记录行为
            action_log('update_category', 'category', $cate_id, UID);
            $this->success('删除分类成功！');
        }else{
            $this->error('删除分类失败！');
        }
    }

    /**
     * 操作分类初始化
     * @param string $type
     * @author huajie <banhuajie@163.com>
     */
    public function operatecategory($type = 'move'){
        //检查操作参数
        if(strcmp($type, 'move') == 0){
            if(IS_POST){
                $this->movecategory();
            }
            $operate = '移动';
        }elseif(strcmp($type, 'merge') == 0){
            if(IS_POST){
                $this->mergecategory();
            }
            $operate = '合并';
        }else{
            $this->error('参数错误！');
        }

        $from = intval(I('from'));
        empty($from) && $this->error('参数错误！');

        //获取分类
        $map = array('status'=>'OK#', 'id'=>array('neq', $from));
        $list = M('cggl_purchase_category')->where($map)->field('id,parent_id,category,name')->select();


        //移动分类时增加移至根分类
        if(strcmp($type, 'move') == 0){
            //不允许移动至其子孙分类
            $list = tree_to_list(list_to_tree($list));

            $pid = M('cggl_purchase_category')->getFieldById($from, 'parent_id');
           // $pid && array_unshift($list, array('id'=>null,'name'=>'根分类'));
        }

        $this->assign('type', $type);
        $this->assign('operate', $operate);
        $this->assign('from', $from);
        $this->assign('list', $list);
        $this->meta_title = $operate.'分类';
        $this->display();
    }

    /**
     * 移动分类
     * @author huajie <banhuajie@163.com>
     */
    public function movecategory(){
        $to = I('post.to');
        $from = I('post.from');
        if(!empty($to)){
            $res = M('cggl_purchase_category')->where(array('id'=>$from))->setField('parent_id', $to);
        }else{
            $res = M('cggl_purchase_category')->data(['parent_id'=>['exp','null']])->where(array('id'=>$from))->save();

        }
        if($res !== false){
            $this->success('分类移动成功！', U('category'));
        }else{
            $this->error('分类移动失败！');
        }
    }

    /**
     * 合并分类
     * @author huajie <banhuajie@163.com>
     */
    public function mergecategory(){
        $to = I('post.to');
        $from = I('post.from');
        $Model = M('Category');

        //检查分类绑定的模型
        $from_models = explode(',', $Model->getFieldById($from, 'model'));
        $to_models = explode(',', $Model->getFieldById($to, 'model'));
        foreach ($from_models as $value){
            if(!in_array($value, $to_models)){
                $this->error('请给目标分类绑定' . get_document_model($value, 'name') . '模型');
            }
        }

        //检查分类选择的文档类型
        $from_types = explode(',', $Model->getFieldById($from, 'type'));
        $to_types = explode(',', $Model->getFieldById($to, 'type'));
        foreach ($from_types as $value){
            if(!in_array($value, $to_types)){
                $types = C('DOCUMENT_MODEL_TYPE');
                $this->error('请给目标分类绑定文档类型：' . $types[$value]);
            }
        }

        //合并文档
        $res = M('Document')->where(array('category_id'=>$from))->setField('category_id', $to);

        if($res !== false){
            //删除被合并的分类
            $Model->delete($from);
            $this->success('合并分类成功！', U('index'));
        }else{
            $this->error('合并分类失败！');
        }

    }

    /**
     * 敏感词列表
     * @param int $p
     */
    public function banwordlist($p=0){

        $this->assign('active_menu','config/banwordlist');
        $this->assign('add_url','config/addbanword');

        $control = new ThinkController();
        $control->lists('base_ban_word',$p);
    }



    /**
     * 敏感词添加页面
     */
    public function addbanword(){

        if(IS_POST){
            $word_list = trim(I('post.word'));
            if(empty($word_list)){
                $this->error('请输入关键词！');
            }
            $word_list = str_replace(array(' '), ',', $word_list);
            $word_list = explode(',',$word_list);
            $exist = M('base_ban_word')->where(['word'=>['in',implode(',',$word_list)]])->getField('id,word');
            if(!empty($exist)){
                $this->error(implode('、',$exist).'已经存在！');
            }
            $datas = [];
            foreach($word_list as $word){
                $datas[] = ['word'=>$word];
            }
            if(M('base_ban_word')->addAll($datas)){
                $this->success('添加成功！',U('config/banwordlist'));
            }else{

                $this->error('添加失败，请重新再试或联系管理员！');
            }
        }
        $this->assign('active_menu','config/banwordlist');
        $this->assign('form_action','config/addbanword');

        $control = new ThinkController();
        $control->add(27,'config/banwordlist');
    }

    /**
     * 敏感词编辑页面
     * @param int $id
     */
    public function editbanword($id=0){

        if(IS_POST){
            $word = trim(I('post.word'));
            if(empty($word)){
                $this->error('请输入敏感词语！');
            }

            $exist = M('base_ban_word')->where(['word'=>$word])->find();
            if(!empty($exist) && $exist['id'] != $id){
                $this->error(implode('、',$exist).'已经存在！');
            }
        }

        $this->assign('active_menu','config/banwordlist');
        $this->assign('form_action','config/editbanword');

        $control = new ThinkController();
        $control->edit(27,$id,'config/banwordlist');
    }

    /**
     * 敏感词删除
     * @param int $id
     */
    public function delbanword($id=0){

        if(M('base_ban_word')->where(['id'=>intval($id)])->delete()){
            $this->success('删除成功！');
        }else{
            $this->error('删除失败，请重新再试！');
        }
    }
    /**
     *
     */
    public function platformbank(){

        if(IS_POST){
            $data = I('post.');
            if(empty($data['bank_branch_name'])){
                $this->error('开户银行名称不能为空！');
            }
            if(empty($data['account_no'])){
                $this->error('银行账号不能为空！');
            }
            if(empty($data['account_name'])){
                $this->error('公司名称不能为空！');
            }
            if(empty($data['address'])){
                $this->error('公司地址不能为空！');
            }
            if(empty($data['tax_no'])){
                $this->error('税号不能为空！');
            }
            if(empty($data['telephone'])){
                $this->error('电话不能为空！');
            }
/*
            if(empty($data['bank_name'])){
                $this->error('银行名称不能为空！');
            }
            if(empty($data['province'])){
                $this->error('省份不能为空！');
            }
            if(empty($data['city'])){
                $this->error('城市不能为空！');
            }
            if(empty($data['account_name'])){
                $this->error('开户人名称不能为空！');
            }
*/

            if(M('platform_bankcard')->where(['id'=>1])->save($data)){
                $return = ['status'=>1,'info'=>'修改成功！','item'=>$data];

                $this->ajaxReturn($return);
            }else{
                $this->error('修改失败！');
            }
        }
        $item = M('platform_bankcard')->find(1);

        $this->assign('item',$item);

        $this->meta_title = '平台银行账户设置';
        $this->display();
    }
    /**
     * 工程类型修改
     * @param string $id
     */
    public function industry($id = ''){

        if(empty($id)){
            $this->error('ID不能为空！');
        }

        $this->assign('active_menu','config/hangye');
        $this->assign('form_action','config/industry');

        $control = new ThinkController();
        $control->edit(26,$id,'config/hangye');
    }
    //工程类型管理
    public function hangye($p=0){

        $control = new ThinkController();
        $control->lists('base_industry',$p);
    }

    //工程类型管理
    public function addhangye(){
        if(IS_POST){
            $data = [];
            $data['id'] = I('id');
            if(empty($data['id'])){
                $this->error('工程类型内部标识不能为空！');
            }
            if(M('base_industry')->find($data['id'])){
                $this->error('工程类型内部标识不能重复！');
            }
            $data['industry_name'] = I('industry_name');
            if(empty($data['id'])){
                $this->error('工程类型不能为空！');
            }
            $data['industry_icon'] = I('industry_icon');
            if(empty($data['id'])){
                $this->error('工程类型图标不能为空！');
            }
            $data['indestry_type'] = I('industry_type');
            if(empty($data['indestry_type'])){
                $this->error('承包类型不能为空！');
            }
            if(M('base_industry')->add($data)){
                $this->success('添加成功',U('config/hangye'));
            }else{
                $this->error('保存失败，请重新再试或联系管理员');
            }
        }
        $this->meta_title = '添加工程类型';
        $this->display();
    }

    /**
     * 工程类型资质证书管理
     * @param string $id
     */
    public function hyzs($id = ''){

        if(empty($id)){
            $this->error('ID不能为空！');
        }

        if(IS_POST){
            $selected = I('post.selected',[]);
            if(empty($selected) || !is_array($selected)){
                $this->error('请选择资质证书!');
            }
            $dataList = [];
            foreach($selected as $certification_id){
                $dataList[] = [
                    'industry_id'=>$id,
                    'certification_id'=>$certification_id,
                ];
            }

            $model = M('base_industry_certification');
            //先删除旧的数据！
            $model->where(['industry_id'=>$id])->delete();

            //再添加新的
            if($model->addAll($dataList)){
                $this->success('保存成功!',U('config/hangye'));
            }else{
                $this->error('保存失败,请重新再试!');
            }
        }

        $pList = M('base_certification_type')->getField('id,certification_name');

        $selected = [];

        $industry_name = M('base_industry')->where(['id'=>$id])->getField('industry_name');

        foreach(M('base_industry_certification')
                    ->where(['industry_id'=>$id])
                    ->getField('id,certification_id')
                as $certification_id){
            if(array_key_exists($certification_id,$pList)){
                $selected[$certification_id] = $pList[$certification_id];
                unset($pList[$certification_id]);
            }
        }

        $this->meta_title = '工程类型资质管理';

        $this->assign('industry_name',$industry_name);
        $this->assign('plist',$pList);
        $this->assign('selected',$selected);
        $this->display();
    }


    /**
     * 资质证书作废
     * @param int $id
     */
    public function delcerttype($id=0){

        if(M('base_certification_type')->where(['id'=>intval($id)])->save(['status'=>'OFF'])){
            $this->success('作废成功！');
        }else{
            $this->error('作废失败，请重新再试！');
        }
    }
    /**
     * 资质证书列表
     * @param int $p
     */
    public function certtypelist($p=0){

        $this->assign('active_menu','config/certtypelist');
        $this->assign('add_url','config/addcerttype');

        $control = new ThinkController();
        $control->lists('base_certification_type',$p,['status'=>'OK#']);
    }

    /**
     * 资质证书添加页面
     */
    public function addcerttype(){

        $this->assign('active_menu','config/certtypelist');
        $this->assign('form_action','config/addcerttype');

        $control = new ThinkController();
        $control->add(24,'config/certtypelist');
    }

    /**
     * 资质证书编辑页面
     * @param int $id
     */
    public function editcerttype($id=0){

        $this->assign('active_menu','config/certtypelist');
        $this->assign('form_action','config/editcerttype');

        $control = new ThinkController();
        $control->edit(24,$id,'config/certtypelist');
    }

    /**
     * 手续费率列表
     * @param int $p
     */
    public function feerate($p=0){
        $list = [];
        foreach(M('yhzj_fee_rate')->order('type,min_amount')->select() as $item){
            $list[$item['type']][] = $item;
        }
        $this->assign('list',$list);
        $this->assign('type_list',C('FEE_TYPE_LIST'));
        $this->meta_title = '手续费管理';
        $this->display();
    }

    /**
     * 手续费率添加页面
     */
    public function addfeerate(){

        if(IS_POST){
            $_POST['min_amount'] = price_dispose($_POST['min_amount']);
            $_POST['max_amount'] = price_dispose($_POST['max_amount']);
            $_POST['max_fee'] = price_dispose($_POST['max_fee']);
        }
        $this->assign('active_menu','config/feerate');
        $this->assign('form_action','config/addfeerate');

        $control = new ThinkController();
        list($model,$fields) = $control->padd(23,'config/feerate');

        foreach($fields[1] as &$item){
            if($item['name'] == 'type'){
                $item['value'] = I('type');
                break;
            }
        }
        $this->assign('fields', $fields);
        $this->display($model['template_add']?$model['template_add']:'');
    }

    /**
     * 手续费率编辑页面
     * @param int $id
     */
    public function editfeerate($id=0){

        $this->assign('active_menu','config/feerate');
        $this->assign('form_action','config/editfeerate');

        $control = new ThinkController();
        if(IS_POST){
            $_POST['min_amount'] = price_dispose($_POST['min_amount']);
            $_POST['max_amount'] = price_dispose($_POST['max_amount']);
            $_POST['max_fee'] = price_dispose($_POST['max_fee']);
        }
        list($model,$data) = $control->pedit(23,$id,'config/feerate');
        $data['min_amount'] = ($data['min_amount'])/100;
        $data['max_amount'] = ($data['max_amount'])/100;
        $data['max_fee'] = ($data['max_fee'])/100;

        $this->assign('data', $data);

        $this->display($model['template_edit']?$model['template_edit']:'');
    }

    public function delfeerate($id=0){

        if(M('yhzj_fee_rate')->where(['id'=>intval($id)])->delete()){
            $this->success('删除成功！');
        }else{
            $this->error('删除失败，请重新再试！');
        }
    }
    /**
     * 配置管理
     * @author 麦当苗儿 <zuojiazi@vip.qq.com>
     */
    public function index(){
        /* 查询条件初始化 */
        $map = array();
        $map  = array('status' => 1);
        if(isset($_GET['group'])){
            $map['group']   =   I('group',0);
        }
        if(isset($_GET['name'])){
            $map['name']    =   array('like', '%'.(string)I('name').'%');
        }

        $list = $this->lists('Config', $map,'sort,id');
        // 记录当前列表页的cookie
        Cookie('__forward__',$_SERVER['REQUEST_URI']);

        $this->assign('group',C('CONFIG_GROUP_LIST'));
        $this->assign('group_id',I('get.group',0));
        $this->assign('list', $list);
        $this->meta_title = '配置管理';
        $this->display();
    }

    /**
     * 新增配置
     * @author 麦当苗儿 <zuojiazi@vip.qq.com>
     */
    public function add(){
        if(IS_POST){
            $Config = D('Config');
            $data = $Config->create();
            if($data){
                if($Config->add()){
                    S('DB_CONFIG_DATA',null);
                    $this->success('新增成功', U('index'));
                } else {
                    $this->error('新增失败');
                }
            } else {
                $this->error($Config->getError());
            }
        } else {
            $this->meta_title = '新增配置';
            $this->assign('info',null);
            $this->display('edit');
        }
    }

    /**
     * 编辑配置
     * @author 麦当苗儿 <zuojiazi@vip.qq.com>
     */
    public function edit($id = 0){
        if(IS_POST){
            $Config = D('Config');
            $data = $Config->create();
            if($data){
                if($Config->save()){
                    S('DB_CONFIG_DATA',null);
                    //记录行为
                    action_log('update_config','config',$data['id'],UID);
                    $this->success('更新成功', Cookie('__forward__'));
                } else {
                    $this->error('更新失败');
                }
            } else {
                $this->error($Config->getError());
            }
        } else {
            $info = array();
            /* 获取数据 */
            $info = M('Config')->field(true)->find($id);

            if(false === $info){
                $this->error('获取配置信息错误');
            }
            $this->assign('info', $info);
            $this->meta_title = '编辑配置';
            $this->display();
        }
    }

    /**
     * 批量保存配置
     * @author 麦当苗儿 <zuojiazi@vip.qq.com>
     */
    public function save($config){
        if($config && is_array($config)){
            $Config = M('Config');
            foreach ($config as $name => $value) {
                $map = array('name' => $name);
                $Config->where($map)->setField('value', $value);
            }
        }
        S('DB_CONFIG_DATA',null);
        $this->success('保存成功！');
    }

    /**
     * 删除配置
     * @author 麦当苗儿 <zuojiazi@vip.qq.com>
     */
    public function del(){
        $id = array_unique((array)I('id',0));

        if ( empty($id) ) {
            $this->error('请选择要操作的数据!');
        }

        $map = array('id' => array('in', $id) );
        if(M('Config')->where($map)->delete()){
            S('DB_CONFIG_DATA',null);
            //记录行为
            action_log('update_config','config',$id,UID);
            $this->success('删除成功');
        } else {
            $this->error('删除失败！');
        }
    }

    // 获取某个标签的配置参数
    public function group() {
        $id     =   I('get.id',1);
        $type   =   C('CONFIG_GROUP_LIST');
        $list   =   M("Config")->where(array('status'=>1,'group'=>$id))->field('id,name,title,extra,value,remark,type')->order('sort')->select();
        if($list) {
            $this->assign('list',$list);
        }
        $this->assign('id',$id);
        $this->meta_title = $type[$id].'设置';
        $this->display();
    }

    /**
     * 配置排序
     * @author huajie <banhuajie@163.com>
     */
    public function sort(){
        if(IS_GET){
            $ids = I('get.ids');

            //获取排序的数据
            $map = array('status'=>array('gt',-1));
            if(!empty($ids)){
                $map['id'] = array('in',$ids);
            }elseif(I('group')){
                $map['group']	=	I('group');
            }
            $list = M('Config')->where($map)->field('id,title')->order('sort asc,id asc')->select();

            $this->assign('list', $list);
            $this->meta_title = '配置排序';
            $this->display();
        }elseif (IS_POST){
            $ids = I('post.ids');
            $ids = explode(',', $ids);
            foreach ($ids as $key=>$value){
                $res = M('Config')->where(array('id'=>$value))->setField('sort', $key+1);
            }
            if($res !== false){
                $this->success('排序成功！',Cookie('__forward__'));
            }else{
                $this->error('排序失败！');
            }
        }else{
            $this->error('非法请求！');
        }
    }
}

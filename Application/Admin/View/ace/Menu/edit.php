<extend name="Public/base"/>

<block name="body">
    <?php 
        echo ace_form_open('','',array('id'=>$info['id']));
        $options = array(
            'label_text'=>'标题',
            'help'=>'用于后台显示的配置标题',
        );
        echo ace_input_m($options,array('name'=>'title','class'=>'width-100'),$info['title'],'maxlength="36"');

        $options = array(
            'label_text'=>'排序',
            'help'=>'用于分组显示的顺序',
        );
        echo ace_input($options,array('name'=>'sort','class'=>'only-num width-100'),isset($info['sort']) ? $info['sort'] : 0,'maxlength="10"');

        $options = array(
            'label_text'=>'链接',
            'help'=>'U函数解析的URL或者外链',
        );
        echo ace_input_m($options ,'url',$info['url']);

        $data = array('label_text'=>'上级菜单','help'=>'所属的上级菜单');
        echo ace_dropdown($data,'pid',$Menus,$info['pid']);

        $options = array(
            'label_text'=>'分组',
            'help'=>'用于左侧分组二级菜单',
        );
        echo ace_input($options,array('name'=>'group','class'=>'width-100'),$info['group'],'maxlength="10"');

        echo ace_radio(array('label_text'=>'是否隐藏','help'=>''),'hide',isset($info['hide']) ? $info['hide'] : 0);

        echo ace_radio(array('label_text'=>'仅开发者模式可见','help'=>''),'is_dev',isset($info['is_dev']) ? $info['is_dev'] : 0);

        $options = array(
            'label_text'=>'说明',
            'help'=>'菜单详细说明',
        );
        echo ace_input($options,array('name'=>'group','class'=>'width-100'),$info['tip'],'maxlength="50"');

        $options = array(
            'label_text'=>'样式',
            'help'=>'菜单样式图标',
        );
        echo ace_input($options,array('name'=>'class_fix','class'=>'width-100'),$info['class_fix'],'maxlength="50"');

        echo ace_srbtn();
        echo ace_form_close()
    ?>
</block>

<block name="script">
    <script type="text/javascript">
        //导航高亮
        highlight_subnav('{:U('index')}');
    </script>
</block>
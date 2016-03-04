<extend name="Public/base"/>

<block name="body"> 
    <?php 
        echo ace_form_open();

        $options = array(
            'label_text'=>'昵称',
            'help'=>'',
        );
        echo ace_input($options ,array('name'=>'nickname','class'=>'width-100'),$data['nickname']);

        $options = array(
            'label_text'=>'邮箱',
            'help'=>'用户邮箱',
            'icon'=>'icon-email'
        );
        echo ace_input_m($options ,'email',$data['email'],'maxlength="256"');

        echo ace_srbtn();
        echo ace_form_close()
    ?>
</block>

<block name="script">
    <script type="text/javascript">
        //导航高亮
        highlight_subnav('{:U('User/index')}');
    </script>
</block>

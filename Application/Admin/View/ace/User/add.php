<extend name="Public/base"/>

<block name="body"> 
    <?php 
        echo ace_form_open();

        $options = array(
            'label_text'=>'手机号码',
            'help'=>'用于登录、找回密码和微信端绑定账号用',
            'icon'=>'icon-mobile-phone'
        );
        echo ace_input_m($options ,array('name'=>'username','class'=>'width-100 mobile'),'',' maxlength="11"');

        $options = array(
            'label_text'=>'昵称',
            'help'=>'',
        );
        echo ace_input($options ,array('name'=>'nickname','class'=>'width-100'),'');

        $options = array(
            'label_text'=>'密码',
            'help'=>'用户密码不能少于6位',
            'icon'=>'icon-key'
        );
        echo ace_password($options,'password','','maxlength="16"');

        $options = array(
            'label_text'=>'确认密码',
            'icon'=>'icon-retweet'
        );
        echo ace_password($options,'repassword','','maxlength="16"');

        $options = array(
            'label_text'=>'邮箱',
            'help'=>'用户邮箱',
            'icon'=>'icon-email'
        );
        echo ace_input_m($options ,'email','','maxlength="128"');

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

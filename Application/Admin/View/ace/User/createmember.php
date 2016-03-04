<extend name="Public/base"/>

<block name="body"> 
    <?php 
        echo ace_form_open();
        $options = array(
            'label_text'=>'会员卡号',
            'help'=>'会员卡的号码',
            'icon'=>'icon-card'
        );
        echo ace_input_m($options ,'username','','maxlength="25"');
        $options = array(
            'label_text'=>'手机号码',
            'help'=>'手机号码作为登录的用户名，还用于找回密码等安全操作，同时会作为默认的昵称',
            'icon'=>'icon-mobile-phone'
        );
        echo ace_input_m($options ,array('name'=>'mobile','class'=>'mobile width-100'),'','maxlength="11"');

        $options = array(
            'label_text'=>'姓名',
            'help'=>'会员的姓名',
            'icon'=>'icon-user'
        );
        echo ace_input_m($options ,'nickname','','maxlength="25"');
        
        $options = array(
            'label_text'=>'开卡金额',
            'help'=>'首次开卡的金额，单位元',
            'icon'=>'icon-yen'
        );
        echo ace_input_m($options ,'amount','','maxlength="10"');

        echo ace_srbtn();
        echo ace_form_close()
    ?>
</block>

<block name="script">
    <script type="text/javascript">
        //导航高亮
        highlight_subnav('{:U('User/members')}');
    </script>
</block>

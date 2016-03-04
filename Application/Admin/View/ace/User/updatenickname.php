<extend name="Public/base" />

<block name="body">
<div class="tabbable">
    <ul class="nav nav-tabs padding-18">
        <li class="">
            <a href="{:U('updatepassword')}">
                <i class="orange icon-key bigger-120"></i>修改密码
            </a>
        </li>
        <li class="active">
            <a href="javascript:">
                <i class="green icon-edit bigger-120"></i>修改昵称
            </a>
        </li>
    </ul>
    <div class="tab-content no-border padding-24">
        <div class="tab-pane active">
            <?php 
            echo ace_form_open('user/submitNickname');
            $options = array(
                'label_text'=>'昵称',
                'help'=>'（请输入新昵称）',
            );
            echo ace_input_m($options ,'nickname',get_username());

            echo ace_srbtn();
            echo ace_form_close()
           ?>
       </div>
    </div>
</div>
</block>
<extend name="Public/base" />

<block name="body">

<div class="tabbable">
    <ul class="nav nav-tabs padding-18">
        <li class="active">
            <a href="javascript:">
                <i class="orange icon-key bigger-120"></i>修改密码
            </a>
        </li> <li class="">
            <a href="{:U('updatenickname')}">
                <i class="green icon-edit bigger-120"></i>修改昵称
            </a>
        </li>
    </ul>
    <div class="tab-content no-border padding-24">
        <div class="tab-pane active">
            <?php 
            echo ace_form_open('User/submitPassword');
            $options = array(
                'label_text'=>'原密码',
                'icon'=>'icon-key'
            );
            echo ace_password($options ,array('name'=>'old','autocomplete'=>'off'));

            $options = array(
                'label_text'=>'新密码',
                'icon'=>'icon-key'
            );
            echo ace_password($options ,array('name'=>'password','autocomplete'=>'off'));

            $options = array(
                'label_text'=>'确认密码',
                'icon'=>'icon-retweet'
            );
            echo ace_password($options ,array('name'=>'repassword','autocomplete'=>'off'));

            echo ace_srbtn();
            echo ace_form_close()
           ?>
       </div>
    </div>
</div>
</block>

<block name="script">
	<script src="__STATIC__/thinkbox/jquery.thinkbox.js"></script>
</block>

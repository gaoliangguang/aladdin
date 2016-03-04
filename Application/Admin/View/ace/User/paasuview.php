<extend name="Public/base"/>

<block name="body">
<div id="user-profile-1" class="user-profile row">
    <div class="col-xs-12 col-sm-3 center">
        <div>
            <span class="profile-picture">
                <img width="180" src="<?=(empty($item['head_image'])?'/Public/Ace/avatars/avator.jpg':imageView2($item['head_image']))?>" class="editable img-responsive editable-click editable-empty" id="avatar" />
            </span>
            <div class="width-80 label label-info label-xlg arrowed-in arrowed-in-right">
                <div class="inline position-relative">
                    <a href="#" class="user-title-label dropdown-toggle" data-toggle="dropdown">
                        <i class="icon-circle light-green middle"></i>
                        &nbsp;
                        <span class="white"><?=$item['nick_name']?></span>
                    </a>
                </div>
            </div>
        </div>

        <div class="space-6"></div>

        <!--
        <div class="profile-contact-info">
            <div class="profile-contact-links align-left">

                <a class="btn btn-link" href="#">
                    <i class="icon-envelope bigger-120 pink"></i>
                    发送站内信
                </a>
            </div>

        </div>
        -->

        <div class="hr hr12 dotted"></div>
    </div>

    <div class="col-xs-12 col-sm-9">

        <div class="profile-user-info profile-user-info-striped">
            <div class="profile-info-row">
                <div class="profile-info-name"> 手机号码 </div>

                <div class="profile-info-value">
                    <span class="editable"><?=$item['mobile_num']?>&nbsp;</span>
                </div>
            </div>

            <div class="profile-info-row">
                <div class="profile-info-name"> 真实姓名 </div>

                <div class="profile-info-value">
                    <span class="editable"><?=$item['real_name']?>&nbsp;</span>
                </div>
            </div>

            <div class="profile-info-row">
                <div class="profile-info-name"> 身份证号 </div>

                <div class="profile-info-value">
                    <span class="editable"><?=$item['identity_no']?>&nbsp;</span>
                </div>
            </div>

            <div class="profile-info-row">
                <div class="profile-info-name"> 邮箱 </div>

                <div class="profile-info-value">
                    <i class="icon-email light-orange bigger-110"></i>
                    <?=$item['email']?>&nbsp;
                </div>
            </div>

            <div class="profile-info-row">
                <div class="profile-info-name"> 地址 </div>

                <div class="profile-info-value">
                    <i class="icon-map-marker light-orange bigger-110"></i>
                    <span class="editable"><?=$item['city']?></span>
                    <span class="editable"><?=$item['address']?></span>&nbsp;
                </div>
            </div>

            <div class="profile-info-row">
                <div class="profile-info-name"> 注册时间 </div>

                <div class="profile-info-value">
                    <span class="editable"><?=$item['insert_time']?>&nbsp;</span>
                </div>
            </div>

            <div class="profile-info-row">
                <div class="profile-info-name"> 修改时间 </div>

                <div class="profile-info-value">
                    <span class="editable"><?=$item['update_time']?>&nbsp;</span>
                </div>
            </div>

            <div class="profile-info-row">
                <div class="profile-info-name"> 状态 </div>

                <div class="profile-info-value">
                    <?php $status_text = ['OK#'=>'正常','OFF'=>'禁用'];?>
                    <span class="editable"><?=$status_text[$item['status']]?></span>
                </div>
            </div>

        </div>

    </div>
</div>
</block>

<block name="script">
    <script type="text/javascript">
        //导航高亮
        highlight_subnav('{:U('User/paasusers')}');
    </script>
</block>

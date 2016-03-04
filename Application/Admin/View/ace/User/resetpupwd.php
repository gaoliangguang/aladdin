<extend name="Public/base" />

<block name="body">
<div class="span12">
    <div class="widget-box">
        <div class="widget-header widget-header-blue widget-header-flat">
        </div>

        <div class="widget-body">
            <div class="widget-main">
                <div id="fuelux-wizard" class="row-fluid" data-target="#step-container">
                    <ul class="wizard-steps">
                        <li data-target="#step1" class="active">
                            <span class="step">1</span>
                            <span class="title">提示</span>
                        </li>

                        <li data-target="#step2">
                            <span class="step">2</span>
                            <span class="title">输入资料</span>
                        </li>

                        <li data-target="#step3">
                            <span class="step">3</span>
                            <span class="title">确认重置</span>
                        </li>
                    </ul>
                </div>

                <hr />
                <div class="step-content row-fluid position-relative" id="step-container">
                    <div class="step-pane active" id="step1">
                        <div class="alert alert-danger">
                            <strong>警告！</strong>
                            本功能仅在用户有需要的时候才会使用！
                            点击下一步进入重置用户登录密码页面
                            <br>
                        </div>
                    </div>

                    <div class="step-pane" id="step2">
                        <form id="sample-form" class="form-horizontal">
                            <div class="form-group">
                                <label class="col-xs-12 col-sm-3 control-label no-padding-right" for="inputInfo">
                                    手机号码
                                </label>

                                <div class="col-xs-12 col-sm-5">
                                    <span class="block input-icon input-icon-right">
                                        <input type="text" class="width-100" id="mobile_num" name="mobile_num">
                                        <i class="icon-mobile-phone"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-12 col-sm-3 control-label no-padding-right" for="inputInfo">
                                    身份证号
                                </label>

                                <div class="col-xs-12 col-sm-5">
                                    <span class="block input-icon input-icon-right">
                                        <input type="text" class="width-100" id="id_num" name="id_num">
                                        <i class="icon-info"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-12 col-sm-3 control-label no-padding-right" for="inputInfo">
                                    真实姓名
                                </label>

                                <div class="col-xs-12 col-sm-5">
                                    <span class="block input-icon input-icon-right">
                                        <input type="text" class="width-100" id="real_name" name="real_name">
                                        <i class="icon-user"></i>
                                    </span>
                                </div>
                            </div>

                        </form>
                    </div>

                    <div class="step-pane" id="step3">
                        <div class="center">
                            <div class="alert alert-warning">
                                用户已经查到到，请点击确认重置完成操作，如需取消，请离开本页面即可！
                                <br>
                            </div>
                        </div>
                    </div>

                </div>

                <hr />
                <div class="row-fluid wizard-actions">
                    <button class="btn btn-white btn-prev">
                        <i class="icon-arrow-left"></i>
                        上一步
                    </button>

                    <button class="btn btn-white btn-next" data-last="确认重置 ">
                        下一步
                        <i class="icon-arrow-right icon-on-right"></i>
                    </button>
                </div>
            </div><!-- /widget-main -->
        </div><!-- /widget-body -->
    </div>
</div>
</block>

<block name="script">

<script src="__ACE__/js/fuelux/fuelux.wizard.min.js"></script>

<script>
$(function(){
    window.ace.click_event=$.fn.tap?"tap":"click";
    var user_exist = false;
    $('#fuelux-wizard').ace_wizard().on('change' , function(e, info){
        var wizard = $(this).data("wizard")
        if(info.step == 2 && info.direction == 'next' && !user_exist) {

            var mobile_num = $.trim($("#mobile_num").val());
            if(mobile_num == ''){
                layer.alert('手机号码不能为空',{icon:2});
                return false;
            }
            var id_num = $.trim($("#id_num").val());
            if(id_num == ''){
                layer.alert('身份证号不能为空',{icon:2});
                return false;
            }
            var real_name = $.trim($("#real_name").val());
            if(real_name == ''){
                layer.alert('真实姓名不能为空',{icon:2});
                return false;
            }

            $.post(
                '<?=U('')?>',
                {mobile_num:mobile_num,id_num:id_num,real_name:real_name,method:'check_user'},
                function(resp){
                    if(resp.status == '1'){
                        user_exist = true;
                        wizard.next();
                    }else{
                        layer.alert(resp.info,{icon:2});
                    }
                },
                'json'
            );
            return false;
        }else if(info.step == 2 && info.direction == 'next' && user_exist){
            user_exist = false;
        }
    }).on('finished', function(e) {
        $.post('<?=U('')?>',$("#sample-form").serializeArray(),function(resp){
            if(resp.status == '1'){
                layer.msg('重置成功',{icon:1},function(){
                    window.location = window.location;
                });
            }else{
                layer.alert(resp.info,{icon:2});
            }
        },'json');

    }).on('stepclick', function(e){
        //return false;//prevent clicking on steps
    });
})


</script>
</block>
<extend name="Public/base" />

<block name="body">
<script type="text/javascript" src="__STATIC__/uploadify/jquery.uploadify.min.js"></script>
<div class="page-header">
</div>
<!-- 标签页导航 -->
<div class="tabbable">

    <!-- 表单 -->
    <form id="form" action="{:U('rejectSave?id='.$order['order_id'])}" method="post" class="form-horizontal">
    <div class="tab-content no-border padding-24">
        <!-- 基础文档模型 -->

        <div class="col-xs-12 col-sm-6 widget-container-span ui-sortable" >
            <div class="widget-box">
                <div class="widget-header">
                    <h5>用户信息</h5>

                </div>

                <div class="widget-body">
                    <div class="widget-main">
                        <div class="alert alert-info">
			<input type="hidden" name="user_id" value="{$user.id}">
			<input type="hidden" name="mobile_num" value="{$user.mobile_num}">
                            <div class="row">
                                <div class="col-xs-4">
                                    <label style="padding-top: 4px;">联系号码：</label>
                                </div>
				<div class="col-xs-8">
					{$user.mobile_num}
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-4">
                                    <label style="padding-top: 4px;">用户姓名：</label>
                                </div>
                                <div class="col-xs-8">
                                    {$user.user_name}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-4">
                                    <label style="padding-top: 4px;">所在城市：</label>
                                </div>
                                <div class="col-xs-8">
                                    {$user.city}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-4">
                                    <label style="padding-top: 4px;">所在地区：</label>
                                </div>
                                <div class="col-xs-8">
                                    {$user.district}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-4">
                                    <label style="padding-top: 4px;">QQ：</label>
                                </div>
                                <div class="col-xs-8">
                                    {$user.qq} 
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-4">
                                    <label style="padding-top: 4px;">Email：</label>
                                </div>
                                <div class="col-xs-8">
                                    {$user.email}
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="col-xs-12 col-sm-6 widget-container-span ui-sortable" >
            <div class="widget-box">
                <div class="widget-header">
                    <h5>宝贝信息</h5>

                </div>

                <div class="widget-body">
                    <div class="widget-main" id="baby">
                        <div class="alert alert-success">
			<input type="hidden" name="childId" value="{$baby.id}">
                            <div class="row">
                                <div class="col-xs-4">
                                    <label style="padding-top: 4px;">宝贝姓名：</label>
                                </div>
                                <div class="col-xs-8" id="selectBaby">
                                   {$baby.baby_name}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-4">
                                    <label style="padding-top: 4px;">宝贝性别：</label>
                                </div>
                                <div class="col-xs-8">
                                    <label>
                                        <?php echo $baby['baby_sex']=='MALE###'?'小王子':'小公主';?>  
                                    </label>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-4">
                                    <label style="padding-top: 4px;">宝宝生日：</label>
                                </div>
                                <div class="col-xs-8">
                                    {$baby.baby_birthday}
                                </div>
                            </div>
                            <div class="row" style="margin-bottom: 90px;"></div>

                        </div>
                    </div>
                </div>
            </div>



            <br />
        </div>

        <div class="col-xs-12 col-sm-6 widget-container-span ui-sortable" >
            <div class="widget-box">
                <div class="widget-header">
                    <h5>退课课程信息</h5>

                </div>

                <div class="widget-body">
                    <div class="widget-main">
                        <div class="alert alert-success">
			<input type="hidden" name="order_id" value="{$order.order_id}">
                            <div class="row">
                                <div class="col-xs-4">
                                    <label style="padding-top: 4px;">学校名称：</label>
                                </div>
                                <div class="col-xs-8">
                                    {$order.school_name}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-4">
                                    <label style="padding-top: 4px;">课程名称：</label>
                                </div>
                                <div class="col-xs-8">
                                    {$order.course_name}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-4">
                                    <label style="padding-top: 4px;">退课课时：</label>
                                </div>
                                <div class="col-xs-8">
                                    {$course_left}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-4">
                                    <label style="padding-top: 4px;">退课费用(元)：</label>
                                </div>
                                <div class="col-xs-8">
				    <input type="text" name="course_amount"  class="width-100" value="<?php echo round($course_amount/100,2)?>"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <br />
        </div>


        <div class="clearfix form-actions">
            <div class="col-xs-12 center">
                <button type="submit" target-form="form-horizontal" class="btn btn-success ajax-post no-refresh" id="sub-btn">
                    <i class="icon-ok bigger-110"></i> 退课
                </button>   <a onclick="history.go(-1)" class="btn btn-info" href="javascript:;">
               <i class="icon-reply"></i>返回上一页
            </a>  </div>
        </div>
    </div>
    </form>
</div>
</block>
<block name="script">
<link href="__STATIC__/datetimepicker/css/datetimepicker_blue.css" rel="stylesheet" type="text/css">
<link href="__STATIC__/datetimepicker/css/dropdown.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="__STATIC__/datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript" src="__STATIC__/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js" charset="UTF-8"></script>
<script type="text/javascript">

$(function(){
    $('.date').datetimepicker({
        format: 'yyyy-mm-dd',
        language:"zh-CN",
        minView:2,
        autoclose:true
    });
    $('.time').datetimepicker({
        format: 'yyyy-mm-dd hh:ii',
        language:"zh-CN",
        minView:2,
        autoclose:true
    });

    highlight_subnav('{:U('Addcourse/edit')}');

});
</script>
</block>

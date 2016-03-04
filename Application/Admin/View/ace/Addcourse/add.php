<extend name="Public/base" />

<block name="body">
<script type="text/javascript" src="__STATIC__/uploadify/jquery.uploadify.min.js"></script>
<div class="page-header">
</div>
<!-- 标签页导航 -->
<div class="tabbable">

    <!-- 表单 -->
    <form id="form" action="{:U('add?model='.$model['id'])}" method="post" class="form-horizontal">
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
                            <div class="row">
                                <div class="col-xs-4">
                                    <label style="padding-top: 4px;">联系号码：</label>
                                </div>
                                <div class="col-xs-8">
                                    <input type="text" id="mobile_num"  name="mobile_num" value="" class="width-100" />
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-4">
                                    <label style="padding-top: 4px;">用户姓名：</label>
                                </div>
                                <div class="col-xs-8">
                                    <input type="text" name="user_name" id="user_name" value="" class="width-100" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-4">
                                    <label style="padding-top: 4px;">所在城市：</label>
                                </div>
                                <div class="col-xs-8">
                                    <input type="text" name="city" id="city" value="" class="width-100" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-4">
                                    <label style="padding-top: 4px;">所在地区：</label>
                                </div>
                                <div class="col-xs-8">
                                    <input type="text" name="district" id="district" value="" class="width-100" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-4">
                                    <label style="padding-top: 4px;">QQ：</label>
                                </div>
                                <div class="col-xs-8">
                                    <input type="text" name="qq" value="" id="qq" class="width-100" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-4">
                                    <label style="padding-top: 4px;">Email：</label>
                                </div>
                                <div class="col-xs-8">
                                    <input type="text" name="email" id="email" value="" class="width-100" />
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


                            <div class="row">
                                <div class="col-xs-4">
                                    <label style="padding-top: 4px;">宝贝姓名：</label>
                                </div>
                                <div class="col-xs-8" id="selectBaby">

                                   <input type="text" name="baby_name" value="" class="width-100" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-4">
                                    <label style="padding-top: 4px;">宝贝性别：</label>
                                </div>
                                <div class="col-xs-8">
                                    <label>
                                        <input type="radio" checked="checked" name="baby_sex" value="MALE###" class="ace">
                                        <span class="lbl">&nbsp;&nbsp;&nbsp;&nbsp;小王子&nbsp;</span>
                                    </label>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <label>
                                        <input type="radio" name="baby_sex" value="FEMALE#" class="ace">
                                        <span class="lbl">&nbsp;&nbsp;&nbsp;&nbsp;小公主&nbsp;</span>
                                    </label>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-4">
                                    <label style="padding-top: 4px;">宝宝生日：</label>
                                </div>
                                <div class="col-xs-8">
                                    <input class="width-100 time" id="baby_birthday" type="text" placeholder="请选择时间" value="" name="baby_birthday">

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
                    <h5>课程信息</h5>

                </div>

                <div class="widget-body">
                    <div class="widget-main">
                        <div class="alert alert-success">


                            <div class="row">
                                <div class="col-xs-4">
                                    <label style="padding-top: 4px;">学校名称：</label>
                                </div>
                                <div class="col-xs-8">
                                    <input type="text" name="school_name" id="school_name" value="" class="width-100" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-4">
                                    <label style="padding-top: 4px;">课程名称：</label>
                                </div>
                                <div class="col-xs-8">
                                    <input type="text" name="course_name" id="course_name" value="" class="width-100" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-4">
                                    <label style="padding-top: 4px;">课程课时：</label>
                                </div>
                                <div class="col-xs-8">
                                    <input type="text" name="course_total" id="course_total" value="" class="width-100" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-4">
                                    <label style="padding-top: 4px;">课程单价：</label>
                                </div>
                                <div class="col-xs-8">
                                    <input type="text" name="course_price" value="" id="course_price" class="width-100" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-4">
                                    <label style="padding-top: 4px;">购买课时：</label>
                                </div>
                                <div class="col-xs-8">
                                    <input type="text" name="course_count" value="" id="course_count" class="width-100" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-4">
                                    <label style="padding-top: 4px;">赠送课时：</label>
                                </div>
                                <div class="col-xs-8">
                                    <input type="text" name="given_count" value="" id="given_count" class="width-100" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-4">
                                    <label style="padding-top: 4px;">买课费用(元)：</label>
                                </div>
                                <div class="col-xs-8">
                                    <input type="text" name="course_amount" value="" id="course_amount" class="width-100" readonly/>
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
                    <i class="icon-ok bigger-110"></i> 确认保存
                </button> <button type="reset" class="btn" id="reset-btn">
                    <i class="icon-undo bigger-110"></i> 重置
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
$('#course_price').change(function (){
	var price = parseInt($('#course_price').val()); 
	var given_count = parseInt($('#given_count').val()); 
	var course_count = parseInt($('#course_count').val()); 
	price = isNaN(price)?0:price;
	given_count = isNaN(given_count)?0:given_count;
	course_count= isNaN(course_count)?0:course_count;
	$('#course_amount').val(price*(course_count+given_count));
	});
$('#course_count').change(function (){
	var price = parseInt($('#course_price').val()); 
	var given_count = parseInt($('#given_count').val()); 
	var course_count = parseInt($('#course_count').val()); 
	price = isNaN(price)?0:price;
	given_count = isNaN(given_count)?0:given_count;
	course_count= isNaN(course_count)?0:course_count;
	$('#course_amount').val(price*(course_count+given_count));
	});
$('#given_count').change(function (){
	var price = parseInt($('#course_price').val()); 
	var given_count = parseInt($('#given_count').val()); 
	var course_count = parseInt($('#course_count').val()); 
	price = isNaN(price)?0:price;
	given_count = isNaN(given_count)?0:given_count;
	course_count= isNaN(course_count)?0:course_count;
	$('#course_amount').val(price*(course_count+given_count));
	});

$('#reset-btn').click(function (){
                       $("#selectBaby").html('<input type="text" name="baby_name" value="" class="width-100" />');
                       $("input[type='text']").val('');
})
    highlight_subnav('{:U('Addcourse/add')}');

    $('#mobile_num').blur(function(event){
            var data=$("#mobile_num").val();
            $.post('<?=U('addcourse/query')?>',{data:data},function (data2) {
		    if(data2.userInfo)
		    {
		    $("#user_name").val(data2.userInfo.user_name);
		    $("#mobile_num").val(data2.userInfo.mobile_num);
		    $("#city").val(data2.userInfo.city);
		    $("#district").val(data2.userInfo.district);
		    $("#qq").val(data2.userInfo.qq);
		    $("#email").val(data2.userInfo.email);
                   }else{
		       $("#user_name").val('');
		       $("#city").val('');
		       $("#district").val('');
		       $("#qq").val('');
		       $("#email").val('');
		       $("#baby input[type='text']").val('');
                       $("#selectBaby").html('<input type="text" name="baby_name" value="" class="width-100" />');
		    }
                   if(data2.childInfo &&data2.childInfo.length>0){

                       var _html= '<select name="childId" id="childId"><option value="">--请选择--</option>';
                       var childInfo = [];
                       $.each(data2.childInfo,function(key,child){
                            childInfo[child.id] = child;
                           _html+='<option value="'+child.id+'">'+child.baby_name+'</option>';
                       })

                       _html+='</select>&nbsp;&nbsp;<span title="" data-placement="bottom" data-rel="tooltip" class="btn btn-info btn-xs tooltip-info" data-original-title="Bottm Info" id="addChild">+</span>';



                       //console.info(childInfo);
                       $("#selectBaby").html(_html);
                       $('#addChild').click(function (){
                           var _html='<input type="text" name="baby_name" value="" class="width-100" />';
                           $("#selectBaby").html(_html);
                       });
                       $('#childId').change(function(){
                           var obj = childInfo[this.value];
                           $("#baby_birthday").val(obj.baby_birthday);
                           $("input:radio[name='baby_sex']").each(function(){
                              // console.info(this.value);
                              // console.info(obj.baby_sex);
                             //  console.info(this.value == obj.baby_sex);
                               if(this.value == obj.baby_sex){
                                   $(this).prop('checked',true);
                               }
                           })
//                           if(data2.childInfo[this.value].baby_sex=="MALE###"){
//                               $("input:radio[name='baby_sex'][data-par='MALE###']").attr("checked",true);
//                               $("input:radio[name='baby_sex'][data-par='FEMALE#']").attr("checked",false);
//
//
//                           }
                          // console.info(obj);
                       });
		   }
		       else{

		       $("#baby input[type='text']").val('');
                       $("#selectBaby").html('<input type="text" name="baby_name" value="" class="width-100" />');
		   }

                },
                'json');
    });



});
</script>
</block>

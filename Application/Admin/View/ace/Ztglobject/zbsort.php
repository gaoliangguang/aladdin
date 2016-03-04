<extend name="Public/base" />
<block name="style">
    <style>
        .rule-wrap .form-item{ width: 33.3333%; float: left; text-align: center;}
        .rule-wrap .btnjt{ padding-top: 110px; line-height:40px; }
        .rule-wrap select{ width: 100%; height: 250px;}
    </style>
</block>
<block name="body">
    <div class="hide" id="select-wrap">
        <div style="padding: 20px;">
            <select multiple="multiple" style="width: 300px;">
                <?php
                foreach($plist as $val):
                ?>
                    <option <?php if(array_key_exists($val['object_id'],$selected)) echo 'disabled'?> value="<?=$val['object_id']?>"><?=$val['object_no']?>/<?=$val['object_name']?></option>
                <?php
                endforeach;
                ?>
            </select>
        </div>
    </div>
    <h3 class="header smaller lighter green">
        <button class="btn btn-white" id="add-new">添加</button>
        <button class="btn btn-white" id="del-selected">删除所选</button>
    </h3>
    <?php
    echo ace_form_open('ztglobject/zbsort');
    ?>
    <div class="form-group rule-wrap">
        <div class="col-sm-12">

            <div class="controls sort">
                <form action="{:U('zbsort')}" method="post">
                    <div class="sort_center">
                        <div class="sort_option">
                            <select name="selected[]" multiple="multiple" id="select-right" class="width-100" style="height: 280px;">
                                <foreach name="selected" item="vo" >
                                    <option class="ids" title="<?=$vo['object_no']?>/{$vo.object_name}" value="{$vo.object_id}"><?=$vo['object_no']?>/{$vo.object_name}</option>
                                </foreach>
                            </select>
                        </div>
                    </div>
                    <div class="hr hr16 hr-dotted"></div>
                    <div class="sort_btn">
                        <button class="top btn btn-white" type="button"> <i class="icon-double-angle-left"> </i>第 一</button>
                        <button class="up btn btn-white" type="button"> <i class="icon-angle-left"></i> 上 移</button>
                        <button class="down btn btn-white" type="button">下 移 <i class="icon-angle-right"></i></button>
                        <button class="bottom btn btn-white" type="button">最 后 <i class="icon-double-angle-right"></i></button>
                    </div>
                </form>
            </div>
        </div>
        <div style="clear: both;"></div>
    </div>
    <?php
    echo ace_srbtn();
    echo ace_form_close()
    ?>
</block>

<block name="style">
    <link rel="stylesheet" href="__ACE__/css/chosen.css" />
</block>
<block name="script">

    <script src="__ACE__/js/chosen.jquery.min.js"></script>
	<script type="text/javascript">

    $('#sub-btn').click(function(){
        $("#select-right option").prop('selected',true);
    });

    $(function(){
        $("#add-new").click(function(){
            //页面层
            layer.open({
                type: 1,
                title:'请选择项目',
                content: $("#select-wrap").html(),
                btn: ['确认','取消'],
                yes: function(index,obj){
                    var op_html = '';
                    obj.find('option:selected').each(function(){
                        var option = $(this);
                        op_html += '<option value="'+option.val()+'">'+option.text()+'</option>'
                        $("#select-wrap select option[value="+option.val()+"]").prop('disabled',true);
                    });
                    $("#select-right").append(op_html);
                    rest();
                    sort();
                    layer.close(index);
                },
                cancel: function(index){
                    //按钮【按钮二】的回调
                },
                success: function () {
                    $(".layui-layer-content").css({'overflow':'visible'})
                        .find('select').chosen();
                }
            });
        })

        $("#del-selected").click(function () {

            $("#select-right option:selected").each(function(){
                $("#select-wrap select option[value="+this.value+"]").prop('disabled',false);
            }).remove();
        })
        sort();
        $(".top").click(function(){
            rest();
            $("option:selected").prependTo($("#select-right"));
            sort();
        })
        $(".bottom").click(function(){
            rest();
            $("option:selected").appendTo($("#select-right"));
            sort();
        })
        $(".up").click(function(){
            rest();
            $("option:selected").after($("option:selected").prev());
            sort();
        })
        $(".down").click(function(){
            rest();
            $("option:selected").before($("option:selected").next());
            sort();
        })
        function sort(){
            $('#select-right option').text(function(){return ($(this).index()+1)+'.'+$(this).text()});
        }

        //重置所有option文字。
        function rest(){
            $('#select-right option').text(function(){
                return $(this).text().split('.')[1]
            });
        }
    })
	</script>
</block>
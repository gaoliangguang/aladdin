<extend name="Public/base" />

<block name="body">
    <!-- 表单 -->
    <?php $status=['OK#'=>'已收款','FLS'=>'收款失败','CRT'=>'待收款'];?>
    <form action="{:U('paymentcheck')}" method="POST" class="form-horizontal check_data" id="form_submit" role="form">
        <input type="hidden" name="id"  value="{$item.id}">
        <div class="widget-header widget-header-small header-l-blue">
            <h5 class="bigger lighter">工程收款信息</h5>
        </div>
        <table class="table table-striped table-bordered table-hover item-table">
            <tbody>
            <tr>
                <td><span>工程名称:</span>{$item.object_name}</td>
                <td><span>订单号:</span>{$item.order_id}</td>
            </tr>
            <tr>
                <td><span>总期数:</span>{$item.total_period}</td>
                <td><span>总金额:</span>{$item.total_amount|price_format}</td>
            </tr>
            <tr>
                <td><span>当前期数:</span>{$item.current_period}</td>
                <td><span>当前金额:</span>{$item.amount|price_format}</td>
            </tr>
            <tr>
                <td><span>剩余期数:</span>{$item.left_period}</td>
                <td><span>剩余金额:</span>{$item.left_amount}</td>
            </tr>
            <tr>
                <td><span>应付时间:</span>{$item.should_pay_time}</td>
                <td><span>支付时间:</span>{$item.pay_time}</td>
            </tr>
            <tr>
                <td>
                    <span>凭证号:</span>
                    <a class="ace-thumbnails" href="<?=imageView2($item['voucher_pic'])?>"><?=$item['voucher'];?></a>
                </td>
                <td>
                    <span>状态:</span>
                    <?=$status[$item['status']];?>
                </td>
            </tr>
            </tbody>
            <tfoot>
            <tr>
                <td colspan="2">
                    <div class="control-group center">
                        <label>
                            <input class="ace" type="radio" value="Y" name="check_status">
                            <span class="lbl"> 审核通过</span>
                        </label>
                        <label>
                            <input class="ace" type="radio" value="N" name="check_status">
                            <span class="lbl"> 审核不通过</span>
                        </label>
                        <input type="text" name="check_remark" placeholder="输入审核未通过原因">
                    </div>
                </td>
            </tr>
            </tfoot>
        </table>
        <?=ace_srbtn('确认审核','before="sb_before"')?>
    </form>
</block>
<block name="script">
    <include file="Public/colorbox"/>
    <script type="text/javascript" charset="utf-8">
        function sb_before(){
            var ret = true;
            $("input[type=radio][value=Y]").each(function (i,e){
                if(!e.checked && $('input[name=check_remark]').val()=='') {
                    ret =false;
                    layer.alert('请先填写不通过原因!',{icon:2});
                    return false;
                }
            });
            return ret;
        }
        //导航高亮
        highlight_subnav('{:U('object/payment')}');
    </script>
</block>
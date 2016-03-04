<extend name="Public/base" />

<block name="body">
	<!-- 表单 -->

<style>
td{width:50%;}
img{max-width:400px;}
</style>
<input type="hidden" name="id"  value="{$item.id}">
<div class="widget-box" style="opacity: 1; z-index: 0;margin-bottom:1em;">
<div class="widget-header" style="color:#999;">
          <h5 class="bigger lighter">充值信息</h5>        
</div>
<div class="widget-body">
<div class=""> 
       <table class="table  table-bordered " style="margin-bottom:0px;">
	<tbody>
		<tr>
			<td><span style="color:#999;padding-right:8px;">用户名:</span>{$item.nick_name}</td>
			<td><span style="color:#999;padding-right:8px;">充值时间:</span>{$item.transport_time}</td>
		</tr>
		<tr>
			<td><span style="color:#999;padding-right:8px;">充值金额:</span>{$item.amount|price_format}</td>
			<td><span style="color:#999;padding-right:8px;">申请时间:</span>{$item.insert_time}</td>
		</tr>
		<tr>
			<td><span style="color:#999;padding-right:8px;">银行账号:</span>{$item.account_no}</td>
			<td><span style="color:#999;padding-right:8px;">开户银行:</span>{$item.bank}</td>
		</tr>
		<tr>
			<td><span style="color:#999;padding-right:8px;">凭证号:</span>{$item.voucher}</td>
			<td><span style="color:#999;padding-right:8px;">凭证扫描件:</span><img src="{$item.voucher_pic|imageView2}" /></td>
		</tr>
	 </tbody>
	</table>
</div>
</div>
</div>
<form action="{:U('rechargecheck')}" method="POST" class="form-horizontal" id="form_submit" role="form">
<input type="hidden" value="{$item.voucher}" name="voucher">
<input type="hidden" value="{$item.order_id}" name="order_id">
            <div class="col-xs-12 center" style="margin-top:1em;">
	    <input type="radio" name="status" value="OK#"> 通过&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	    <input type="radio" name="status" value="FLS"> 拒绝
	    </div>
            <div class="col-xs-12 center" style="margin-top:1em;">
	    <textarea  name="remark" placeholder="请填写审核备注" style="width:250px;height:150px;"></textarea>
	    </div>
		<div class="clearfix form-actions">
            <div class="col-xs-12 center" style="margin-top:1em;">
<button id="sub-btn" class="btn btn-success ajax-post no-refresh" target-form="form-horizontal" type="submit">
                              <i class="icon-ok bigger-110"></i> 审核
                          </button>
            </div>
        </div>
</form>
</block>

<block name="script">
<script type="text/javascript" charset="utf-8">
	Think.setValue('type',{$type|default=1});
</script>
</block>

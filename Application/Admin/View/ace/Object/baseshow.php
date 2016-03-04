<extend name="Public/base" />

<block name="body">
	<!-- 表单 -->

<style>
td{width:50%;}
img{max-width:400px;}
</style>
<div class="widget-box" style="opacity: 1; z-index: 0;margin-bottom:1em;">
<div class="widget-header" style="color:#999;">
          <h5 class="bigger lighter">基本信息</h5>        
</div>
<div class="widget-body">
<div class=""> 
       <table class="table  table-bordered " style="margin-bottom:0px;">
	<tbody>
		<tr>
			<td><span style="color:#999;padding-right:8px;">公司名称:</span>{$item.company_name}</td>
			<td><span style="color:#999;padding-right:8px;">公司简称:</span>{$item.short_name}</td>
		</tr>
		<tr>
			<td colspan="1"><span style="color:#999;padding-right:8px;">企业成立时间:</span>{$item.reg_time}</td>
			<td><span style="color:#999;padding-right:8px;">企业营业期限:</span>{$item.business_license_expire_time}</td>
		</tr>
		<tr>
			<td><span style="color:#999;padding-right:8px;">联系方式:</span>{$item.contact_mobile_num}</td>
			<td><span style="color:#999;padding-right:8px;">EMail:</span>{$item.email}</td>
		</tr>
		<tr>
			<td><span style="color:#999;padding-right:8px;">公司简介:</span>{$item.description}</td>
			<td><span style="color:#999;padding-right:8px;">公司LOGO:</span><img src="{$item.logo|imageView2}"/></td>
		</tr>
	 </tbody>
	</table>
</div>
</div>
</div>
		<div class="clearfix form-actions">
            <div class="col-xs-12 center" style="margin-top:1em;">
                <a onclick="history.go(-1)" class="btn btn-info" href="javascript:;">
	               <i class="icon-reply"></i>返回上一页
	            </a>  
            </div>
        </div>
</block>

<block name="script">
<script type="text/javascript" charset="utf-8">
	Think.setValue('type',{$type|default=1});
</script>
</block>

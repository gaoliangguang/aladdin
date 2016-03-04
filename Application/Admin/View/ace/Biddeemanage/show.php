<extend name="Public/base" />

<block name="body">
	<!-- 表单 -->

<style>
td{width:50%;}
img{max-width:400px;}
</style>
<div class="widget-box" style="opacity: 1; z-index: 0;margin-bottom:1em;">
<div class="widget-header" style="color:#999;">
          <h5 class="bigger lighter">招标人基本信息</h5>        
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
			<td><span style="color:#999;padding-right:8px;">公司LOGO:</span><a href="{$item.logo|imageView2}" class="ace-thumbnails" ><img src="{$item.logo|imageView2}"/></a></td>
		</tr>
	 </tbody>
	</table>
</div>
</div>
</div>
<div class="widget-box" style="opacity: 1; z-index: 0;margin-bottom:1em;">
<div class="widget-header" style="color:#999;">
          <h5 class="bigger lighter">企业法人信息</h5>        
</div>
<div class="widget-body">
<div class=""> 
       <table class="table  table-bordered " style="margin-bottom:0px;">
	<tbody>
		<tr>
			<td><span style="color:#999;padding-right:8px;">法人代表:</span>{$item.legal_person}</td>
			<td><span style="color:#999;padding-right:8px;">身份证号:</span>{$item.legal_person_idcard}</td>
		</tr>
		<tr>
			<td colspan="2"><span style="color:#999;padding-right:8px;">身份证扫描件:</span><a href="{$item.legal_person_idcard_front_url|imageView2}" class="ace-thumbnails" ><img src="{$item.legal_person_idcard_front_url|imageView2}"/></a><a href="{$item.legal_person_idcard_back_url|imageView2}" class="ace-thumbnails" ><img src="{$item.legal_person_idcard_back_url|imageView2}"/></a></td>
		</tr>
		<tr>
			<td colspan="2"><span style="color:#999;padding-right:8px;">法人授权书:</span><a href="{$item.legal_person_idcard_back_url|imageView2}" class="ace-thumbnails" ><img src="{$item.legal_person_idcard_back_url|imageView2}"/></a></td>
		</tr>
	 </tbody>
	</table>
</div>
</div>
</div>
<div class="widget-box" style="opacity: 1; z-index: 0;margin-bottom:1em;">
<div class="widget-header" style="color:#999;">
          <h5 class="bigger lighter">企业注册信息</h5>        
</div>
<div class="widget-body">
<div class=""> 
       <table class="table  table-bordered " style="margin-bottom:0px;">
	<tbody>
		<tr>
			<td  ><span style="color:#999;padding-right:8px;">营业执照类型:</span><?php echo $item['business_license_type']=='NEW'?'三证合一':'非三证合一';?></td>
<?php if($item['business_license_type']=='NEW'){ ?>
		<td ><span style="color:#999;padding-right:8px;">统一社会信用代码:</span>{$item.unified_social_credit_code}</td>
		</tr>
		<tr>
			<td colspan="2"><span style="color:#999;padding-right:8px;">营业执照扫描件:</span><a href="{$item.unified_social_credit_code_url|imageView2}" class="ace-thumbnails" ><img src="{$item.unified_social_credit_code_url|imageView2}"/></a></td>
		</tr>
<?php }else{?>
	<tr>
		<td><span style="color:#999;padding-right:8px;">营业执照:</span><?php echo $item['business_license'];?></td>
			<td ><span style="color:#999;padding-right:8px;">营业执照扫描件:</span><a href="<?=imageView2($item['business_license_url'])?>" class="ace-thumbnails" ><img src="<?php echo imageView2($item['business_license_url'])?>"/></a></td>
		</tr>
	<tr>
		<td><span style="color:#999;padding-right:8px;">税务登记证编号:</span><?php echo $item['tax_registration_certificate'];?></td>
			<td ><span style="color:#999;padding-right:8px;">税务登记证扫描件:</span><a href="<?=imageView2($item['tax_registration_certificate_url'])?>" class="ace-thumbnails" ><img src="<?php echo imageView2($item['tax_registration_certificate_url'])?>"/></a></td>
		</tr>
	<tr>
		<td><span style="color:#999;padding-right:8px;">组织机构代码证编号:</span><?php echo $item['org_code_certificate'];?></td>
			<td ><span style="color:#999;padding-right:8px;">组织机构代码证扫描件:</span><a href="<?=imageView2($item['org_code_certificate_url'])?>" class="ace-thumbnails" ><img src="<?php echo imageView2($item['org_code_certificate_url'])?>"/></a></td>
		</tr>
<?php }?>
	<tr>
		<td><span style="color:#999;padding-right:8px;">营业期限:</span><?php echo $item['business_license_expire_time'];?></td>
		<td ><span style="color:#999;padding-right:8px;">注册时间:</span><?php echo $item['reg_time']?></td>
		</tr>
	<tr>
		<td colspan="2"><span style="color:#999;padding-right:8px;">经营范围:</span><?php echo $item['business_scope'];?></td>
		</tr>
	<tr>
		<td colspan="2"><span style="color:#999;padding-right:8px;">注册地址:</span><?php echo $item['address'];?></td>
		</tr>
	 </tbody>
	</table>
</div>
</div>
</div>
<div class="widget-box" style="opacity: 1; z-index: 0;margin-bottom:1em;">
<div class="widget-header" style="color:#999;">
          <h5 class="bigger lighter">企业银行信息</h5>        
</div>
<div class="widget-body">
<div class=""> 
       <table class="table  table-bordered " style="margin-bottom:0px;">
	<tbody>
		<tr>
			<td><span style="color:#999;padding-right:8px;">开户行:</span>{$item.bank_name}</td>
			<td><span style="color:#999;padding-right:8px;">银行账号:</span>{$item.account_no}</td>
		</tr>
		<tr>
			<td colspan="2"><span style="color:#999;padding-right:8px;">开户名:</span>{$item.account_name}</td>
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
<include file="Public/colorbox"/>
<script type="text/javascript" charset="utf-8">
	Think.setValue('type',{$type|default=1});
</script>
</block>

<extend name="Public/base" />

<block name="body">
    <form action="{:U('cancel')}" method="POST" class="form-horizontal" id="form_submit" role="form">
        <input type="hidden" name="purchase_no" value="<?=$purchase_no;?>" >
        <div class="widget-header widget-header-small header-l-blue">
            <h5 class="smaller">撤销
            </h5>
        </div>
        <table class="table table-striped table-bordered table-hover item-table">
            <tbody>
                <tr>
                    <td colspan="2">
                        <span class="red">*</span><span class="">撤销原因:</span>
			<textarea name="revokeReason" placeholder="输入审核未通过原因" style="width:290px;height:120px;"></textarea>
                    </td>
                </tr>
            </tbody>
        </table>
<div class="clearfix form-actions">
    <div class="col-xs-12">
	<button id="sub-btn" class="btn btn-sm btn-success no-border ajax-post no-refresh " target-form="form-horizontal" type="submit">
                    <i class="icon-ok bigger-110"></i> 确认撤销
                </button>
        <a onclick="history.go(-1)" class="btn btn-white" href="javascript:;">
            返回
        </a>
    </div>
</div>
</form>
</block>
<block name="script">

<script>
    $(document).ready(function () {

        //导航高亮
        highlight_subnav('<?=U('cgqdgl/cgxmindex')?>');
    })
</script>
</block>

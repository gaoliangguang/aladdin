<extend name="Public/base" />
<block name="body">

    <div id="auth_groups">
        <form class="form-horizontal" action="{:U('addToGroup')}" method="post" enctype="application/x-www-form-urlencoded" >
			<div class="form-group">
			     <label class="col-xs-12 col-sm-12 no-padding-right">{$nickname} 所属的用户组列表</label>
            </div>
            <volist name="auth_groups" id="vo">
                <label>
                    <input type="checkbox" value="{$vo.id}" name="group_id[]" class="ace ids auth_groups">
                    <span class="lbl"></span> {$vo.title} 
                </label>
            </volist>
            <input type="hidden" name="uid" value="{:I('uid')}">
            <input type="hidden" name="batch" value="true">

            <?=ace_srbtn()?>
        </form>
    </div>
</block>
<block name="script">
<script type="text/javascript">
    $(function(){
        var group = [{$user_groups}];
        $('.auth_groups').each(function(){
            if( $.inArray( parseInt(this.value,10),group )>-1 ){
                $(this).prop('checked',true);
            }
        });
    });
    // 导航高亮
    highlight_subnav('{:U('User/index')}');
</script>
</block>
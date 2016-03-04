<extend name="Public/base" />
<!-- 管理员用户组新增和编辑页面 -->
<block name="body">
    <form action="{:U('AuthManager/writeGroup')}" enctype="application/x-www-form-urlencoded" method="POST"
            class="form-horizontal">
        <div class="form-group">
            <label for="auth-title" class="col-xs-12 col-sm-2 control-label no-padding-right">用户组</label>
            <div class="col-xs-12 col-sm-5">
                <input id="auth-title" type="text" name="title" class="width-100" value="{$auth_group.title}"/>
            </div>
        </div>
        <div class="form-group">
            <label for="auth-description" class="col-xs-12 col-sm-2 control-label no-padding-right">描述</label>
            <div class="col-xs-12 col-sm-5">
                <textarea id="auth-description" name="description" class="autosize-transition span12 form-control">{$auth_group.description}</textarea>
            </div>
        </div>
        <input type="hidden" name="id" value="{$auth_group.id}" />
        <?=ace_srbtn()?>
    </form>
</block>
<block name="script">
<script type="text/javascript" charset="utf-8">
    //导航高亮
    highlight_subnav('{:U('AuthManager/index')}');
</script>
</block>
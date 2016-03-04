<extend name="Public/base"/>
<block name="body">
    <div class="alert alert-block alert-success">
        <button data-dismiss="alert" class="close" type="button">
            <i class="icon-remove"></i>
        </button>

        <i class="icon-ok green"></i>欢迎使用
        <strong class="green">{:C('WEB_SITE_TITLE')}
            <small>(v1.0)</small>
        </strong>
        
    </div>
    <!-- 插件块 -->
	{:hook('AdminIndex')}
</block>

<block name="script">
<script type="text/javascript">
    /* 插件块关闭操作 */
    $(".title-opt .wm-slide").each(function(){
        $(this).click(function(){
            $(this).closest(".columns-mod").find(".bd").toggle();
            $(this).find("i").toggleClass("mod-up");
        });
    })
    $(function(){
        // $('#main').attr({'id': 'indexMain','class': 'index-main'});
        $('.copyright').html('<div class="copyright"> ©2013-2015 中经汇通有限责任公司版权所有</div>');
    })
</script>
</block>
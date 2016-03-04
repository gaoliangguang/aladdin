<!-- 分类授权编辑页面 -->
<extend name="Public/base" />
<block name="body">
    <style>
    .category {
    	margin: 10px 0;
    	border-bottom-width: 0;
    	background-color: #fff;
    }
    .category .hd {
    	font-weight: bold;
    	border-bottom: 1px solid #d4d4d4;
    	color:#fff;
    	background-color: #353535;
    }
    .category .cate-item dt {
    	border-bottom: 1px solid #E7E7E7;
    }
    .category dl,
    .category dd,
    .category input {
    	margin: 0;
    }
    .category .check,
    .category .fold,
    .category .order,
    .category .name {
    	float: left;
    	height: 35px;
    	line-height: 35px;
    }
    .category .opt {
    	float: right;
    	width: 120px;
    	height: 35px;
    	line-height: 35px;
    	text-align: center;
    }
    .opt-btn {
    	float: right;
    	margin: 5px 10px 0 0;
    }
    .category .check {
    	width: 40px;
    	text-align: center;
    }
    .category .fold {
    	width: 50px;
    	text-align: center;
    }
    .category .fold i {
    	display: inline-block;
    	vertical-align: middle;
    	width: 17px;
    	height: 17px;
    	background-repeat: no-repeat;
    }
    .category .fold .icon-fold,
    .category .fold .icon-unfold {
    	cursor: pointer;
    	background: url(__PUBLIC__/Admin/images/bg_icon.png) no-repeat;
    }
    .category .fold .icon-fold {
    	background-position: -100px -25px;
    }
    .category .fold .icon-unfold {
    	background-position: -125px -25px;
    }
    .category .order,
    .category .order input {
    	text-align: center;
    }
    .category .order {
    	width: 90px;
    }
    .category .order input {
    	margin-bottom: 2px;
    	width: 40px;
    }
    .category .name input {
    	margin-bottom: 2px;
    }
    .category .add-sub-cate {
    	margin-left: 10px;
    }
    .category .add-sub-cate:hover {
    	text-decoration: none;
    	border-bottom: 0 none;
    }
    .category .btn-mod {
    	margin-left: 15px;
    }
    .category .root {
    	font-weight: bold;
    }
    .category .tab-sign {
    	display: inline-block;
    	margin-left: 15px;
    	height: 21px;
    	vertical-align: middle;
    	background-image: url(__PUBLIC__/Admin/images/tab_sign.png);
    	background-repeat: no-repeat;
    }
    .category .name .msg {
    	vertical-align: top;
    	font-weight: normal;
    }
    .category .name .error {
    	color: #B94A48;
    }
    .category .name .success {
    	color: #468847;
    }
    /* 顶级分类 */
    .category > dl > dt .tab-sign {
    	display: none;
    }
    
    /* 二级分类 */
    .category > dl > dd > dl > dt .tab-sign {
    	width: 55px;
    	background-position: 0 0;
    }
    .category > dl > dd > dl:last-child > dt .tab-sign {
    	background-position: -55px 0;
    }
    
    /* 三级分类 */
    .category > dl > dd > dl > dd > dl > dt  .tab-sign {
    	width: 110px;
    	background-position: 0 -30px;
    }
    .category > dl > dd > dl > dd > dl:last-child > dt .tab-sign {
    	background-position: 0 -60px;
    }
    
    .category > dl > dd > dl:last-child > dd > dl > dt .tab-sign {
    	background-position: 0 -90px;
    }
    .category > dl > dd > dl:last-child > dd > dl:last-child > dt .tab-sign {
    	background-position: 0 -120px;
    }
    .category > dl > dd > dl:last-child > dd > dl:last-child > dt .add-sub-cate{
    }
    .icon-add {
    	display: inline-block !important;
    	width: 16px;
    	height: 16px;
    	vertical-align: middle;
    	background: url(__PUBLIC__/Admin/images/bg_icon.png) no-repeat 0 0;
    }
    .add-on {
    	width: 20px;
    	height: 20px;
    	display: inline-block;
    	position: relative;
    	top: 7px;
    	right: 25px;
    }
    .sort_bottom {
    	margin-top: 105px;
    }
    .sort_option select {
    	height: 250px;
    	width: 220px;
    }
    .sort_top {
    	margin-bottom: 10px;
    }
    .sort_top input {
    	line-height: 26px;
    	margin-right: 30px;
    	border: 1px solid #ccc;
    	padding-left:5px;
    }
    .sort_btn button{
    	display: block;
    	margin-bottom: 15px;
    }
    .sort_option {
    	float: left;
    	margin-right: 16px;
    }
    .sort_confirm {
    	float: left;
    }
    .update-version {
    	font-size: 18px;
        line-height: 3;
        text-align: center;
        width: 85%;
    }
    .update-version .error {
        color: #B94A48;
    }
    .update-version .success {
        color: #468847;
    }
    .category .hd {
    	border-bottom-color: #d4d4d4;
    	color:#fff;
    	background-color: #307ecc;
    }
    .category .cate-item dt {
    	border-bottom-color: #E7E7E7;
    }
    .category .name .error {
    	color: #B94A48;
    }
    .category .name .success {
    	color: #468847;
    }
    
    .close {
        color: #000000;
        text-shadow: 0 1px 0 #ffffff;
        opacity: 0.2;
        filter: alpha(opacity=20);
    }
        
    </style>
<div class="tabbable">
    <ul class="nav nav-tabs padding-18">
        <li><a href="{:U('AuthManager/access',array('group_name'=>I('group_name') ,'group_id'=> I('group_id')))}">访问授权</a></li>
        <li class="active"><a href="javascript:;">分类授权</a></li>
        <li><a href="{:U('AuthManager/user',array('group_name'=>I('group_name') ,'group_id'=> I('group_id')))}">成员授权</a></li>
        <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">分组 &nbsp;
                <i class="icon-caret-down bigger-110 width-auto"></i>
            </a>
            <ul class="dropdown-menu dropdown-info">
                <volist name="auth_group" id="vo">
	                <li <eq name="vo['id']" value="$this_group['id']">class="active"</eq>>
	                    <a data-toggle="tab" href="{:U('AuthManager/access',array('group_id'=>$vo['id'],'group_name'=>$vo['title']))}">{$vo.title}</a>
	                </li>
                </volist>
            </ul>
        </li>
    </ul>
    <div class="tab-content no-border padding-24">
		<!-- 访问授权 -->
        <div class="tab-pane active">
            <form class="save-category" action="{:U('AuthManager/addToCategory')}" method="post" enctype="application/x-www-form-urlencoded">
                <input type="hidden" name="group_id" value="{:I('group_id')}">
                <div class="category auth-category">
                    <div class="hd cf">
                        <div class="fold">折叠</div>
                        <div class="order">选择</div>
                        <div class="name">栏目名称</div>
				        <div style="clear: both;"></div>
                    </div>
                    {:R('AuthManager/tree', array($group_list))}
                </div>

                <?=ace_srbtn()?>
            </form>
		</div>
	</div>
</div>
        
<!-- /表格列表 -->
</block>
<block name="script">
<script type="text/javascript">
    +function($){
        /* 分类展开收起 */
        $(".category dd").prev().find(".fold i").addClass("icon-unfold")
            .click(function(){
                var self = $(this);
                if(self.hasClass("icon-unfold")){
                    self.closest("dt").next().slideUp("fast", function(){
                        self.removeClass("icon-unfold").addClass("icon-fold");
                    });
                } else {
                    self.closest("dt").next().slideDown("fast", function(){
                        self.removeClass("icon-fold").addClass("icon-unfold");
                    });
                }
            });

        var auth_groups = [{$authed_group}];
        $('.cate_id').each(function(){
            if( $.inArray( parseInt(this.value,10),auth_groups )>-1 ){
                $(this).prop('checked',true);
            }
        });
	    $('select[name=group]').change(function(){
		    location.href = this.value;
	    });
    }(jQuery);
    //导航高亮
    highlight_subnav('{:U('AuthManager/index')}');
</script>
</block>

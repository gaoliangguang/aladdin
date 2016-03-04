<extend name="Public/base"/>

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
	<!-- 表格列表 -->
	<div class="tb-unit posr">
		<div class="category">
			<div class="hd cf">
				<div class="fold">折叠</div>
				<div class="order">排序</div>
				<div class="order">发布</div>
				<div class="name">名称</div>
				<div style="clear: both;"></div>
			</div>
			<?php echo R('Category/tree', array($tree));?>
			<div style="clear: both;"></div>
		</div>
	</div>

    <div class="tb-unit-bar">
        <a class="btn btn-white" href="{:U('add')}">新 增</a>
    </div>
	<!-- /表格列表 -->
</block>

<block name="script">
	<script type="text/javascript">
		(function($){
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

			/* 三级分类删除新增按钮 */
			$(".category dd dd .add-sub").remove();

			/* 实时更新分类信息 */
			$(".category")
				.on("submit", "form", function(){
					var self = $(this);
					$.post(
						self.attr("action"),
						self.serialize(),
						function(data){
							/* 提示信息 */
							var name = data.status ? "success" : "error", msg;
							msg = self.find(".msg").addClass(name).text(data.info)
									  .css("display", "inline-block");
							setTimeout(function(){
								msg.fadeOut(function(){
									msg.text("").removeClass(name);
								});
							}, 1000);
						},
						"json"
					);
					return false;
				})
                .on("focus","input",function(){
                    $(this).data('param',$(this).closest("form").serialize());

                })
                .on("blur", "input", function(){
                    if($(this).data('param')!=$(this).closest("form").serialize()){
                        $(this).closest("form").submit();
                    }
                });
		})(jQuery);
	</script>
</block>

<extend name="Public/base"/>

<block name="body">
    <!-- 标题栏 -->
    <div class="page-header">
        <h1>
            商品规格
        </h1>
    </div>

	<!-- 商品规格 -->
    <div style='width:45%;height:600px;border:1px solid gray;float:left;'>
    	<div style='margin-top:10px;margin-left:25px;'>
        	<label>
            	<a class="btn btn-white" href="#">
                                               添加规格
                </a>
            </label>
         </div>
         <div sytle='clear:both;'></div>
         <div style='width:415px;height:170px;border:1px solid gray;margin-left:25px;'>
         	<label style='margin-top:20px;margin-left:20px; '>
         		规格名称&nbsp;<input type="text" name='attrName'>
         	</label><br/><br/>
         	<label style='margin-left:35px; '>
         		规格值&nbsp;<input type="text" name='attrValue'>&nbsp;<input type="button" value="添加">
         	</label><br/><br/>
         	<label style='margin-left:80px; '>
            	<a class="btn btn-white" href="#">
                                           确定
                </a>
            </label>
            <label>
            	<a class="btn btn-white" href="#">
                                           取消
                </a>
            </label>
         </div>
    </div>
    <div style='width:50%;height:600px;border:1px solid gray;float:right;'>
    <div style='margin-top:10px;margin-left:400px;'>
        	<label>
            	<a class="btn btn-white" href="#">
                                               调价记录
                </a>
            </label><br/>
            
         </div>
         <label style='margin-left:60px; '>
         		*供货价（元）&nbsp;<input type="text" >
         	</label><br/><br/>
         	<label style='margin-left:72px; '>
         		*标价（元）&nbsp;<input type="text" >&nbsp;参考，计算时以规格表为准
         	</label><br/><br/>
         	<label style='margin-left:60px; '>
         		*折后价（元）&nbsp;<input type="text" >&nbsp;折扣率：
         	</label><br/><br/>
         	<label style='margin-left:70px; '>
         		<input type="checkBox" >&nbsp;所有型号规格统一供货价和标价
         	</label><br/>
         	<hr/>
         	<label style='margin-left:60px; '>
         		*金牌用户积分&nbsp;<input type="text" >&nbsp;拨比：
         	</label><br/><br/>
         	<label style='margin-left:60px; '>
         		*推广渠道积分&nbsp;<input type="text" >&nbsp;拨比：
         	</label><br/><br/>
         	<label style='margin-left:60px; '>
         		*技术服务费 ￥ 0      (金牌用户积分 + 推广渠道积分) * 0.0
         	</label><br/><br/>
         	<label style='margin-left:70px; '>
         		<input type="checkBox" >&nbsp;使用系统默认分佣
         	</label><br/>
    </div>
</block>

<block name="script">
    <script src="__STATIC__/thinkbox/jquery.thinkbox.js"></script>
    <script type="text/javascript">
  	//导航高亮
    highlight_subnav('{:U('Model/index')}');

</script>
</block>

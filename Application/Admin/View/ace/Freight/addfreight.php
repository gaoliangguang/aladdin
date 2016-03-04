<extend name="Public/base"/>

<block name="body">
     <div class="table-responsive">
        <div class="dataTables_wrapper">  
            新建运费模板
            <form id="form" action="{:U('addFreight')}" method="post" class="form-horizontal">
			    <div class="tab-content no-border padding-24">
			        <!-- 基础数据 -->
					<div id="tab1" class="tab-pane active tab1">
			                <div class="form-group">
			                    <label class="col-xs-12 col-sm-2 control-label no-padding-right">
			                    	<span style="color: red;">*</span>首重（元，1kg以内）</label>
			                    <div class="col-xs-12 col-sm-6">
			                        <input type="text" class="width-100" name="firstFreight" value="">                    
			                    </div>
			                    <div class="help-block col-xs-12 col-sm-reset inline">
			                    </div>
			                </div>                
			                <div class="form-group">
			                    <label class="col-xs-12 col-sm-2 control-label no-padding-right">
			                    	<span style="color: red;">*</span>续重（元/kg）</label>
			                    <div class="col-xs-12 col-sm-6">
			                        <input type="text" class="width-100" name="secFreight" value="">                    
			                    </div>
			                    <div class="help-block col-xs-12 col-sm-reset inline">
			                    </div>
			                </div>                
			                <div class="form-group">
			                    <label class="col-xs-12 col-sm-2 control-label no-padding-right">
			                    	<span style="color: red;">*</span>模板名称</label>
			                    <div class="col-xs-12 col-sm-6">
			                        <input type="text" class="width-100" name="freightName" value="">                    
			                    </div>
			                    <div class="help-block col-xs-12 col-sm-reset inline">
			                    </div>
			                </div>              
			                <div class="form-group">
			                    <label class="col-xs-12 col-sm-2 control-label no-padding-right">类型</label>
			                    <div class="col-xs-12 col-sm-6">
			                        <select name="freightType" id="value">
			                            <option value="NOT" selected="">包邮</option>
			                            <option value="NOE">包邮（指定地区除外）</option>
			                            <option value="BUY">运费到付</option>
			                            <option value="NAT" id="nat">全国统一价</option>
			                            <option value="NAE" id="nae">全国统一价（指定地区除外）</option>
			                        </select>                    </div>
			                    <div class="help-block col-xs-12 col-sm-reset inline">
			                    </div>
			                </div>
			                <div class="form-group" id="status">
			                    <label class="col-xs-12 col-sm-2 control-label no-padding-right">是否开启满额包邮</label>
			                    <div class="col-xs-12 col-sm-6">
			                       <label>
                                <input type="checkbox" id="check" class="ace ace-switch ace-switch-6 ajax-get" name="fullStatus" value="USE" >
                                <span class="lbl"></span>
                            </label>
                            <label id="free">
	                            <span style="margin-left:0px;">满</span>
	                            <input type="test" style="margin-left:0px;whith:30px;" name="fullSum"><span>元包邮</span>
                            </label>
			                </div>
			                
			                </div>        
			                </div>
			        <div class="clearfix form-actions">
			           <div class="col-xs-12">
			               <button id="sub-btn" class="btn btn-sm btn-success no-border" target-form="form-horizontal" type="submit">
			                                             确认保存
			               </button> 	  
			                 <a href="javascript:;" class="btn btn-white" onclick="history.go(-1)">
			                                              返回
			                 </a>	
			           </div>
			       </div>    
		       </div>
           </form>
        </div>
    </div>
</block>

<block name="script">
    <script type="text/javascript">
        $(function() {
            //导航高亮
            highlight_subnav('{:U('index')}');

        });
    </script>
    <script type="text/javascript">
        $(function() {
            $("#status").hide();
			$("#free").hide();

			$("#value").change(function(){
				
				if($(this).val()=='NAT'||$(this).val()=='NAE'){
					$("#status").show();
					$("#check").attr("checked",false);
					$("#free").hide();
				}else{
						$("#check").attr("checked",false);
						$("#status").hide();
						$("#free").hide();
					}
				});
			$("#check").change(function(){
					$("#free").toggle();
				});
        });
    </script>
</block>
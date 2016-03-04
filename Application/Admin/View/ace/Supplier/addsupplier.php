<extend name="Public/base"/>

<block name="body">
     <div class="table-responsive">
        <div class="dataTables_wrapper">  
            <form id="form" action="/aladdin/root/admin.php?s=/config/addfeerate.html" method="post" class="form-horizontal">
			    <div class="tab-content no-border padding-24">
			        <!-- 基础数据 -->
					<div id="tab1" class="tab-pane active tab1">                
			                <div class="form-group">
			                    <label class="col-xs-12 col-sm-2 control-label no-padding-right"><span style="color: red;">*</span>供应商名称</label>
			                    <div class="col-xs-12 col-sm-6">
			                        <input type="text" class="width-100" name="max_amount" value="">                    </div>
			                    <div class="help-block col-xs-12 col-sm-reset inline">
			                    </div>
			                </div>                
			                <div class="form-group">
			                    <label class="col-xs-12 col-sm-2 control-label no-padding-right">供应商编号</label>
			                    <div class="col-xs-12 col-sm-6">
			                        <input type="text" class="width-100" name="fee_rate" value="">                    </div>
			                    <div class="help-block col-xs-12 col-sm-reset inline">
			                    </div>
			                </div>              
			                <div class="form-group">
			                    <label class="col-xs-12 col-sm-2 control-label no-padding-right"><span style="color: red;">*</span>结算周期（天）</label>
			                    <div class="col-xs-12 col-sm-6">
			                       <input type="text" class="width-100" name="fee_rate" value="">
			                    </div>
			                </div>
			                <div class="form-group">
			                    <label class="col-xs-12 col-sm-2 control-label no-padding-right"><span style="color: red;">*</span>起始时间</label>
			                    <div class="col-xs-12 col-sm-6">
			                       <input type="text" class="width-100" name="fee_rate" value="">
			                    </div>
			                </div>
			                <div class="form-group">
			                    <label class="col-xs-12 col-sm-2 control-label no-padding-right"><span style="color: red;">*</span>企业名称</label>
			                    <div class="col-xs-12 col-sm-6">
			                       <input type="text" class="width-100" name="fee_rate" value="">
			                    </div>
			                </div>
			                <div class="form-group">
			                    <label class="col-xs-12 col-sm-2 control-label no-padding-right">地址</label>
			                    <div class="col-xs-12 col-sm-6">
			                       <input type="text" class="width-100" name="fee_rate" value="">
			                    </div>
			                </div>
			                <div class="form-group">
			                    <label class="col-xs-12 col-sm-2 control-label no-padding-right"><span style="color: red;">*</span>联系人</label>
			                    <div class="col-xs-12 col-sm-6">
			                       <input type="text" class="width-100" name="fee_rate" value="">
			                    </div>
			                </div>
			                <div class="form-group">
			                    <label class="col-xs-12 col-sm-2 control-label no-padding-right"><span style="color: red;">*</span>电话</label>
			                    <div class="col-xs-12 col-sm-6">
			                       <input type="text" class="width-100" name="fee_rate" value="">
			                    </div>
			                </div>
			                <div class="form-group">
			                    <label class="col-xs-12 col-sm-2 control-label no-padding-right">平台服务费</label>
			                    <div class="col-xs-12 col-sm-6">
			                       <input type="text" class="width-100" name="fee_rate" value="">
			                    </div>
			                </div>
			                <div class="form-group">
			                    <label class="col-xs-12 col-sm-2 control-label no-padding-right">是否启用</label>
			                    <div class="col-xs-12 col-sm-6">
			                       <label>
                                <input type="checkbox" class="ace ace-switch ace-switch-6 ajax-get" name="status" value="{$menu.hide}" <?=$menu['hide'] == '1' ? '' : 'checked'?> url="{:U('toogleHide',array('id'=>$menu['id'],'value'=>abs($menu['hide']-1)))}">
                                <span class="lbl"></span>
                            </label>
			                    </div>
			                </div>
			                <div class="form-group">
			                    <label class="col-xs-12 col-sm-2 control-label no-padding-right">退货地址</label>
			                    <div class="col-xs-12 col-sm-6">
			                       <input type="text" class="width-100" name="fee_rate" value="">
			                    </div>
			                </div>
			                <div class="form-group">
			                    <label class="col-xs-12 col-sm-2 control-label no-padding-right">收件人</label>
			                    <div class="col-xs-12 col-sm-6">
			                       <input type="text" class="width-100" name="fee_rate" value="">
			                    </div>
			                </div>
			                <div class="form-group">
			                    <label class="col-xs-12 col-sm-2 control-label no-padding-right">收件人电话</label>
			                    <div class="col-xs-12 col-sm-6">
			                       <input type="text" class="width-100" name="fee_rate" value="">
			                    </div>
			                </div>        
			                </div>
			        <div class="clearfix form-actions">
			           <div class="col-xs-12">
			               <button id="sub-btn" class="btn btn-sm btn-success no-border ajax-post no-refresh" target-form="form-horizontal" type="submit">
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
</block>
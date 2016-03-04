<extend name="Public/base"/>

<block name="body">
     <div class="table-responsive">
        <div class="dataTables_wrapper">  
            新建指定地区
            <form id="form" action="{:U('addArea')}" method="post" class="form-horizontal">
			    <div class="tab-content no-border padding-24">
			        <!-- 基础数据 -->
					<div id="tab1" class="tab-pane active tab1">
							<input type="hidden" name="freightTplID" value="<?php echo $id;?>">
			                <div class="form-group">
			                    <label class="col-xs-12 col-sm-2 control-label no-padding-right">选择地区</label>
			                    <div class="col-xs-12 col-sm-6">
			                        <select name="type" style="width: 300px;">
			                        	<?php foreach ($country as $k => $v): ?>
			                            <option value="<?php echo $v['id'];?>"><?php echo $v['name'];?></option>
			                            <?php endforeach ?>
			                        </select><br/><br/>
			                        <select name="type" style="width: 300px;">
			                            <option value="BZJ" selected="">广州市</option>
			                            <option value="TX#">三亚市</option>
			                            <option value="BZJ">桂林市</option>
			                            <option value="BZJ">泉州市</option>
			                        </select>                    
			                    </div>
			                    <div class="help-block col-xs-12 col-sm-reset inline">
			                    </div>
			                </div>                
			                <div class="form-group">
			                    <label class="col-xs-12 col-sm-2 control-label no-padding-right"><span style="color: red;">*</span>地区</label>
			                    <div class="col-xs-12 col-sm-6">
			                        <input type="text" class="width-100" name="max_amount"  readonly="readonly" value="广东省广州市">                    </div>
			                    <div class="help-block col-xs-12 col-sm-reset inline">
			                    </div>
			                </div>                
			                <div class="form-group">
			                    <label class="col-xs-12 col-sm-2 control-label no-padding-right"><span style="color: red;">*</span>首重（元）</label>
			                    <div class="col-xs-12 col-sm-6">
			                        <input type="text" class="width-100" name="" value="">                    </div>
			                    <div class="help-block col-xs-12 col-sm-reset inline">
			                    </div>
			                </div>              
			                <div class="form-group">
			                    <label class="col-xs-12 col-sm-2 control-label no-padding-right"><span style="color: red;">*</span>续重（元）</label>
			                    <div class="col-xs-12 col-sm-6">
			                       <input type="text" class="width-100" name="" value="">
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

        $(function() {
			$("#free").hide();

			$("#check").change(function(){
					$("#free").toggle();
				});
        });
    </script>
</block>
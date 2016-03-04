<extend name="Public/base"/>

<block name="body">
     <div class="table-responsive">
        <div class="dataTables_wrapper">  
            编辑运费模板
            <form id="form" action="{:U('editFreight')}" method="post" class="form-horizontal">
			    <div class="tab-content no-border padding-24">
			        <!-- 基础数据 -->
			 		
					<div id="tab1" class="tab-pane active tab1">
							<input type="hidden" name="ID" value="{$info.id}">
							
			                <div class="form-group">			                	
			                    <label class="col-xs-12 col-sm-2 control-label no-padding-right">
			                    	<span style="color: red;">*</span>首重（元，1kg以内）</label>
			                    <div class="col-xs-12 col-sm-6">		                    	
			                        <input type="text" class="width-100" name="firstFreight" value="{$info.firstfreight}">	
			                    </div>
			                    <div class="help-block col-xs-12 col-sm-reset inline">
			                    </div>
			                </div>                
			                <div class="form-group">
			                    <label class="col-xs-12 col-sm-2 control-label no-padding-right">
			                    	<span style="color: red;">*</span>续重（元/kg）</label>
			                    <div class="col-xs-12 col-sm-6">
			                        <input type="text" class="width-100" name="secFreight" value="{$info.secfreight}">                    
			                    </div>
			                    <div class="help-block col-xs-12 col-sm-reset inline">
			                    </div>
			                </div>                
			                <div class="form-group">
			                    <label class="col-xs-12 col-sm-2 control-label no-padding-right">
			                    	<span style="color: red;">*</span>模板名称</label>
			                    <div class="col-xs-12 col-sm-6">
			                        <input type="text" class="width-100" name="freightName" value="{$info.freightname}">                    
			                    </div>
			                    <div class="help-block col-xs-12 col-sm-reset inline">
			                    </div>
			                </div>            
			                <div class="form-group">
			                    <label class="col-xs-12 col-sm-2 control-label no-padding-right">类型</label>
			                    <div class="col-xs-12 col-sm-6">
			                        <select name="freightType">
			                        	
			                            <option value="NOT" <if condition=" $info.freighttype eq 'NOT'" >selected="selected"</if> >包邮</option>
			                            <option value="NOE" <if condition=" $info.freighttype eq 'NOE'" >selected="selected"</if> >包邮（指定地区除外）</option>
			                            <option value="BUY" <if condition=" $info.freighttype eq 'BUY'" >selected="selected"</if> >运费到付</option>
			                            <option value="NAT" <if condition=" $info.freighttype eq 'NAT'" >selected="selected"</if> >全国统一价</option>
			                            <option value="NAE" <if condition=" $info.freighttype eq 'NAE'" >selected="selected"</if> >全国统一价（指定地区除外）</option>
			                        	
			                        </select>                    
			                     </div>
			                    <div class="help-block col-xs-12 col-sm-reset inline">
			                    </div>
			                </div>        
			                </div>
			                
			        <div class="clearfix form-actions">
			           <div class="col-xs-12">
			               <button id="sub-btn" class="btn btn-sm btn-success no-border" target-form="form-horizontal" type="submit">
			                                             更新
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
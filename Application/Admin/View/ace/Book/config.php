<extend name="Public/base" />

<block name="body">
<div class="table-responsive">
	<div class="dataTables_wrapper">
		<!-- 配置列表 -->
		<form action="{:U('')}" class="form-horizontal" method="post">
    		<table class="table table-striped table-bordered table-hover dataTable">
    			<thead>
        			<th width='30%'>配置项</th>
        			<th width='70%'>内容选项</th>
    			</thead>
    			<tbody>
    				<tr>
    					<td>自动收货时间</td>
    					<td>
    					   <select name="auto_rece_time" id="">
    							<foreach name="type['auto_rece_time']" item="vo" key="k" >
                                   <option value="{$vo}" <eq name="vo" value="$bookCfg['auto_rece_time']">selected</eq>>{$k}</option>
                                </foreach>
    					   </select>
    					</td>
    				</tr>
    				<tr>
    					<td>订单自动关闭时间</td>
    					<td>
        					<select name="auto_close_time" id="">
                                <foreach name="type['auto_close_time']" item="vo" key="k" >
                                   <option value="{$vo}" <eq name="vo" value="$bookCfg['auto_close_time']">selected</eq>>{$k}</option>
                                </foreach>
        					</select>
    					</td>
    				</tr>
    				<tr>
    					<td>可退货时间</td>
    					<td>订单在 
                            <select name="return_condi" id="">
                            	<foreach name="condi" item="vo" key="k" >
                                   <option value="{$k}" <eq name="k" value="$bookCfg['return_condi']">selected</eq>>{$vo}</option>
                                </foreach>
                            </select>后 
    				        <input type="text" value="{$bookCfg.return_day}" style='width: 50px' name='return_day' />天内(含)可退货
    					</td>
    				</tr>
    				<tr>
    					<td>可换货时间</td>
    					<td>订单在 
        					<select name="exchange_condi" id="">
            					<foreach name="condi" item="vo" key="k" >
                                   <option value="{$k}" <eq name="k" value="$bookCfg['exchange_condi']">selected</eq>>{$vo}</option>
                                </foreach>
        					</select>后 
        					<input type="text" value="{$bookCfg.exchange_day}" style='width: 50px' name='exchange_day' />天内(含)可退货
    					</td>
    				</tr>
    				<tr>
    					<td>订单佣金比例</td>
    					<td><input type="text" value="{$bookCfg.commission_rate}" style='width: 50px' name='commission_rate' />%</td>
    				</tr>
    			</tbody>
    		</table>
		
		</form>
		<div class="row">
			<div class="col-sm-4">
			<button id="sub-btn" class="btn btn-sm btn-success no-border ajax-post no-refresh" target-form="form-horizontal" type="submit">确认保存</button>
				<a class="btn list_sort btn-white" onclick="history.go(0) ">取消 </a>
			</div>
		</div>
	</div>
</div>
</block>



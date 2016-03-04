<extend name="Public/base" />

<block name="body">

	<div class="table-responsive">
        <div class="dataTables_wrapper">  
			<div class="col-sm-4">
                    <label>
                        <a href="{:U('Freight/addFreight')}" class="btn btn-white">新增运费模板</a>
                    </label>
                </div>
            <!-- 数据列表 -->
            <table class="table table-striped table-bordered table-hover dataTable">
				<thead>
					<tr>
						<th>名称</th>
                        <th>首重（元）</th>
                        <th>续重（元/kg）</th>
                        <th>类型</th>
                        <th>满额包邮（元）</th>
                        <th>操作</th>
					</tr>
				</thead>
				<tbody>
					<notempty name="_list">
                	<?php foreach ($_list as $k => $v): ?>
					<tr>
						<td><?php echo $v['freightname'];?></td>
                        <td>￥<?php echo round(($v['firstfreight']/100),2);?></td>
                        <td>￥<?php echo round(($v['secfreight']/100),2);?></td>
                        <td><?php 
                        	switch ($v['freighttype']){
									case 'NOT':
										echo '包邮';
										break;
									case 'NOE':
										echo '包邮(指定区域除外)';
										break;
									case 'BUY':
										echo '运费到付';
										break;
									case 'NAT':
										echo '全国统一价';
										break;
									case 'NAE':
										echo '全国统一价(指定区域除外)';
										break;
								}
                        ?></td>
                        <td><?php 
                        	switch ($v['fullstatus']){
								case 'USE':
									echo ('启用'.'('.$v['fullsum'].')');
									break;
								case 'FOR':
									echo '关闭';
									break;
							}
                        ?></td>
                        <td>
                            <a title="编辑" href="<?php echo U('editFreight', array('id'=>$v['id'],'p'=>I('get.p', 1)), false);?>" class="ui-pg-div ui-inline">
                                编辑
                            </a>
                            <a title="删除" href="<?php echo U('delFreight', array('id'=>$v['id'],'p'=>I('get.p', 1)), false);?>" class="ui-pg-div ui-inline confirm ajax-get">
                                删除
                            </a>&nbsp;
                            <?php if($v['freighttype']=='NOE'||$v['freighttype']=='NAE'){
                            	$url = U('areaList', array('id'=>$v['id'],'p'=>I('get.p', 1)), false);
                            	echo ("<a href='$url'>指定地区</a>");
                            }                           		
                            ?>
                        </td>
					</tr>
					<?php endforeach ?>
					<else/>
					<td colspan="6" class="text-center"> aOh! 暂时还没有内容! </td>
					</notempty>
				</tbody>
			</table>
            <div class="row">
                
                <div class="col-sm-8" style="float:left;">
                    <include file="Public/page"/>
                </div>
            </div>
		</div>
	</div>
</block>

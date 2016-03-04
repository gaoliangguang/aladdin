<extend name="Public/base" />

<block name="body">
	<!-- 数据列表 -->
	<div class="table-responsive">
        <div class="dataTables_wrapper">  

            <!-- 数据列表 -->
            <table class="table table-striped table-bordered table-hover dataTable">
            
    			<thead>
    				<tr>
    					<th>ID</th>
    					<th>名称</th>
    					<th>描述</th>
    					<th>类型</th>
    					<th>操作</th>
    				</tr>
    			</thead>
    			<tbody>
    				<volist name="list" id="vo">
    					<tr>
    						<td>{$vo.id}</td>
    						<td><a href="{:U('edithook?id='.$vo['id'])}">{$vo.name}</a></td>
    						<td>{$vo.description}</td>
    						<td>{$vo.type_text}</td>
    						<td>
    							<a title="编辑" href="{:U('edithook?id='.$vo['id'])}">编辑</a>
    							<a class="confirm ajax-get" title="删除" href="{:U('delhook?id='.$vo['id'])}">删除</a>
    						</td>
    					</tr>
    				</volist>
    			</tbody>
    		</table>
            <div class="row">
                <div class="col-sm-4">
                    <?php if (IS_ROOT): ?>
                        <a class="btn btn-white" href="{:U('addhook')}">新 增</a>
                    <?php endif ?>
                </div>
                <div class="col-sm-8">
                    <include file="Public/page"/>
                </div>
            </div>
		</div>
	</div>
</block>
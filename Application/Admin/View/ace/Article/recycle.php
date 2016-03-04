<extend name="Public/base" />

<!-- 子导航 -->
<block name="sidebar">
    <include file="sidemenu" />
</block>

<block name="body">

<!-- 数据表格 -->
<div class="table-responsive">
    <div class="dataTables_wrapper"> 
        <table class="table table-striped table-bordered table-hover dataTable">
            <thead>
                <tr>
        		<th class="row-selected">
	               <label>
                       <input class="ace check-all" type="checkbox"/>
                       <span class="lbl"></span>
                   </label>
        		</th>
        		<th class="">编号</th>
        		<th class="">标题</th>
        		<th class="">创建者</th>
        		<th class="">类型</th>
        		<th class="">分类</th>
        		<th class="">删除时间</th>
        		<th class="">操作</th>
        		</tr>
            </thead>
            <tbody>
                <notempty name="list">
        		<volist name="list" id="vo">
        		<tr>
                    <td>
                        <label>
                            <input class="ace ids" type="checkbox" name="ids[]" value="{$vo.id}" />
                            <span class="lbl"></span>
                        </label>
                    </td>
        			<td>{$vo.id} </td>
        			<td>{$vo.title}</td>
        			<td>{$vo.username} </td>
        			<td><span>{:get_document_type($vo['type'])}</span></td>
        			<td><span>{:get_cate($vo['category_id'])}</span></td>
        			<td><span>{$vo.update_time|time_format}</span></td>
        			<td><a href="{:U('article/permit?ids='.$vo['id'])}" class="ajax-get">还原</a>
                        </td>
        		</tr>
        		</volist>
                <else/>
                <tr><td colspan="9" class="text-center"> aOh! 暂时还没有内容! </td></tr>
                </notempty>
        	</tbody>
        </table>
        <div class="row">
            <div class="col-sm-4">
                <button url="{:U('article/clear')}" class="btn btn-white ajax-get">清 空</button>
                <button url="{:U('article/permit')}" class="btn btn-white ajax-post" target-form="ids">还 原</button>
            </div>
            <div class="col-sm-8">
                <include file="Public/page"/>
            </div>
        </div>
	</div>
</div>
</block>

<extend name="Public/base" />
<block name="style">
<style>
/* 拖动排序列表 */
.edit_sort {
    display: inline-block;
    border:1px solid #cdcdcd;
    color: #404040;
    line-height: 35px;
    width: 100%;
    height: 376px;

}
.edit_sort span {
    background: #EEEEEE;
    width: 100%;
    display: inline-block;
    font-weight: bold;
    text-indent: 10px;
    border-bottom: 1px solid #cdcdcd;
    margin-bottom:5px;
}
.edit_sort ul {
    padding: 0 5px;
    overflow-y:scroll;
    height: 334px;
}
.edit_sort_l {
    float: left;
    margin-right: 20px;
}
.dragsort li {
    margin-bottom: 5px;
    padding: 0 6px;
    height: 30px;
    line-height: 30px;
    border: 1px solid #eee;
    background-color: #fff;
    overflow: hidden;
}
.dragsort li em {
    font-style: normal;
}
.dragsort li b {
    display: none;
    float: right;
    padding: 0 6px;
    font-weight: bold;
    color: #000;
}
.dragsort li:hover b {
    display: block;
}
.dragsort .draging-place {
    border-style: dashed;
    border-color: #ccc;
}
</style>
</block>
<block name="body">
<div class="tabbable">
    <ul class="nav nav-tabs padding-18">
        <li class="active"><a data-toggle="tab" href="#tab1"><i class="green icon-edit"></i>基 础</a></li>
        <li><a data-toggle="tab" href="#tab2"><i class="pink icon-dashboard"></i>设 计</a></li>
        <li><a data-toggle="tab" href="#tab3"><i class="blue icon-rocket"></i>高 级</a></li>
    </ul>
	<!-- 表单 -->
	<form id="form" action="{:U('update')}" method="post" class="form-horizontal doc-modal-form">
        <div class="tab-content no-border padding-24">
			<!-- 基础 -->
            <div id="tab1" class="tab-pane active">
				<div class="form-group">
					<label class="col-xs-12 col-sm-2 control-label no-padding-right">模型标识</label>
					<div class="col-xs-12 col-sm-5">
						<input type="text" class="width-100 " name="name" value="{$info.name}">
					</div>
					<span class="help-block col-xs-12 col-sm-reset inline">（请输入文档模型标识）</span>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-2 control-label no-padding-right">模型名称</label>
					<div class="col-xs-12 col-sm-5">
						<input type="text" class="width-100 " name="title" value="{$info.title}">
					</div>
					<span class="help-block col-xs-12 col-sm-reset inline">（请输入模型的名称）</span>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-2 control-label no-padding-right">模型类型</label>
					<div class="col-xs-12 col-sm-5">
						<select name="extend" class="width-100">
							<option value="0">独立模型</option>
							<option value="1">文档模型</option>
						</select>
					</div>
					<span class="help-block col-xs-12 col-sm-reset inline">（目前只支持独立模型和文档模型）</span>
				</div>
                <?php
                echo ace_radio(['label_text'=>'是否需要列表管理','help'=>'勾选需要，则会在列表页面显示出数据的链接'],['name'=>'need_datalist'],$info['need_datalist'],['不需要 &nbsp;','需要 ']);
                ?>
                <?php
                echo ace_radio(['label_text'=>'是否需要批量操作','help'=>'勾选需要，则会在列表页面显示批量操作项'],['name'=>'need_batch_handle'],$info['need_batch_handle'],['不需要 &nbsp;','需要 ']);
                ?>
			</div>

			<div id="tab2" class="tab-pane">
				<div class="form-group">
					<label class="col-xs-12 col-sm-2 control-label no-padding-right">字段管理</label>

					<div class="col-xs-12 col-sm-5">
						<div class="cf edit_sort edit_sort_l form_field_sort">
							<span>字段列表 		[ <a href="{:U('Attribute/add?model_id='.$info['id'])}" target="_balnk">新增</a>
							<a href="{:U('Attribute/index?model_id='.$info['id'])}" target="_balnk">管理</a> ] </span>
							<ul class="dragsort">
								<foreach name="fields" item="field" key="k">
										<li >
											<em ><input class="ids" type="checkbox" name="attribute_list[]" value="{$field['id']}" <if condition="in_array($field['id'],$info['attribute_list'])">checked="checked"</if> /> {$field['title']} [{$field['name']}]</em>
										</li>
								</foreach>
							</ul>
						</div>

					</div>
					<span class="help-block col-xs-12 col-sm-reset inline">（只有新增了字段，该表才会真正建立）</span>
				</div>
                <div class="form-group">
                       <label class="col-xs-12 col-sm-2 control-label no-padding-right">字段别名定义</label>
                       <div class="col-xs-12 col-sm-5">
                           <textarea name="attribute_alias" rows="5" cols="30" class="form-control">{$info.attribute_alias}</textarea>
                       </div>
                       <span class="help-block col-xs-12 col-sm-reset inline">（用于表单显示的名称）</span>
                </div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-2 control-label no-padding-right">表单显示分组</label>
					<div class="col-xs-12 col-sm-5">
						<input type="text" class="width-100" name="field_group" value="{$info.field_group}">
					</div>
					<span class="help-block col-xs-12 col-sm-reset inline">（用于表单显示的分组，以及设置该模型表单排序的显示）</span>
				</div>
				<div class="form-group">
    				<label class="col-xs-12 col-sm-2 control-label no-padding-right">表单显示排序</label>
    				<div class="col-xs-12 col-sm-5">
        				<volist name=":parse_field_attr($info['field_group'])" id="vo">
        					<div class="cf edit_sort edit_sort_l form_field_sort">
        						<span>{$vo}</span>
        						<ul class="dragsort needdragsort" data-group="{$key}">
        							<foreach name="fields" item="field" key="k">
        								<if condition="(($field['group'] eq $key) or($i eq 1 and !isset($field['group']))) and ($field['is_show'] eq 1)">
        									<li class="getSort">
        										<em data="{$field['id']}">{$field['title']} [{$field['name']}]</em>
        										<input type="hidden" name="field_sort[{$key}][]" value="{$field['id']}"/>
        									</li>
        								</if>
        							</foreach>
        						</ul>
        					</div>
        					<div class="hr hr32 hr-dotted"></div>
        				</volist>
    				</div>
    				<span class="help-block col-xs-12 col-sm-reset inline">（直接拖动进行排序）</span>
				</div>

				<div class="form-group">
					<label class="col-xs-12 col-sm-2 control-label no-padding-right">列表定义</label>
					<div class="col-xs-12 col-sm-5">
					   <textarea name="list_grid" rows="5" cols="30" class="form-control">{$info.list_grid}</textarea>
					</div>
					<span class="help-block col-xs-12 col-sm-reset inline">（默认列表模板的展示规则）</span>
				</div>

				<div class="form-group">
					<label class="col-xs-12 col-sm-2 control-label no-padding-right">默认搜索字段</label>
					<div class="col-xs-12 col-sm-5">
						<input type="text" class="width-100" name="search_key" value="{$info.search_key}">
					</div>
					<span class="help-block col-xs-12 col-sm-reset inline">（默认列表模板的默认搜索项）</span>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-2 control-label no-padding-right">高级搜索字段</label>
					<div class="col-xs-12 col-sm-5">
						<input type="text" class="width-100" name="search_list" value="{$info.search_list}">
					</div>
					<span class="help-block col-xs-12 col-sm-reset inline">（默认列表模板的高级搜索项）</span>
				</div>
			</div>

			<!-- 高级 -->
			<div id="tab3" class="tab-pane">
				<div class="form-group">
					<label class="col-xs-12 col-sm-2 control-label no-padding-right">列表模板</label>
					<div class="col-xs-12 col-sm-5">
						<input type="text" class="width-100" name="template_list" value="{$info.template_list}">
					</div>
					<span class="help-block col-xs-12 col-sm-reset inline">（自定义的列表模板，放在Application\Admin\View\Think下，不写则使用默认模板）</span>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-2 control-label no-padding-right">新增模板</label>
					<div class="col-xs-12 col-sm-5">
						<input type="text" class="width-100" name="template_add" value="{$info.template_add}">
					</div>
					<span class="help-block col-xs-12 col-sm-reset inline">（自定义的新增模板，放在Application\Admin\View\Think下，不写则使用默认模板）</span>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-2 control-label no-padding-right">编辑模板</label>
					<div class="col-xs-12 col-sm-5">
						<input type="text" class="width-100" name="template_edit" value="{$info.template_edit}">
					</div>
					<span class="help-block col-xs-12 col-sm-reset inline">（自定义的编辑模板，放在Application\Admin\View\Think下，不写则使用默认模板）</span>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-2 control-label no-padding-right">列表数据大小</label>
					<div class="col-xs-12 col-sm-5">
						<input type="text" class="width-100" name="list_row" value="{$info.list_row}">
					</div>
					<span class="help-block col-xs-12 col-sm-reset inline">（默认列表模板的分页属性）</span>
				</div>
			</div>

            <input type="hidden" name="id" value="{$info['id']}"/>
            <?=ace_srbtn()?>
        </div>
	</form>
</div>
</block>
<block name="script">
<script type="text/javascript" src="__STATIC__/jquery.dragsort-0.5.2.min.js"></script>
<script type="text/javascript" charset="utf-8">
Think.setValue("extend", {$info.extend|default=0});

//导航高亮
highlight_subnav('{:U('Model/index')}');
//拖曳插件初始化
$(function(){
	$(".needdragsort").dragsort({
	     dragSelector:'li',
	     placeHolderTemplate: '<li class="draging-place">&nbsp;</li>',
	     dragBetween:true,	//允许拖动到任意地方
	     dragEnd:function(){
	    	 var self = $(this);
	    	 self.find('input').attr('name', 'field_sort[' + self.closest('ul').data('group') + '][]');
	     }
	 });
})
</script>
</block>


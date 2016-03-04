<volist name="tree" id="list">
	<dl class="cate-item">
		<dt class="cf">
			<form action="{:U('editcategory')}" method="post">
				<div class="btn-toolbar opt-btn cf">
<!--					<a title="编辑" href="{:U('editcategory?id='.$list['id'].'&pid='.$list['parent_id'])}">编辑</a>-->
					<a title="删除" href="{:U('removecategory?id='.$list['id'])}" class="confirm ajax-get">删除</a>
                   
					<a title="移动" href="{:U('operatecategory?type=move&from='.$list['id'])}">移动</a>
<!--					<a title="合并" href="{:U('operatecategory?type=merge&from='.$list['id'])}">合并</a>-->
				</div>
				<div class="fold"><i></i></div>
				<div class="name">
					<span class="tab-sign"></span>
					<input type="hidden" name="id" value="{$list.id}">
					<input type="text"  name="name" class="text" value="{$list.name}">
					<a class="add-sub-cate" title="添加子分类" href="{:U('addcategory?pid='.$list['id'])}">
						<i class="icon-add"></i>
					</a>
					<span class="help-inline msg"></span>
				</div>
                <div class="order">

                    <?php

                        $url = U('setSt?id='.$list['id'].'&status=OFF');
                    if($list['status']=='OK#'){
                        $url = U('setSt?id='.$list['id'].'&status=OK');
                    }
                    ?>
                    <label>
                        <input type="checkbox" class="ace ace-switch ace-switch-6 ajax-get" name="status" value="{$list.status}" <?=$list['status'] == 'OK#' ? 'checked' : ''?> url="<?=$url?>">
                        <span class="lbl"></span>
                    </label>
                </div>

                <div class="description">
                    <input type="hidden" name="id" value="{$list.id}">
                    <input type="text"  name="description" class="text" value="{$list.description}">
                </div>

            <div style="clear: both;"></div>
			</form>
		</dt>
		<notempty name="list['_']">
			<dd>
				{:R('config/tree', array($list['_']))}
			</dd>
		</notempty>
	</dl>
</volist>
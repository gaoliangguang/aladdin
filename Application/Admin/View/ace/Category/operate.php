<extend name="Public/base"/>

<block name="body">
	<div class="page-header">
		<h1>
			分类
			<small>
				<i class="icon-double-angle-right"></i>
				{$operate}
			</small>
		</h1>
	</div>
			<form action="{:U('category/operate',array('type'=>$type))}" method="post" class="form-horizontal">
				<div class="form-group">
					<label class="col-xs-12 col-sm-2 control-label no-padding-right">目标分类</label>
					<div class="col-xs-12 col-sm-5">
						<select name="to">
							<volist name="list" id="vo">
								<option value="{$vo.id}">{$vo.title}</option>
							</volist>
						</select>
					</div>
					<span class="help-block col-xs-12 col-sm-reset inline">（将{$operate}至的分类）</span>
				</div>

				<div class="clearfix form-actions">
                    <div class="col-xs-12 center">
                        <input type="hidden" name="from" value="{$from}">
                        <button type="submit" target-form="form-horizontal" class="btn btn-success ajax-post" id="sub-btn">
                            <i class="icon-ok bigger-110"></i> 确认保存
                        </button> 
                        <a class="btn btn-info" href="javascript:history.back(-1)">
                           <i class="icon-reply"></i>返回上一页
                        </a>  
                    </div>
                </div>
			</form>
</block>


<block name="script">
    <script type="text/javascript">
        //导航高亮
        highlight_subnav('{:U('index')}');
    </script>
</block>
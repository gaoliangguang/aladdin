<extend name="Public/base"/>

<block name="body">
    <!-- 数据列表 -->
    <div class="table-responsive">
        <div class="dataTables_wrapper">  
            <div class="row">
                <div class="col-sm-12">
                    <form action="" class="search-form">
                        <?php if(!empty($model['search_key'])):?>
				        <!-- 高级搜索 -->
				        <label> 
                            <input type="text" name="{$model['search_key']|default='title'}" class="search-input" value="{:I(empty($model['search_key'])?'title':$model['search_key'])}" placeholder="请输入关键字">
                        </label>
                        <label>
                            <button class="btn btn-sm btn-primary" type="button" id="search-btn" id="search" url="{:U('','model='.$model['name'],false)}">
                               <i class="icon-search"></i>搜索
                            </button>
                        </label>
                        <?php endif;?>
                    </form>  
                </div>
            </div>

            <include file="Think/lists_common"/>

            <div class="row">
                <div class="col-sm-4">
                    <empty name="model.extend">
                        <label>
                            <a class="btn btn-white" href="<?=isset($add_url) ? U($add_url) : U('add',['model'=>$model['id']])?>">
                                新增
                            </a>
                        </label>
                        <?php if($model['need_batch_handle']):?>
                            <label>
                                <button class="btn btn-white ajax-post confirm" target-form="ids" url="{:U('del?model='.$model['id'])}">
                                    删 除
                                </button>
                            </label>
                        <?php endif;?>
                    </empty>
                </div>
                <div class="col-sm-8">
                    <include file="Public/page"/>
                </div>
            </div>
        </div>
    </div>
</block>

<block name="script">
<script type="text/javascript">
$(function(){

    //导航高亮
    <?php if(isset($active_menu)):?>
    highlight_subnav('<?=U($active_menu)?>');
    <?php else:?>
    highlight_subnav('{:U('Model/index')}');
    <?php endif;?>
})
</script>
</block>

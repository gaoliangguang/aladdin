<extend name="Public/base"/>

<block name="body">
    <!-- 数据列表 -->
    <div class="table-responsive">
        <div class="dataTables_wrapper">  

            <include file="Think/lists_common"/>
            <div class="row">
                <div class="col-sm-4">
                    <label>
                        <a href="<?=U('config/addhangye')?>" class="btn btn-white">
                            新增
                        </a>
                    </label>
                </div>
                <div class="col-sm-8">
                    <include file="Public/page"/>
                </div>
            </div>
        </div>
    </div>
</block>
<extend name="Public/base"/>

<block name="body">

    <!--列表 -->
    <div class="table-responsive">
        <div class="dataTables_wrapper">
            <div class="row">
                <div class="col-sm-12">
                    <form method="get" action="__SELF__" class="search-form">
                        <label>状态:
                            <?php
                               echo form_dropdown('status',array_values($status_list),I('status'));
                            ?>
                        </label>
                        <label>
                            <button class="btn btn-sm btn-primary" type="button" id="search-btn" url="{:U('factory/tasklist')}">
                                <i class="icon-search"></i>搜索
                            </button>
                        </label>
                    </form>
                </div>
            </div>
            <table class="table table-striped table-bordered table-hover dataTable">
                <thead>
                <tr>
                    <th class="" width="8%">序号</th>
                    <th class="">产品ID</th>
                    <th class="">产品名称</th>
                    <th class="">任务名称</th>
                    <th class="">制作号码数量(万个)</th>
                    <th class="">状态</th>
                    <th class="">备注</th>
                    <th class="">开始执行时间</th>
                </tr>
                </thead>
                <tbody id="tbody_content">
                <notempty name="_list">
                    <volist name="_list" id="vo">
                        <tr>
                            <td>{$key+1} </td>
                            <td>{$vo.productid}</td>
                            <td>{$vo.productname}</td>
                            <td>{$vo.taskname}</td>
                            <td>{$vo['amount']/10000}</td>
                            <td>{$status_list[$vo['status']]}</td>
                            <td>{$vo.remark}</td>
                            <td>{$vo.starttime}</td>
                        </tr>
                    </volist>
                    <else/>
                    <td colspan="9" class="text-center"> aOh! 暂时还没有内容! </td>
                </notempty>
                </tbody>
            </table>

            <div class="row">
                <div class="col-sm-4">
                    <label>
                        <a class="btn btn-white" href="{:U('addTask')}">
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
<extend name="Public/base"/>

<block name="body">
    <?php $status=['CRT'=>'待处理','OK#'=>'已处理','NON'=>'不处理']?>
    <?php $ref_type=['TER'=>'招标项目']?>

    <div class="table-responsive">
        <div class="dataTables_wrapper">
            <!-- 数据列表 -->
            <table class="table table-striped table-bordered table-hover dataTable">
                <thead>
                <tr>
                    <th>举报人</th>
                    <th>举报类别</th>
                    <th>举报类别Id</th>
                    <th>举报时间</th>
                    <th>处理状态</th>
                    <th>举报内容</th>
                </tr>
                </thead>
                <tbody>
                <notempty name="_list">
                    <volist name="_list" id="item">
                        <tr>
                            <td>{$item.nick_name}</td>
                            <td><?php echo $ref_type[$item['ref_type']];?></td>
                            <td>{$item.ref_id}</td>
                            <td>{$item.insert_time}</td>
                            <td><?php echo $status[$item['deal_status']];?></td>
                            <td>{$item.report_content}</td>
                        </tr>
                    </volist>
                    <else/>
                    <td colspan="10" class="text-center"> aOh! 暂时还没有内容! </td>
                </notempty>
                </tbody>
            </table>
            <div class="row">
                <div class="col-sm-4">
                </div>
                <div class="col-sm-8">
                    <include file="Public/page"/>
                </div>
            </div>
        </div>
    </div>
</block>



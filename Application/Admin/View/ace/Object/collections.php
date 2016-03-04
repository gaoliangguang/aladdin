<extend name="Public/base"/>

<block name="body">
    <?php $status=['OK#'=>'已收款','FLS'=>'收款失败','CRT'=>'待收款'];?>
    <div class="table-responsive">
        <div class="dataTables_wrapper">

            <div class="row">
                <div class="col-sm-12">
                    <form class="search-form">
                        <label>项目名称
                            <input type="text" class="search-input" name="object_name" value="{:I('object_name')}" placeholder="请输入标的名称">
                        </label>
                        <label>状态
                            <select name="status">
                                <option value="">请选择</option>
                                <?php
                                foreach ($status as $k=>$v){
                                    $selected = $k==I('status')?'selected':'';
                                    echo '<option value="'.$k.'" '.$selected.' >'.$v."</option>";
                                }
                                ?>
                            </select>
                        </label>
                        <label>
                            <button class="btn btn-sm btn-primary" type="button" id="search-btn" url="{:U('collections')}">
                                <i class="icon-search"></i>搜索
                            </button>
                        </label>
                    </form>
                </div>
            </div>

            <!-- 数据列表 -->
            <table class="table table-striped table-bordered table-hover dataTable">
                <thead>
                <tr>
                    <th>项目名称</th>
                    <th class="text-right">工程总额</th>
                    <th>总期数</th>
                    <th class="text-right">剩余金额</th>
                    <th>剩余期数</th>
                    <th>当前期数</th>
                    <th>当前金额</th>
                    <th>实付时间</th>
                    <th>应付时间</th>
                    <th>状态</th>
                </tr>
                </thead>
                <tbody>
                <notempty name="_list">
                    <volist name="_list" id="item">
                        <tr>
                            <td>
                                {$item.object_name}
                                <br>
                                (<?=$item['project_id']?>)
                            </td>
                            <td class="text-right">{$item.total_amount|price_format}</td>
                            <td>{$item.total_period}</td>
                            <td class="text-right">{$item.left_amount|price_format}</td>
                            <td>{$item.left_period}</td>
                            <td>{$item.current_period}</td>
                            <td>{$item.amount|price_format}</td>
                            <td><?=date('Y-m-d',strtotime($item['should_receive_time']))?></td>
                            <td><?=date('Y-m-d',strtotime($item['receive_time']))?></td>
                            <td><?php echo $status[$item['status']];?></td>
                        </tr>
                    </volist>
                    <else/>
                    <td colspan="11" class="text-center"> aOh! 暂时还没有内容! </td>
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
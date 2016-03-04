<extend name="Public/base" />

<block name="body">
    <div class="table-responsive">
        <div class="dataTables_wrapper">

            <div class="row">
                <div class="col-sm-12">
                    <form action="<?=U('cgqdgl/cgxmindex')?>" method="POST" class="search-form">
                        <label>采购编号
                            <input type="text" class="search-input" name="purchase_no" value="{:I('purchase_no')}">
                        </label>
                        <label>采购名称
                            <input type="text" class="search-input" name="purchase_name" value="{:I('purchase_name')}">
                        </label>
                        <!--<label>工程类别
                            <?/*=form_dropdown('industry_id',[''=>'---全部---']+$industry,I('industry_id'))*/?>
                        </label>-->
                        <label>
                            <button class="btn btn-sm btn-primary" type="button" id="search-btn" url="{:U('cgqdgl/cgxmindex')}">
                                <i class="icon-search"></i>搜索
                            </button>
                        </label>
                    </form>
                </div>
            </div>
            <?php
            $status = ['CRT'=>'编写中','PUB'=>'正在采购','RVK'=>'撤回采购','UPT'=>'正在更新','ADA'=>'废标','FLS'=>'流标','WBO'=>'等待开标','REV'=>'评标中','SEL'=>'施工中','END'=>'已结束'];
            ?>
            <!-- 数据列表 -->
            <table class="table table-striped table-bordered table-hover dataTable">
                <thead>
                <tr>
                    <th class="">采购编号</th>
                    <th class="">采购名称</th>
                    <th class="">地区</th>
                    <th class="">抢单人数</th>
                    <th class="text-right">采购估价</th>
                    <!--<th class="">工程类别</th>-->
                    <th class="">创建时间</th>
                    <th class="">抢单截止日期</th>
                    <th class="">开标日期</th>
                    <th class="">状态</th>
                    <th class="">操作</th>
                </tr>
                </thead>
                <tbody>
                <notempty name="list">
                    <volist name="list" id="vo">
                        <tr>
                            <td><a href="{:U('cgxqindex',array('purchase_no'=>$vo['purchase_no']))}">{$vo.purchase_no}</a></td>
                            <td><?=$vo['purchase_name']?></td>
                            <td class="area"  provinc="<?=$vo['project_site_province']?>"  city="<?=$vo['project_site_city']?>"  town="<?=$vo['project_site_town']?>" >
                                &nbsp;
                            </td>
                            <td><?=isset($tb_counts[$vo['purchase_no']])?$tb_counts[$vo['purchase_no']]:'0'?></td>
                            <td class="text-right"><?=price_format($vo['evaluation_amount'])?></td>
                            <td><?=isset($vo['insert_time'])?date('Y-m-d H:i',strtotime($vo['insert_time'])):'未填写'?></td>
                            <td><?=isset($vo['bidding_end_time'])?date('Y-m-d H:i',strtotime($vo['bidding_end_time'])):'未填写'?></td>
                            <td><?=isset($vo['bid_open_date'])?date('Y-m-d',strtotime($vo['bidding_end_time'])):'未填写'?></td>
                            <td><?= $status[$vo['object_status']]?></td>
                            <td>
                                <?php if($vo['object_status']=='PUB'||$vo['object_status']=='WBO'||$vo['object_status']=='PUB'){ ?>
                                    <a href="{:U('cancel?purchase_no='.$purchase_no)}" >
                                        撤销
                                    </a>
                                <?php }else{ ?>
                                    <a href="{:U('cgxqindex',array('purchase_no'=>$vo['purchase_no']))}" >
                                        查看
                                    </a>
                                <?php }?>
                            </td>
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
<block name="script">
    <script type="text/javascript" src="__STATIC__/city.js"></script>
    <script>
        $("td.area").each(function(){
            var $this = $(this);
            $this.html(XBW.linkage.getParentsText($this.attr('city') || $this.attr('provinc') || ''));
        })
    </script>
</block>
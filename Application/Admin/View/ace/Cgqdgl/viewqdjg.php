<extend name="Public/base" />

<block name="body">
<div class="detail-content">
    <div class="page-header">
        <h1>
            抢单详情
        </h1>
    </div>
    <div class="widget-header widget-header-small header-color-green">
        <h6 class="smaller">
           总报价
        </h6>
    </div>
    <table class="table table-striped table-bordered table-hover">
        <tbody>
        <tr>
            <th width="50%">项目报价</th>
            <td><?=price_format($item['bid_amount'])?></td>
        </tr>
        </tbody>
    </table>
    <div class="widget-header widget-header-small header-color-blue">
        <h6 class="smaller">
            报价信息
        </h6>
    </div>
    <table class="table table-striped table-bordered table-hover">
        <tr class="thead">
            <td  width="30%">产品名称</td>
            <td width="40%">采购明细</td>
            <td width="30%">采购报价</td>
        </tr>
        <?php foreach($purchase_list as $p):?>
            <tr>
                <td><?=$p['name']?></td>
                <td><?=$p['purchase_detail']?></td>
                <td><?=price_format($p['item_amount'])?></td>
            </tr>
        <?php endforeach;?>
    </table>
    <div class="widget-header widget-header-small header-color-green">
        <h6 class="smaller">
            投标保函
        </h6>
    </div>
    <table class="table table-striped table-bordered table-hover">
        <tbody>
            <tr>
                <th width="50%">保函金额</th>
                <td><?=price_format($item['bank_guarrantee_amount'])?></td>
            </tr>

            <tr>
                <th>保函凭证编号</th>
                <td><?=$item['bank_guarantee_no']?></td>
            </tr>
            <tr>
                <th>保函凭证扫描件</th>
                <td><a class="ace-thumbnails" href="<?=imageView2($item['bank_guarrantee_url'])?>">查看</a></td>
            </tr>
        </tbody>
    </table>

    <div class="widget-header widget-header-small header-color-green">
        <h6 class="smaller">
            抢单文件
        </h6>
    </div>
    <table class="table table-striped table-bordered table-hover">
        <tbody>
            <th>项目报价表</th>
            <td><a href="<?=get_qiniu_file_durl($item['project_quotation_url'])?>">下载</a></td>
        </tbody>
    </table>

    <div class="clearfix form-actions">
        <div class="col-xs-12">
            <a onclick="history.go(-1)" class="btn btn-white" href="javascript:;">
                <i class="icon-reply"></i>返回上一页
            </a>
        </div>
    </div>
</div>
</block>

<block name="script">
<include file="Public/colorbox"/>
<script>
    highlight_subnav('<?=U('cgqdgl/viewqdjg')?>');
</script>
</block>
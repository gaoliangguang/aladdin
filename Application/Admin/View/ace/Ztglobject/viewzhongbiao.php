<extend name="Public/base" />

<block name="body">
<div class="detail-content">
    <div class="page-header">
        <h1>
            资格审查
        </h1>
    </div>
    <div class="widget-header widget-header-small header-color-blue">
        <h6 class="smaller">
            投标人营业执照
        </h6>
    </div>
    <table class="table table-striped table-bordered table-hover">
        <tbody>
            <tr>
                <th width="50%">营业执照公司名称</th>
                <td>
                    <?=$item['company_name']?>
                </td>
            </tr>
            <?php if($item['business_license_type'] == ''):?>
            <tr>
                <th>营业执照编号</th>
                <td>
                    <?=$item['new_business_license']?>
                </td>
            </tr>
            <?php else:?>
            <tr>
                <th>营业执照编号</th>
                <td>
                    <?=$item['business_license']?>
                </td>
            </tr>
            <tr>
                <th>组织机构代码证</th>
                <td>
                    <?=$item['org_code_certificate']?>
                </td>
            </tr>
            <tr>
                <th>税务登记证</th>
                <td>
                    <?=$item['tax_registration_certificate']?>
                </td>
            </tr>
            <?php endif;?>
        </tbody>
    </table>
    <div class="widget-header widget-header-small header-color-green">
        <h6 class="smaller">
            投标人资质证书
        </h6>
    </div>
    <table class="table table-striped table-bordered table-hover">
        <tbody>
            <tr>
                <td><?=implode('、',$tbzz_list)?></td>
            </tr>
        </tbody>
    </table>
    <div class="widget-header widget-header-small header-color-blue">
        <h6 class="smaller">
            投标人安全生产证明
        </h6>
    </div>
    <table class="table table-striped table-bordered table-hover">
        <tbody>
            <tr>
                <th width="50%">安全生产许可证编号</th>
                <td><?=$item['safety_permit_No']?></td>
            </tr>
            <tr>
                <th>安全生产许可证有效期</th>
                <td><?=$item['safety_permit_endtime']?></td>
            </tr>
            <tr>
                <th>安全生产许可证附件</th>
                <td><a class="ace-thumbnails" href="<?=imageView2($item['safety_permit_url'])?>">查看</a></td>
            </tr>
            <tr>
                <th>项目经理安全生产考核合格证编号</th>
                <td><?=$item['pm_safety_certification_No']?></td>
            </tr>
            <tr>
                <th>项目经理安全生产考核合格证有效期</th>
                <td><?=$item['pm_safety_certification_endtime']?></td>
            </tr>
            <tr>
                <th>项目经理安全生产考核合格证附件</th>
                <td><a class="ace-thumbnails" href="<?=imageView2($item['pm_safety_certification_url'])?>">查看</a></td>
            </tr>
        </tbody>
    </table>
    <div class="widget-header widget-header-small header-color-green">
        <h6 class="smaller">
            投标人主要人员资质
        </h6>
    </div>
    <table class="table table-striped table-bordered table-hover">
        <tbody>
            <tr>
                <th width="50%">项目经理证编号</th>
                <td><?=$item['pm_certification_No']?></td>
            </tr>
            <tr>
                <th>项目经理证有效期</th>
                <td><?=$item['pm_certification_endtime']?></td>
            </tr>
            <tr>
                <th>项目经理证附件</th>
                <td><a class="ace-thumbnails" href="<?=imageView2($item['pm_certification_url'])?>">查看</a></td>
            </tr>
            <tr>
                <th>注册建造师证编号</th>
                <td><?=$item['constructor_certification_No']?></td>
            </tr>
            <tr>
                <th>注册建造师证有效期</th>
                <td><?=$item['constructor_certification_endtime']?></td>
            </tr>
            <tr>
                <th>注册建造师证附件</th>
                <td><a class="ace-thumbnails" href="<?=imageView2($item['constructor_certification_url'])?>">查看</a></td>
            </tr>
        </tbody>
    </table>
    <div class="widget-header widget-header-small header-color-blue">
        <h6 class="smaller">
            投标保函
        </h6>
    </div>
    <table class="table table-striped table-bordered table-hover">
        <tbody>
            <tr>
                <th width="50%">投标保函金额</th>
                <td><?=$item['pm_certification_No']?></td>
            </tr>
            <tr>
                <th>保函凭证编号</th>
                <td><?=price_format($item['bank_guarantee_amount'])?></td>
            </tr>
            <tr>
                <th>保函凭证扫描件</th>
                <td><a class="ace-thumbnails" href="<?=imageView2($item['bank_guarantee_url'])?>">查看</a></td>
            </tr>
        </tbody>
    </table>
    <div class="page-header">
        <h1>
            商务标/技术标、施工保证金、投标文件
        </h1>
    </div>
    <div class="widget-header widget-header-small header-color-green">
        <h6 class="smaller">
            投标保函
        </h6>
    </div>
    <table class="table table-striped table-bordered table-hover">
        <tbody>
            <tr>
                <th width="50%">项目报价</th>
                <td><?=price_format($item['bid_amount'])?></td>
            </tr>
            <tr>
                <th>项目报价表</th>
                <td><a href="<?=get_qiniu_file_durl($item['project_quotation_url'])?>">下载</a></td>
            </tr>
            <tr>
                <th>施工承诺函</th>
                <td>
                    开工日期：<?=$item['construction_start_date']?>
                    <br/>
                    竣工日期：<?=$item['construction_end_date']?>
                </td>
            </tr>
            <tr>
                <th>施工承诺函扫描件</th>
                <td><a class="ace-thumbnails" href="<?=imageView2($item['construction_commitment_url'])?>">查看</a></td>
            </tr>
            <tr>
                <th>技术标书</th>
                <td><a href="<?=get_qiniu_file_durl($item['technical_standard_url'])?>">下载</a></td>
            </tr>
        </tbody>
    </table>

    <div class="widget-header widget-header-small header-color-blue">
        <h6 class="smaller">
            施工保证金
        </h6>
    </div>
    <table class="table table-striped table-bordered table-hover">
        <tbody>
            <tr>
                <td class="center">
                    <span class="btn btn-app btn-sm btn-yellow no-hover" style="width: auto; padding-right: 5px;">
                        <span class="line-height-1 bigger-170">
                            ￥<?=price_format($item['bzj'])?>
                        </span>
                        <br>
                        <span class="line-height-1 smaller-90"> 元 </span>
                    </span>
                </td>
            </tr>
        </tbody>
    </table>
    <div class="widget-header widget-header-small header-color-green">
        <h6 class="smaller">
            投标文件
        </h6>
    </div>
    <table class="table table-striped table-bordered table-hover">
        <tbody>
            <tr>
                <td class="center">
                    <a href="<?=get_qiniu_file_durl($item)?>" class="btn btn-app btn-purple btn-sm">
                        <i class="icon-cloud-download bigger-200"></i>
                        查看
                    </a>
                </td>
            </tr>
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
    highlight_subnav('<?=U('ztglobject/yzbindex')?>');
</script>
</block>
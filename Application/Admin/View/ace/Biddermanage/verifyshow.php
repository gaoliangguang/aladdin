<extend name="Public/base" />

<block name="body">
    <?php
    $business_license_type = ['NEW'=>[
                                    'unified_social_credit_code'=>'统一社会信用代码',
                                    'unified_social_credit_code_url'=>[
                                        'img'=>'统一社会信用代码扫描件'
                                    ],
                                ],
                                'OLD'=>[
                                    'business_license'=>'营业执照',
                                    'business_license_url'=>[
                                        'img'=>'营业执照扫描件'
                                    ],
                                    'tax_registration_certificate'=>'税务登记证编号',
                                    'tax_registration_certificate_url'=>[
                                        'img'=>'税务登记证扫描件'
                                    ],
                                    'org_code_certificate'=>'组织机构代码证编号',
                                    'org_code_certificate_url'=>[
                                        'img'=>'组织机构代码证扫描件'
                                    ],
                                ]
                            ];
    ?>
    <!-- 表单 -->
    <div class="space-10"></div>
    <form action="{:U('check')}" method="POST" class="form-horizontal check_data" id="form_submit" role="form">
        <input type="hidden" name="id"  value="{$item.id}">
        <div class="widget-header widget-header-small header-l-blue">
            <h5 class="smaller">
                账号基本信息
            </h5>
        </div>
        <table class="table table-striped table-bordered table-hover item-table">
            <tbody>
                <tr>
                    <td><span>昵称:</span>{$user.nick_name}</td>
                    <td><span>电话:</span>{$user.mobile_num}</td>
                </tr>
                <tr>
                    <td colspan="2">
                        <span class="">姓名:</span>{$user.real_name}
                    </td>
                </tr>
            </tbody>
        </table>

        <?php foreach($table_list as $title=>$tr):?>
        <div class="widget-header widget-header-small header-l-blue">
            <h5 class="smaller">
                <?=$title?>
            </h5>
        </div>
        <?php if($title == '资质列表'):?>
        <table class="table table-striped table-bordered table-hover dataTable">
            <thead>
                <tr>
                    <th>资质类别</th>
                    <th>资质名称</th>
                    <th>资质编号</th>
                    <th>资质有效期</th>
                    <th>适用区域</th>
                    <th>扫描件</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($tr as $td):?>
                <tr>
                    <td><?=$td['industry_id']?></td>
                    <td><?=$td['certification_name']?></td>
                    <td><?=$td['certification_no']?></td>
                    <td><?=$td['expire_time']?></td>
                    <td><?=$td['applicable_region']?></td>
                    <td>
                        <a href="<?=imageView2($td['certification_content'])?>" class="ace-thumbnails" >
                            <img src="<?php echo imageView2($td['certification_content'],50,50)?>"/>
                        </a>
                    </td>
                </tr>
                <tr>
                    <td colspan="7">
                        <div class="control-group center">
                            <label>
                                <input class="ace" type="radio" value="Y" name="certificationsCheck[<?=$td['id']?>]">
                                <span class="lbl"> 审核通过</span>
                            </label>
                            <label>
                                <input class="ace" type="radio" value="N" name="certificationsCheck[<?=$td['id']?>]">
                                <span class="lbl"> 审核不通过</span>
                            </label>
                            <input type="text" name="certificationsCheck_msg[<?=$td['id']?>]" placeholder="输入审核未通过原因">
                        </div>
                    </td>
                </tr>
                <?php endforeach;?>
            </tbody>
        </table>
        <?php
                continue;
            endif;
        ?>
        <table class="table table-striped table-bordered table-hover item-table ">
            <tbody>
            <?php
            foreach($tr as $key=>$td){
                switch($key){
                    case 'business_license_type':
                        echo '<tr><td colspan="2"><span>'.$td.'：</span>'.(($item[$key]=='NEW') ? '三证合一' : '非三证合一').'</td></tr>';
//                        var_dump($td);
                        foreach($business_license_type[$item[$key]] as $kk=>$ttd){
                            echo render_td($ttd,$item,$kk);
                        }
                        continue;
                        break;
                    default:
                        echo render_td($td,$item,$key);
                }
            };
            ?>
        </table>
        <?php endforeach;?>

        <input type="hidden" name="business_license_type" value="<?=$item['business_license_type']?>" >
        <?=ace_srbtn('确认审核','before="subbef"')?>
    </form>
</block>


<block name="script">
    <include file="Public/colorbox"/>
    <script type="text/javascript" charset="utf-8">
        $(function(){
            $("input[type=radio]").click(function(){
                if(this.value == 'Y'){
                    $(this).closest('tr').children('td').css('background-color','#dff0d8');
                }else{
                    $(this).closest('tr').children('td').css('background-color','#f2dede');
                }
            });
        });
        function subbef(){
            var ret = true;
            $("input[type=radio][value=Y]").each(function (i,e){
                if(!e.checked&&$(e).parent().next().next().val()=='')
                {
                    ret =false;
                    layer.alert('请先填写不通过原因!',{icon:2});
                    return false;
                }
            });
            return ret;
        }
        //导航高亮
        highlight_subnav('{:U('biddermanage/verify')}');
    </script>
</block>

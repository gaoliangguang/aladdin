<extend name="Public/base" />

<block name="body">
<?php
$panel_titles = [
    'xmjbxx'=>'项目基本信息',
    'gcjbxx'=>'工程基本信息',
    'gcsgzm'=>'工程施工证明',
    'gqyq'=>'工期要求',
    'zzyq'=>'资质要求',
    'bzj'=>'保证金',
    'zbfs'=>'招标方式',
    'ztbwjyq'=>'招投标文件要求',
    'dyfs'=>'答疑方式',
    'pbfs'=>'评标方式',
];
?>
<?php foreach($panel_titles as $key=>$val):?>
    <div url="<?=$key?>" class="widget-header widget-header-small header-l-blue">
        <h5 class="smaller">
            <?=$val?>
        </h5>
    </div>
    <table class="table table-striped table-bordered table-hover item-table">
        <tbody id="<?=$key?>">

        </tbody>
    </table>
<?php endforeach;?>
<div class="clearfix form-actions">
    <div class="col-xs-12">
        <a onclick="history.go(-1)" class="btn btn-white" href="javascript:;">
            返回
        </a>
    </div>
</div>
</block>
<block name="script">

<include file="Public/colorbox"/>
<script>
    $(document).ready(function () {

        //导航高亮
        highlight_subnav('<?=$active_menu?>');
        function get_tb_detail(type){
            var loading = layer.load();
            $.post(
                '<?=U('ztglobject/viewzb',['object_id'=>$object_id])?>',
                {type:type},
                function(html){
                    $("#"+type).html(html);
                },
                'html'
            ).always(function(){
                layer.close(loading);
            });
        }

        $(".widget-header").each(function(){
            var type = $(this).attr('url');
            if(!$(type).data('loaded')){
                get_tb_detail(type);
                $(type).data('loaded',true);
            }
        })
    })
</script>
</block>

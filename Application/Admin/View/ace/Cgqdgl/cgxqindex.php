<extend name="Public/base" />

<block name="body">
<?php
$panel_titles = [
    'xqjbxx'=>'需求基本信息',
    'xqlb'=>'需求列表',
    'bzj'=>'保证金',
    'sjyq'=>'时间要求',
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
                '<?=U('cgqdgl/cgxqindex',['purchase_no'=>$purchase_no])?>',
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

$.getJSON('<?php echo addons_url("XbDistrict://XbDistrict/getData");?>',$.proxy(function(json){
    XBW.linkagesel.data = json;
    XBW.linkagesel.selector  = "#<?=$param['id']?>";
    
    delete(json);
    XBW.linkagesel.init(
            {
		root:'<?=isset($param['root']) ? $param['root'] : 0?>',
                url:json,
                <?php if(!empty($param['district'])):?>
                district:'<?=$param['district']?>',
                <?php endif;?>
                selected:'<?=$param['selected']?>'
            }
    );
    <?php 
    if(!empty($param['callback'])){
    	echo $param['callback'].'.call()';
    }
    ?>
    
}, this));

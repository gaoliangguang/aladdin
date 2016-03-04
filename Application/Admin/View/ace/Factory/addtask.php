<extend name="Public/base"/>

<block name="body"> 
    <?php 
        echo ace_form_open('','',array('productName'=>''));

        $data = array('label_text'=>'请选择产品类型','help'=>'');
        echo ace_dropdown($data,'accountType',$accountTypeList);

        $data = array('label_text'=>'请选择产品','help'=>'');
        echo ace_dropdown($data,'productId',array(''=>'--请选择产品--'));

        $data = array('label_text'=>'<span class="red">*</span>请选择发卡机构','help'=>'');
        echo ace_dropdown($data,'unitId',$unit_list);

        $options = array(
            'label_text'=>'任务名称',
            'icon'=>'icon-info-sign'
        );
        echo ace_input_m($options ,'taskName','','maxlength="50"');

        $options = array(
            'label_text'=>'制作号码数量',
            'help'=>'单位（万个）',
        );
        echo ace_input_m($options ,array('name'=>'amount','class'=>'only-num width-100'),'','maxlength="6"');

        echo ace_textarea(array('label_text'=>'备注'),'remark');
        
        echo ace_srbtn();
        echo ace_form_close()
    ?>
</block>

<block name="script">
    <script type="text/javascript">
        //导航高亮
        highlight_subnav('{:U('factory/tasklist')}');
        var productList = {$productList};
        $("select[name=accountType]").change(function(){
            $("input[name=productName]").val('');
            var _option_html = '<option value="">--请选择产品--</option>';
            var val = $(this).val();
            if(productList[val] == null){
                $("select[name=productId]").html(_option_html);
                return false;
            }
            $.each(productList[val],function(k,product){
                _option_html += '<option value="'+product.productid+'">'+product.productname+'</option>';
            })
            
            $("select[name=productId]").html(_option_html);
        });
        $("select[name=accountType]").change();           
        
        $("select[name=productId]").change(function(){
            $("input[name=productName]").val($("select[name=productId] option:selected").text());
        });
        
        
    </script>
</block>

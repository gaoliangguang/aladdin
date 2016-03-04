<extend name="Public/base"/>

<block name="body">
    <?php
    echo ace_form_open();

    $unit_list=['EPC'=>'总承包','SBT'=>'专业承包'];

    $data = array('label_text'=>'<span class="red">*</span>承包类型','help'=>'显示承包类型');
    echo ace_dropdown($data,'industry_type',$unit_list);

    $options = array(
        'label_text'=>'工程类型内部标识',
        'help'=>'唯一标识，不能重复'
    );
    echo ace_input_m($options ,array('name'=>'id','class'=>'width-100','max-length'=>10),'',' maxlength="11"');

    $options = array(
        'label_text'=>'工程类型',
        'help'=>'显示名称',
    );
    echo ace_input_m($options ,array('name'=>'industry_name','class'=>'width-100'),'');


    $options = array(
        'label_text'=>'工程类型图标',
        'help'=>'用于用户门户中的图标显示',
    );
    echo ace_input_m($options ,array('name'=>'industry_icon','class'=>'width-100'),'');

    echo ace_srbtn();
    echo ace_form_close()
    ?>
</block>

<block name="script">
    <script type="text/javascript">
        //导航高亮
        highlight_subnav('{:U('config/hangye')}');
    </script>
</block>

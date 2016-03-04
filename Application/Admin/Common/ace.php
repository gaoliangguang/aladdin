<?php
function render_td($td,$item,$key){
    $html = '<tr>
                <td>';
    if(!is_array($td)){
        $html .= '<span>'.$td.'：</span>'.$item[$key];
    }else{
        foreach($td as $el=>$label){
            $html .= '<span>'.$label.'：</span>';
            switch($el){
                case 'img':
                    $html .= '<a href="'.imageView2($item[$key]).'" class="ace-thumbnails" ><img src="'.imageView2($item[$key],100,100).'"/></a>';
                    break;
            }
        }
    }
    $html .='
                </td>
                    <td>
                        <div class="control-group">
                            <label>
                                <input class="ace" type="radio" value="Y" name="'.$key.'">
                                <span class="lbl"> 审核通过</span>
                            </label>
                            <label>
                                <input class="ace" type="radio" value="N" name="'.$key.'">
                                <span class="lbl"> 审核不通过</span>
                            </label>
                            <input type="text" name="'.$key.'_msg" placeholder="输入审核未通过原因">
                        </div>
                    </td>
                </tr>';

    return $html;
}

if ( ! function_exists('ace_html')){
    function ace_html($label_text='', $value = '', $extra = ''){
        $default = array('class'=>'autosize-transition span12 form-control','rows'=>'');
        return ace_group(ace_label($label_text), '<span class="form-control">'.$value.'</span>');
    }
}

// ------------------------------------------------------------------------

if ( ! function_exists('ace_view_pic')){
    function ace_view_pic($label_text='',$value=''){


        $label = ace_label($label_text);

        $element = '<a class="cboxElement" href="'.$value.'">
            		        <span>点击查看图片</span>
            	         </a>';
        return ace_group($label, $element);
    }
}
// ------------------------------------------------------------------------
if ( ! function_exists('ace_header')){
    function ace_header($navi=array(), $url=''){
        return '';
        $html = '<div class="page-header">
                    <h1>
                        '.$navi[1].'
                        <small>
                            <i class="icon-double-angle-right"></i>
		                    '.$navi[2].'
                        </small>
                    </h1>
                 </div>';
        return $html;
    }
}

// ------------------------------------------------------------------------

if ( ! function_exists('ace_form_open')){
    function ace_form_open($action = '', $attributes = array(), $hidden = array()){

        $default = array('class' => 'form-horizontal', 'id' => 'form_submit','role'=>'form');
        if(!is_array($attributes)){
            $attributes = array();
        }
        $attributes = array_merge($default,$attributes);

        return form_open($action,$attributes,$hidden);
    }
}

// ------------------------------------------------------------------------

if ( ! function_exists('ace_form_close')){
    function ace_form_close($extra=''){
        return form_close($extra);
    }
}

// ------------------------------------------------------------------------

if ( ! function_exists('ace_checkbox'))
{
    function ace_checkbox($setting='', $data='', $checked = FALSE, $options=array(1=>'是',0=>'否'), $extra = 'class="ace"')
    {
        if ( ! is_array($setting))
        {
            $setting = array('label_text' => $setting);
        }

        $setting = array_merge(array('help'=>''),$setting);

        $element = '';
        foreach ($options as $v=>$text){
            if(is_array($checked)){

                $is_checked = in_array($v, $checked) ? true : false;
            }else{

                $is_checked = $checked == $v ? true : false;
            }
            $element .= '<label>'.form_checkbox($data,$v,$is_checked,$extra).'<span class="lbl">'.$text.'</span></label>';
        }

        return ace_group(ace_label($setting['label_text']),$element,$setting['help']);
    }
}

// ------------------------------------------------------------------------

if ( ! function_exists('ace_radio'))
{
    function ace_radio($setting='', $data='', $checked = FALSE, $options=array(1=>' 是&nbsp; ',0=>' 否 &nbsp; '), $extra = 'class="ace"')
    {
        if ( ! is_array($setting))
        {
            $setting = array('label_text' => $setting);
        }

        $setting = array_merge(array('help'=>''),$setting);

        $element = '';
        foreach ($options as $v=>$text){
            $is_checked = $checked == $v ? true : false;
            $element .= '<label>'.form_radio($data,$v,$is_checked,$extra).'<span class="lbl">'.$text.'</span></label>';
        }

        return ace_group(ace_label($setting['label_text']),$element,$setting['help']);
    }
}

// ------------------------------------------------------------------------

if ( ! function_exists('ace_password')){
    function ace_password($options='', $data=''){
        if ( ! is_array($data)){
            $data = array('name' => $data);
        }
        $data['type']     = 'password';
        $data['class']    = 'width-100';
        return ace_input_m($options,$data,'','maxlength="20"');
    }
}

// ------------------------------------------------------------------------

if ( ! function_exists('ace_label_m')){
    function ace_label_m($label_text='', $id=''){

        return ace_label($label_text,$id,TRUE);
    }
}

// ------------------------------------------------------------------------

if ( ! function_exists('ace_label')){
    function ace_label($label_text='', $id='', $must=FALSE){

        $label_attr         = array('class' => 'col-xs-12 col-sm-2 control-label no-padding-right');
        if($must){
            $label_text         = '<span class="red">*</span>'.$label_text;
        }
        return form_label($label_text,$id,$label_attr);
    }
}

// ------------------------------------------------------------------------

if ( ! function_exists('ace_srbtn')){
    function ace_srbtn($sb_content='确认保存',$attr=''){
        $html = '<div class="clearfix form-actions">
                      <div class="col-xs-12">
                          <button id="sub-btn" class="btn btn-sm btn-success no-border ajax-post no-refresh" '.$attr.' target-form="form-horizontal" type="submit">
                              '.$sb_content.'
                          </button> ';

        $html .='	  <a href="javascript:;" class="btn btn-white" onClick="history.go(-1)">
                         返回
                      </a>';

        $html .= '	</div>
                  </div>';
        return $html;
    }
}
// ------------------------------------------------------------------------

if ( ! function_exists('ace_upload_pic')){
    function ace_upload_file($options='', $name='', $value='', $url='',$extra=''){

        if(!is_array($options)){
            $options                = array('label_text'=>$options);
        }
        $options = array_merge(array('help'=>'','btn_text'=>'选择图片','icon'=>'picture'),$options);

        $label = ace_label($options['label_text'],$name);

        $data = array('class'=>'btn btn-sm btn-primary choose_pic','id'=>$name,'url'=>$url);
        $element = form_button($data,'<i class="icon-'.$options['icon'].'"></i> '.$options['btn_text'],$extra);
        if($value){
            $element .= '<a class="cboxElement" href="'.$value.'">
            		        <span>点击查看图片</span>
            		        <input type="hidden" name="'.$name.'" value="'.$value.'" />
            	         </a>';
        }
        return ace_group($label, $element, $options['help']);
    }
}
// ------------------------------------------------------------------------

if ( ! function_exists('ace_textarea')){
    function ace_textarea($options='', $data = '', $value = '', $extra = ''){
        if ( ! is_array($data)){
            $data           = array('name' => $data);
        }
         
        $label_text = '';
        if(is_array($options) && array_key_exists('label_text', $options)){
            $label_text = $options['label_text'];
        }elseif(is_string($options)){
            $label_text = $options;
            $options = array('help'=>'');
        }
         
        $default = array('class'=>'autosize-transition span12 form-control','rows'=>'');
        $data = array_merge($default,$data);
        return ace_group(ace_label($label_text,$data['name']), form_textarea($data,$value,$extra),$options['help']);
    }
}

// ------------------------------------------------------------------------

if ( ! function_exists('ace_dropdown')){
    function ace_dropdown($data='', $name='', $options=array(), $selected=array(), $extra='class="width-100"'){

        if(!is_array($data)){
            $data                = array('label_text'=>$data);
        }
        $data = array_merge(array('help'=>''),$data);
         
        return ace_group(ace_label($data['label_text'],$name), form_dropdown($name,$options,$selected,$extra), $data['help']);
    }
}
// ------------------------------------------------------------------------

if ( ! function_exists('ace_input_m')){
    function ace_input_m($options='', $data='', $value='', $extra=''){
        return ace_input($options,$data,$value,$extra,TRUE);
    }
}

// ------------------------------------------------------------------------

if ( ! function_exists('ace_input')){
    function ace_input($options='', $data='', $value='', $extra='', $must=FALSE){
        if ( ! is_array($data)){
            $data           = array('name' => $data);
            $data['id']     = $data['name'];
            $data['class']  = 'width-100';
        }
        if(!is_array($options)){
            $options                = array('label_text'=>$options);
        }

        $default                = array();
        $default['help']        = '';
        $default['icon']        = 'icon-info-sign';

        $options = array_merge($default,$options);

        if($must){
            $label = ace_label_m($options['label_text'],$data['name']);
        }else{
            $label = ace_label($options['label_text'],$data['name']);
        }
         
        $element = '<span class="input-icon block input-icon-right">'.form_input($data,$value,$extra).'<i class="icon '.$options['icon'].'"></i></span>';
         
        return ace_group($label,$element,$options['help']);
    }
}

// ------------------------------------------------------------------------
if ( ! function_exists('ace_group')){
    function ace_group($label='', $element='',$help=''){
        $html  = '<div class="form-group">';
        $html .=     $label;
        $html .=     '<div class="col-xs-12 col-sm-5">';
        $html .=          $element;
        $html .=     '</div>
            	      <div class="help-block col-xs-12 col-sm-reset inline">'.
            	      $help
            	      .'</div>
            	 </div>';
        return $html;
    }
}

// ------------------------------------------------------------------------
if ( ! function_exists('ace_linksel')){
    function ace_linksel($label='', $id='',$options=array()){
        $html = ace_group(ace_label($label,$id),'<div id="'.$id.'"></div>');
        $html .= '<script type="text/javascript">
                    $(function(){
                        $("#'.$id.'").linkagesel('.json_encode($options).');
                    });
                  </script>';
        return $html;
    }
}
// ------------------------------------------------------------------------


// ------------------------------------------------------------------------

/**
 * Form Declaration
 *
 * Creates the opening portion of the form.
 *
 * @access	public
 * @param	string	the URI segments of the form destination
 * @param	array	a key/value pair of attributes
 * @param	array	a key/value pair hidden data
 * @return	string
 */
if ( ! function_exists('form_open'))
{
    function form_open($action = '', $attributes = '', $hidden = array())
    {
        if ($attributes == '')
        {
            $attributes = 'method="post"';
        }

        // If an action is not a full URL then turn it into one
        if ($action && strpos($action, '://') === FALSE)
        {
            $action = U($action);
        }

        // If no action is provided then set to the current url
        $action OR $action = __SELF__;

        $form = '<form action="'.$action.'"';

        $form .= _attributes_to_string($attributes, TRUE);

        $form .= '>';

        if (is_array($hidden) AND count($hidden) > 0)
        {
            $form .= sprintf("<div style=\"display:none\">%s</div>", form_hidden($hidden));
        }

        return $form;
    }
}

// ------------------------------------------------------------------------

/**
 * Form Declaration - Multipart type
 *
 * Creates the opening portion of the form, but with "multipart/form-data".
 *
 * @access	public
 * @param	string	the URI segments of the form destination
 * @param	array	a key/value pair of attributes
 * @param	array	a key/value pair hidden data
 * @return	string
 */
if ( ! function_exists('form_open_multipart'))
{
    function form_open_multipart($action = '', $attributes = array(), $hidden = array())
    {
        if (is_string($attributes))
        {
            $attributes .= ' enctype="multipart/form-data"';
        }
        else
        {
            $attributes['enctype'] = 'multipart/form-data';
        }

        return form_open($action, $attributes, $hidden);
    }
}

// ------------------------------------------------------------------------

/**
 * Hidden Input Field
 *
 * Generates hidden fields.  You can pass a simple key/value string or an associative
 * array with multiple values.
 *
 * @access	public
 * @param	mixed
 * @param	string
 * @return	string
 */
if ( ! function_exists('form_hidden'))
{
    function form_hidden($name, $value = '', $recursing = FALSE)
    {
        static $form;

        if ($recursing === FALSE)
        {
            $form = "\n";
        }

        if (is_array($name))
        {
            foreach ($name as $key => $val)
            {
                form_hidden($key, $val, TRUE);
            }
            return $form;
        }

        if ( ! is_array($value))
        {
            $form .= '<input type="hidden" name="'.$name.'" id="'.$name.'" value="'.form_prep($value, $name).'" />'."\n";
        }
        else
        {
            foreach ($value as $k => $v)
            {
                $k = (is_int($k)) ? '' : $k;
                form_hidden($name.'['.$k.']', $v, TRUE);
            }
        }

        return $form;
    }
}

// ------------------------------------------------------------------------

/**
 * Text Input Field
 *
 * @access	public
 * @param	mixed
 * @param	string
 * @param	string
 * @return	string
 */
if ( ! function_exists('form_input'))
{
    function form_input($data = '', $value = '', $extra = '')
    {
        $defaults = array('type' => 'text', 'name' => (( ! is_array($data)) ? $data : ''), 'value' => $value);

        return "<input "._parse_form_attributes($data, $defaults).$extra." />";
    }
}

// ------------------------------------------------------------------------

/**
 * Password Field
 *
 * Identical to the input function but adds the "password" type
 *
 * @access	public
 * @param	mixed
 * @param	string
 * @param	string
 * @return	string
 */
if ( ! function_exists('form_password'))
{
    function form_password($data = '', $value = '', $extra = '')
    {
        if ( ! is_array($data))
        {
            $data = array('name' => $data);
        }

        $data['type'] = 'password';
        return form_input($data, $value, $extra);
    }
}

// ------------------------------------------------------------------------

/**
 * Upload Field
 *
 * Identical to the input function but adds the "file" type
 *
 * @access	public
 * @param	mixed
 * @param	string
 * @param	string
 * @return	string
 */
if ( ! function_exists('form_upload'))
{
    function form_upload($data = '', $value = '', $extra = '')
    {
        if ( ! is_array($data))
        {
            $data = array('name' => $data);
        }

        $data['type'] = 'file';
        return form_input($data, $value, $extra);
    }
}

// ------------------------------------------------------------------------

/**
 * Textarea field
 *
 * @access	public
 * @param	mixed
 * @param	string
 * @param	string
 * @return	string
 */
if ( ! function_exists('form_textarea'))
{
    function form_textarea($data = '', $value = '', $extra = '')
    {
        $defaults = array('name' => (( ! is_array($data)) ? $data : ''), 'cols' => '40', 'rows' => '10');

        if ( ! is_array($data) OR ! isset($data['value']))
        {
            $val = $value;
        }
        else
        {
            $val = $data['value'];
            unset($data['value']); // textareas don't use the value attribute
        }

        $name = (is_array($data)) ? $data['name'] : $data;
        return "<textarea "._parse_form_attributes($data, $defaults).$extra.">".form_prep($val, $name)."</textarea>";
    }
}

// ------------------------------------------------------------------------

/**
 * Multi-select menu
 *
 * @access	public
 * @param	string
 * @param	array
 * @param	mixed
 * @param	string
 * @return	type
 */
if ( ! function_exists('form_multiselect'))
{
    function form_multiselect($name = '', $options = array(), $selected = array(), $extra = '')
    {
        if ( ! strpos($extra, 'multiple'))
        {
            $extra .= ' multiple="multiple"';
        }

        return form_dropdown($name, $options, $selected, $extra);
    }
}

// --------------------------------------------------------------------

/**
 * Drop-down Menu
 *
 * @access	public
 * @param	string
 * @param	array
 * @param	string
 * @param	string
 * @return	string
 */
if ( ! function_exists('form_dropdown'))
{
    function form_dropdown($name = '', $options = array(), $selected = array(), $extra = '')
    {
        if ( ! is_array($selected))
        {
            $selected = array($selected);
        }

        // If no selected state was submitted we will attempt to set it automatically
        if (count($selected) === 0)
        {
            // If the form name appears in the $_POST array we have a winner!
            if (isset($_POST[$name]))
            {
                $selected = array($_POST[$name]);
            }
        }

        if ($extra != '') $extra = ' '.$extra;

        $multiple = (count($selected) > 1 && strpos($extra, 'multiple') === FALSE) ? ' multiple="multiple"' : '';

        $form = '<select name="'.$name.'"'.$extra.$multiple.">\n";

        foreach ($options as $key => $val)
        {
            $key = (string) $key;

            if (is_array($val) && ! empty($val))
            {
                $form .= '<optgroup label="'.$key.'">'."\n";

                foreach ($val as $optgroup_key => $optgroup_val)
                {
                    $sel = (in_array($optgroup_key, $selected)) ? ' selected="selected"' : '';

                    $form .= '<option value="'.$optgroup_key.'"'.$sel.'>'.(string) $optgroup_val."</option>\n";
                }

                $form .= '</optgroup>'."\n";
            }
            else
            {
                $sel = (in_array($key, $selected)) ? ' selected="selected"' : '';

                $form .= '<option value="'.$key.'"'.$sel.'>'.(string) $val."</option>\n";
            }
        }

        $form .= '</select>';

        return $form;
    }
}

// ------------------------------------------------------------------------

/**
 * Checkbox Field
 *
 * @access	public
 * @param	mixed
 * @param	string
 * @param	bool
 * @param	string
 * @return	string
 */
if ( ! function_exists('form_checkbox'))
{
    function form_checkbox($data = '', $value = '', $checked = FALSE, $extra = '')
    {
        $defaults = array('type' => 'checkbox', 'name' => (( ! is_array($data)) ? $data : ''), 'value' => $value);

        if (is_array($data) AND array_key_exists('checked', $data))
        {
            $checked = $data['checked'];

            if ($checked == FALSE)
            {
                unset($data['checked']);
            }
            else
            {
                $data['checked'] = 'checked';
            }
        }

        if ($checked == TRUE)
        {
            $defaults['checked'] = 'checked';
        }
        else
        {
            unset($defaults['checked']);
        }

        return "<input "._parse_form_attributes($data, $defaults).$extra." />";
    }
}

// ------------------------------------------------------------------------

/**
 * Radio Button
 *
 * @access	public
 * @param	mixed
 * @param	string
 * @param	bool
 * @param	string
 * @return	string
 */
if ( ! function_exists('form_radio'))
{
    function form_radio($data = '', $value = '', $checked = FALSE, $extra = '')
    {
        if ( ! is_array($data))
        {
            $data = array('name' => $data);
        }

        $data['type'] = 'radio';
        return form_checkbox($data, $value, $checked, $extra);
    }
}

// ------------------------------------------------------------------------

/**
 * Submit Button
 *
 * @access	public
 * @param	mixed
 * @param	string
 * @param	string
 * @return	string
 */
if ( ! function_exists('form_submit'))
{
    function form_submit($data = '', $value = '', $extra = '')
    {
        $defaults = array('type' => 'submit', 'name' => (( ! is_array($data)) ? $data : ''), 'value' => $value);

        return "<input "._parse_form_attributes($data, $defaults).$extra." />";
    }
}

// ------------------------------------------------------------------------

/**
 * Reset Button
 *
 * @access	public
 * @param	mixed
 * @param	string
 * @param	string
 * @return	string
 */
if ( ! function_exists('form_reset'))
{
    function form_reset($data = '', $value = '', $extra = '')
    {
        $defaults = array('type' => 'reset', 'name' => (( ! is_array($data)) ? $data : ''), 'value' => $value);

        return "<input "._parse_form_attributes($data, $defaults).$extra." />";
    }
}

// ------------------------------------------------------------------------

/**
 * Form Button
 *
 * @access	public
 * @param	mixed
 * @param	string
 * @param	string
 * @return	string
 */
if ( ! function_exists('form_button'))
{
    function form_button($data = '', $content = '', $extra = '')
    {
        $defaults = array('name' => (( ! is_array($data)) ? $data : ''), 'type' => 'button');

        if ( is_array($data) AND isset($data['content']))
        {
            $content = $data['content'];
            unset($data['content']); // content is not an attribute
        }

        return "<button "._parse_form_attributes($data, $defaults).$extra.">".$content."</button>";
    }
}

// ------------------------------------------------------------------------

/**
 * Form Label Tag
 *
 * @access	public
 * @param	string	The text to appear onscreen
 * @param	string	The id the label applies to
 * @param	string	Additional attributes
 * @return	string
 */
if ( ! function_exists('form_label'))
{
    function form_label($label_text = '', $id = '', $attributes = array())
    {

        $label = '<label';

        if ($id != '')
        {
            $label .= " for=\"$id\"";
        }

        if (is_array($attributes) AND count($attributes) > 0)
        {
            foreach ($attributes as $key => $val)
            {
                $label .= ' '.$key.'="'.$val.'"';
            }
        }

        $label .= ">$label_text</label>";

        return $label;
    }
}

// ------------------------------------------------------------------------
/**
 * Fieldset Tag
 *
 * Used to produce <fieldset><legend>text</legend>.  To close fieldset
 * use form_fieldset_close()
 *
 * @access	public
 * @param	string	The legend text
 * @param	string	Additional attributes
 * @return	string
 */
if ( ! function_exists('form_fieldset'))
{
    function form_fieldset($legend_text = '', $attributes = array())
    {
        $fieldset = "<fieldset";

        $fieldset .= _attributes_to_string($attributes, FALSE);

        $fieldset .= ">\n";

        if ($legend_text != '')
        {
            $fieldset .= "<legend>$legend_text</legend>\n";
        }

        return $fieldset;
    }
}

// ------------------------------------------------------------------------

/**
 * Fieldset Close Tag
 *
 * @access	public
 * @param	string
 * @return	string
 */
if ( ! function_exists('form_fieldset_close'))
{
    function form_fieldset_close($extra = '')
    {
        return "</fieldset>".$extra;
    }
}

// ------------------------------------------------------------------------

/**
 * Form Close Tag
 *
 * @access	public
 * @param	string
 * @return	string
 */
if ( ! function_exists('form_close'))
{
    function form_close($extra = '')
    {
        return "</form>".$extra;
    }
}

// ------------------------------------------------------------------------

/**
 * Form Prep
 *
 * Formats text so that it can be safely placed in a form field in the event it has HTML tags.
 *
 * @access	public
 * @param	string
 * @return	string
 */
if ( ! function_exists('form_prep'))
{
    function form_prep($str = '', $field_name = '')
    {
        static $prepped_fields = array();

        // if the field name is an array we do this recursively
        if (is_array($str))
        {
            foreach ($str as $key => $val)
            {
                $str[$key] = form_prep($val);
            }

            return $str;
        }

        if ($str === '')
        {
            return '';
        }

        // we've already prepped a field with this name
        // @todo need to figure out a way to namespace this so
        // that we know the *exact* field and not just one with
        // the same name
        if (isset($prepped_fields[$field_name]))
        {
            return $str;
        }

        $str = htmlspecialchars($str);

        // In case htmlspecialchars misses these.
        $str = str_replace(array("'", '"'), array("&#39;", "&quot;"), $str);

        if ($field_name != '')
        {
            $prepped_fields[$field_name] = $field_name;
        }

        return $str;
    }
}

// ------------------------------------------------------------------------

/**
 * Parse the form attributes
 *
 * Helper function used by some of the form helpers
 *
 * @access	private
 * @param	array
 * @param	array
 * @return	string
 */
if ( ! function_exists('_parse_form_attributes'))
{
    function _parse_form_attributes($attributes, $default)
    {
        if (is_array($attributes))
        {
            foreach ($default as $key => $val)
            {
                if (isset($attributes[$key]))
                {
                    $default[$key] = $attributes[$key];
                    unset($attributes[$key]);
                }
            }

            if (count($attributes) > 0)
            {
                $default = array_merge($default, $attributes);
            }
        }

        $att = '';

        foreach ($default as $key => $val)
        {
            if ($key == 'value')
            {
                $val = form_prep($val, $default['name']);
            }

            $att .= $key . '="' . $val . '" ';
        }

        return $att;
    }
}

// ------------------------------------------------------------------------

/**
 * Attributes To String
 *
 * Helper function used by some of the form helpers
 *
 * @access	private
 * @param	mixed
 * @param	bool
 * @return	string
 */
if ( ! function_exists('_attributes_to_string'))
{
    function _attributes_to_string($attributes, $formtag = FALSE)
    {
        if (is_string($attributes) AND strlen($attributes) > 0)
        {
            if ($formtag == TRUE AND strpos($attributes, 'method=') === FALSE)
            {
                $attributes .= ' method="post"';
            }

            if ($formtag == TRUE AND strpos($attributes, 'accept-charset=') === FALSE)
            {
                $attributes .= ' accept-charset="'.strtolower(config_item('charset')).'"';
            }

            return ' '.$attributes;
        }

        if (is_object($attributes) AND count($attributes) > 0)
        {
            $attributes = (array)$attributes;
        }

        if (is_array($attributes) AND count($attributes) > 0)
        {
            $atts = '';

            if ( ! isset($attributes['method']) AND $formtag === TRUE)
            {
                $atts .= ' method="post"';
            }

            if ( ! isset($attributes['accept-charset']) AND $formtag === TRUE)
            {
                $atts .= ' accept-charset="utf-8"';
            }

            foreach ($attributes as $key => $val)
            {
                $atts .= ' '.$key.'="'.$val.'"';
            }

            return $atts;
        }
    }
}

<extend name="Public/base"/>

<block name="body">
<div class="tabbable">
    <ul class="nav nav-tabs padding-18">
        <volist name="Think.config.CONFIG_GROUP_LIST" id="group">

            <li <eq name="id" value="$key">class="active"</eq>><a href="{:U('?id='.$key)}">{$group}配置</a></li>

        </volist>
    </ul>
    <div class="tab-content no-border padding-24">
        <div class="tab-pane active">
            <?php 
            echo ace_form_open('save');
            ?>
            <volist name="list" id="config">
                <div class="form-group">
                      <label class="col-xs-12 col-sm-2 control-label no-padding-right" for="nickname">{$config.title}</label>
                      <div class="col-xs-12 col-sm-5">
                          <switch name="config.type">
				              <case value="0">
				              <span class="input-icon block input-icon-right">
	                              <input type="text" class="width-100" id="nickname" value="{$config.value}" name="config[{$config.name}]">
	                              <i class="icon icon-info-sign"></i>
	                          </span>
				              </case>
				              <case value="1">
                              <span class="input-icon block input-icon-right">
                                  <input type="text" class="width-100" id="nickname" value="{$config.value}" name="config[{$config.name}]">
                                  <i class="icon icon-info-sign"></i>
                              </span>
				              </case>
				              <case value="2">
				              <textarea class="autosize-transition span12 form-control" rows="" cols="40" name="config[{$config.name}]">{$config.value}</textarea>
				              </case>
				              <case value="3">
			                  <textarea class="autosize-transition span12 form-control" rows="5" cols="40" name="config[{$config.name}]">{$config.value}</textarea>
				              </case>
				              <case value="4">
				              <select name="config[{$config.name}]" class="width-100">
				                  <volist name=":parse_config_attr($config['extra'])" id="vo">
				                      <option value="{$key}" <eq name="config.value" value="$key">selected</eq>>{$vo}</option>
				                  </volist>
				              </select>
				              </case>
				              <case value="5"><!--增加富文本和非明文-->
                                   <textarea id="<?php echo $config['name']?>" name="config[{$config.name}]" style="width:auto;">{$config.value}</textarea>
                                    <?php echo hook('adminArticleEdit', array('id'=>$config['name'],'name'=>"config[".$config['name']."]",'value'=>$config['value']));?>
                    	      </case>
                    	      <case value="6">
                    			   <input type="password" class="width-100"  name="config[{$config.name}]" value="{$config.value}">
                    		  </case>
	                      </switch>
                      </div>
                      <div class="help-block col-xs-12 col-sm-reset inline">{$config.remark}</div>
                </div>
	        </volist>
            <?php
            echo ace_srbtn();
            echo ace_form_close()
            ?>
        </div>
    </div>
</div>
</block>
<block name="script">
<script type="text/javascript">
    //导航高亮
    highlight_subnav('{:U('config/group')}');
</script>
</block>

<extend name="Public/base" />

<block name="style">
<style>
    .dragsort {
        width:400px;
    }
    .dragsort li {
        margin-bottom: 5px;
        padding: 0 6px;
        height: 30px;
        line-height: 30px;
        border: 1px solid #eee;
        background-color: #fff;
    	overflow: hidden;
    }
    .dragsort li em {
        font-style: normal;
    }
    .dragsort li b {
        display: none;
        float: right;
        padding: 0 6px;
        font-weight: bold;
        color: #000;
    }
    .dragsort li:hover b {
        display: block;
    }
    .dragsort .draging-place {
        border-style: dashed;
        border-color: #ccc;
    }
</style>
</block>

<block name="body">
<?php 
    echo ace_form_open('updateHook');
    $options = array(
        'label_text'=>'钩子名称',
        'help'=>'（需要在程序中先添加钩子，否则无效）',
    );
    echo ace_input_m($options ,'name',$data['name']);
    
    echo ace_textarea(array('label_text'=>'钩子描述','help'=>'钩子的描述信息'),'description',$data['description']);

    $options = array('label_text'=>'钩子类型','help'=>'区分钩子的主要用途');
    echo ace_dropdown($options,'pid',C('HOOKS_TYPE'),$data['type']);
?>
    <present name="data">
		<div class="form-group">
			<label class="col-xs-12 col-sm-2 control-label no-padding-right">钩子挂载的插件排序</label>
			<div class="col-xs-12 col-sm-5">
				<input type="hidden" name="addons" value="{$data.addons}" readonly>
				<empty name="data.addons">
					暂无插件，无法排序
				<else />
				<ul id="sortUl" class="dragsort">
					<volist name=":explode(',',$data['addons'])" id="addons_vo">
						<li class="getSort"><b>&times;</b><em>{$addons_vo}</em></li>
					</volist>
				</ul>
				<script type="text/javascript">
					$(function(){
						$("#sortUl").dragsort({
                            dragSelector:'li',
                            placeHolderTemplate: '<li class="draging-place">&nbsp;</li>',
                            dragEnd:function(){
                            	updateVal();
                            }
                        });

						$('#sortUl li b').click(function(){
                        	$(this).parent().remove();
                        	updateVal();
                        });

						// 更新排序后的隐藏域的值
                        function updateVal() {
                        	var sortVal = [];
                        	$('#sortUl li').each(function(){
                        		sortVal.push($('em',this).text());
                        	});
                            $("input[name='addons']").val(sortVal.join(','));
                        }
					})
				</script>
				</empty>
			</div>
			<span class="help-block col-xs-12 col-sm-reset inline">拖动后保存顺序，影响同一个钩子挂载的插件执行先后顺序</span>
		</div>
	</present>
	<input type="hidden" name="id" value="{$data.id}">
<?php    
    echo ace_srbtn();
    echo ace_form_close()
?>
</block>

<block name="script">
	<present name="data">
		<script type="text/javascript" src="__STATIC__/jquery.dragsort-0.5.2.min.js"></script>
	</present>
	<script type="text/javascript">
		$(function(){
			//导航高亮
			highlight_subnav('{:U('Addons/hooks')}');
		})
	</script>
</block>
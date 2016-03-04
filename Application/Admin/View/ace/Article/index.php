<extend name="Public/base"/>

<!-- 子导航 -->
<block name="sidebar">
    <include file="sidemenu" />
</block>

<block name="body">
<!-- 标题 -->
<div class="page-header">
	<h1>

	<small>
    文档列表({$_total})
    [
	<notempty name="rightNav">
	<volist name="rightNav" id="nav">
	<a href="{:U('index','cate_id='.$nav['id'])}">{$nav.title}</a>
		<if condition="count($rightNav) gt $i"><i class="ca"></i></if>
	</volist>
	<present name="article">：<a href="{:U('index','cate_id='.$cate_id.'&pid='.$article['id'])}">{$article.title}</a></present>
	<else/>
	<empty name="position">全部<else/><a href="{:U('article/index')}">全部</a></empty>
		<foreach name="Think.config.DOCUMENT_POSITION" item="vo">
		<neq name="position" value="$key"><a href="{:U('index',array('position'=>$key))}">{$vo}</a><else/>{$vo}</neq>&nbsp;
		</foreach>
	</notempty>
	]
	<eq name="allow" value="0">（该分类不允许发布内容）</eq>
	<if condition="count($model) gt 1">[ 模型：<empty name="model_id"><strong>全部</strong><else/><a href="{:U('index',array('pid'=>$pid,'cate_id'=>$cate_id))}">全部</a></empty>
		<volist name="model" id="vo">
		<neq name="model_id" value="$vo"><a href="{:U('index',array('pid'=>$pid,'cate_id'=>$cate_id,'model_id'=>$vo))}">{$vo|get_document_model='title'}</a><else/><strong>{$vo|get_document_model='title'}</strong></neq>&nbsp;
		</volist>
	]</if>
    <!--
	<notempty name="groups">
        [ 分组：
        <empty name="group_id"><strong>全部</strong><else/><a href="{:U('index',array('pid'=>$pid,'cate_id'=>$cate_id))}">全部</a></empty>
		<foreach name="groups" item="vo">
		<neq name="group_id" value="$key">
            <a href="{:U('index',array('pid'=>$pid,'cate_id'=>$cate_id,'model_id'=>$model_id,'group_id'=>$key))}">
                {$vo}
            </a>
        <else/>
        <strong>{$vo}</strong>
        </neq>&nbsp;
		</foreach>
	    ]
    </notempty>
    -->
	</small>
	</h1>
</div>

<!-- 数据表格 -->
<div class="table-responsive">
    <div class="dataTables_wrapper">   
        <div class="row">
            <form method="get" action="__SELF__" class="search-form">
                <div class="col-sm-12 row">
                    
                    <label>状&nbsp; &nbsp; &nbsp; &nbsp; 态： 
                       <?php 
                            $status = array('所有','禁用','正常','待审核');
                            echo form_dropdown('status',$status,I('status'));s
                        ?>
                    </label>
                    <label>
                		更新时间：
                		<input type="text" id="time-start" name="time-start" class="text input-2x" value="" placeholder="起始时间" /> -
                		<input type="text" id="time-end" name="time-end" class="text input-2x" value="" placeholder="结束时间" />
                	</label>
                	<label>
                		创建者：
                		<input type="text" name="nickname" class="text input-2x" value="" placeholder="请输入用户名">
                	</label>
                    <label>
                        <button class="btn btn-sm btn-primary" type="button" id="search-btn" url="__SELF__">
                           <i class="icon-search"></i>搜索
                        </button>
                    </label>
                </div>
            </form>
        </div>
        <table class="table table-striped table-bordered table-hover dataTable">
            <!-- 表头 -->
            <thead>
                <tr>
                    <th class="row-selected">
                       <label>
                           <input class="ace check-all" type="checkbox"/>
                           <span class="lbl"></span>
                       </label>
                    </th>
                    <volist name="list_grids" id="field">
                        <th>{$field.title}</th>
                    </volist>
                </tr>
            </thead>

            <!-- 列表 -->
            <tbody>
                <notempty name="list">
                <volist name="list" id="data">
                    <tr>
                        <td>
                            <label>
                                <input class="ace ids" type="checkbox" name="ids[]" value="{$data['id']}" />
                                <span class="lbl"></span>
                            </label>
                        </td>
                        <volist name="list_grids" id="grid">
                            <td>{:get_list_field($data,$grid)}</td>
                        </volist>
                    </tr>
                </volist>
                <else/>
                <tr><td colspan="9" class="text-center"> aOh! 暂时还没有内容! </td></tr>
                </notempty>
            </tbody>
        </table>
        <div class="row">
            <div class="col-sm-12">
                <gt name="allow" value="0">
                    <div class="btn-group">
                        <button style="border-width: 1px;" data-toggle="dropdown" class="btn btn-white document_add dropdown-toggle" <if condition="count($model) eq 1">url="{:U('article/add',array('cate_id'=>$cate_id,'pid'=>I('pid',0),'model_id'=>$model[0],'group_id'=>$group_id))}"</if>>
                            新 增
                            <if condition="count($model) gt 1"><i class="icon-angle-down icon-on-right"></i></if>
                        </button>
                        <if condition="count($model) gt 1">
                            <ul class="dropdown-menu dropdown-danger nav-list">
                                <volist name="model" id="vo">
                                    <li><a href="{:U('article/add',array('cate_id'=>$cate_id,'model_id'=>$vo,'pid'=>I('pid',0),'group_id'=>$group_id))}">{$vo|get_document_model='title'}</a></li>
                                </volist>
                            </ul>
                        </if>
                    </div>
                    <else/>
                    <button class="btn btn-sm disabled" >新 增
                        <if condition="count($model) gt 1"><i class="icon-angle-down icon-on-right"></i></if>
                    </button>
                </gt>
                <button style="border-width: 1px;" class="btn btn-white ajax-post" target-form="ids" url="{:U("Article/setStatus",array("status"=>1))}">启 用</button>
                <button class="btn btn-white ajax-post" target-form="ids" url="{:U("Article/setStatus",array("status"=>0))}">禁 用</button>
                <button class="btn btn-white ajax-post" target-form="ids" url="{:U("Article/move")}">移 动</button>
                <button class="btn btn-white ajax-post" target-form="ids" url="{:U("Article/copy")}">复 制</button>
                <button class="btn btn-white ajax-post" target-form="ids" hide-data="true" url="{:U("Article/paste")}">粘 贴</button>
                <input type="hidden" class="hide-data" name="cate_id" value="{$cate_id}"/>
                <input type="hidden" class="hide-data" name="pid" value="{$pid}"/>
                <button class="btn btn-white ajax-post confirm" target-form="ids" url="{:U("Article/setStatus",array("status"=>-1))}">删 除</button>
                <!-- <button class="btn document_add" url="{:U('article/batchOperate',array('cate_id'=>$cate_id,'pid'=>I('pid',0)))}">导入</button> -->
                <a class="btn btn-white list_sort" href="{:U('sort',array('cate_id'=>$cate_id,'pid'=>I('pid',0)),'')}">排序</a>
            </div>
            <div class="col-sm-12">
                <include file="Public/page"/>
            </div>
        </div>
    </div>
</div>

</block>
<block name="script">
<link href="__STATIC__/datetimepicker/css/dropdown.css" rel="stylesheet" type="text/css">
<link href="__STATIC__/datetimepicker/css/datetimepicker.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="__STATIC__/datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript" src="__STATIC__/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js" charset="UTF-8"></script>
<script type="text/javascript">
$(function(){

	/* 状态搜索子菜单 */
	$(".search-form").find(".drop-down").hover(function(){
		$("#sub-sch-menu").removeClass("hidden");
	},function(){
		$("#sub-sch-menu").addClass("hidden");
	});
	
	$("#sub-sch-menu li").find("a").each(function(){
		$(this).click(function(){
			var text = $(this).text();
			$("#sch-sort-txt").text(text).attr("data",$(this).attr("value"));
			$("#sub-sch-menu").addClass("hidden");
		})
	});

	//只有一个模型时，点击新增
	$('.document_add').click(function(){
		var url = $(this).attr('url');
		if(url != undefined && url != ''){
			window.location.href = url;
		}
	});

	//点击排序
	$('.list_sort').click(function(){
		var url = $(this).attr('url');
		var ids = $('.ids:checked');
		var param = '';
		if(ids.length > 0){
			var str = new Array();
			ids.each(function(){
				str.push($(this).val());
			});
			param = str.join(',');
		}

		if(url != undefined && url != ''){
			window.location.href = url + '/ids/' + param;
		}
	});

    //回车自动提交
    $('.search-form').find('input').keyup(function(event){
        if(event.keyCode===13){
            $("#search").click();
        }
    });

    $('#time-start').datetimepicker({
        format: 'yyyy-mm-dd',
        language:"zh-CN",
	    minView:2,
	    autoclose:true
    });

    $('#time-end').datetimepicker({
        format: 'yyyy-mm-dd',
        language:"zh-CN",
	    minView:2,
	    autoclose:true
    });
})
</script>
</block>

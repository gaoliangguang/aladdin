<extend name="Public/base" />

<block name="body">
	<div class="sort">
		<form action="{:U('sort')}" method="post">
			<div class="sort_center">
                
				<div class="sort_option">
					<select value="" size="8" class="width-100">
						<volist name="list" id="vo">
							<option class="ids" title="{$vo.title}" value="{$vo.id}">{$vo.title}</option>
						</volist>
					</select>
				</div>
			</div>
			<div class="hr hr16 hr-dotted"></div>
            <div class="sort_btn">
				<button class="top btn btn-primary" type="button"> <i class="icon-double-angle-left"> </i>第 一</button>
				<button class="up btn btn-info" type="button"> <i class="icon-angle-left"></i> 上 移</button>
				<button class="down btn btn-success" type="button">下 移 <i class="icon-angle-right"></i></button>
				<button class="bottom btn btn-purple" type="button">最 后 <i class="icon-double-angle-right"></i></button>
			</div>
			<div class="hr hr16 hr-dotted"></div>
			<div class="clearfix form-actions">
				<input type="hidden" name="ids">
                <div class="col-xs-12 center">
                  <button type="submit" class="sort_confirm btn submit-btn btn-success" id="sub-btn">
                      <i class="icon-ok bigger-110"></i> 确认保存
                  </button> 
                  <a onclick="history.go(-1)" class="btn btn-info" href="javascript:;">
                     <i class="icon-reply"></i>返回上一页
                  </a>	
                </div>
            </div>
		</form>
	</div>
</block>

<block name="script">
	<script type="text/javascript">
    	//导航高亮
    	highlight_subnav('{:U('config/index')}');
		$(function(){
			sort();
			$(".top").click(function(){
				rest();
				$("option:selected").prependTo("select");
				sort();
			})
			$(".bottom").click(function(){
				rest();
				$("option:selected").appendTo("select");
				sort();
			})
			$(".up").click(function(){
				rest();
				$("option:selected").after($("option:selected").prev());
				sort();
			})
			$(".down").click(function(){
				rest();
				$("option:selected").before($("option:selected").next());
				sort();
			})
			$(".search").click(function(){
				var v = $("input").val();
				$("option:contains("+v+")").attr('selected','selected');
			})
			function sort(){
				$('option').text(function(){return ($(this).index()+1)+'.'+$(this).text()});
			}

			//重置所有option文字。
			function rest(){
				$('option').text(function(){
					return $(this).text().split('.')[1]
				});
			}

			//获取排序并提交
			$('.sort_confirm').click(function(){
				var arr = new Array();
				$('.ids').each(function(){
					arr.push($(this).val());
				});
				$('input[name=ids]').val(arr.join(','));
				$.post(
					$('form').attr('action'),
					{
					'ids' :  arr.join(',')
					},
					function(data){
						if (data.status) {
	                        updateAlert(data.info + ' 页面即将自动跳转~','alert-success');
	                    }else{
	                        updateAlert(data.info,'alert-success');
	                    }
	                    setTimeout(function(){
	                        if (data.status) {
	                        	$('.sort_cancel').click();
	                        }
	                    },1500);
					},
					'json'
				);
			});
		})
	</script>
</block>
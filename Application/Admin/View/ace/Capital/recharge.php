<extend name="Public/base"/>
<block name="body">
<?php $status = ['CRT'=>'充值','OK#'=>'充值完成','FLS'=>'充值失败'];
?>
     <div class="table-responsive">
        <div class="dataTables_wrapper">  
            
            <div class="row">
                <div class="col-sm-12">
                    <form class="search-form">
                        <label>手机号码
                            <input type="text" class="search-input " name="mobilenum" value="{:I('mobilenum')}" placeholder="请输入手机号码">
                        </label>
                        <label>姓名
                            <input type="text" class="search-input" name="real_name" value="{:I('real_name')}" placeholder="请输入姓名">
                        </label>

                        <label>申请时间段
                            <input type="text" class="search-input day-input" name="sdate" value="{:I('edate')}" placeholder="选择开始时间">
                        </label>-
                        <label>
                            <input type="text" class="search-input day-input" name="edate" value="{:I('edate')}" placeholder="选择结束时间">
                        </label>
                        <label>用户昵称
                            <input type="text" class="search-input " name="nick_name" value="{:I('nick_name')}" placeholder="请输入用户昵称">
                        </label>
                        <label>
                            <button class="btn btn-sm btn-primary" type="button" id="search" url="{:U('recharge')}">
                               <i class="icon-search"></i>搜索
                            </button>
                        </label>
                    </form>  
                </div>
            </div>
            
            <form class="ids">
            <!-- 数据列表 -->
            <table class="table table-striped table-bordered table-hover dataTable">
                <thead>
                    <tr>
                        <th>用户姓名</th>
                        <th>充值现金额</th>
                        <th>充值时间</th>
                        <th>账户可用余额</th>
                        <th>状态</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
				<notempty name="_list">
                <volist name="_list" id="item">
                    <tr>
                        <td>{$item.real_name}({$item.nick_name}:{$item.mobile_num})</td>
                        <td>
                            {$item.amount|price_format}
                        </td>
                        <td>{$item.transport_time}</td>
                        <td>{$item.remaining_sum|price_format}</td>
                        <td><?php echo $status[$item['status']];?></td>
                        <td>
			<?php if ($item['status']== 'CRT'){?>
				<a title="核准" href="<?php echo U('rechargecheck?id='.$item['order_id'])?>">核准</a>
			<?php }?>
                        </td>
                    </tr>
                </volist>
				<else/>
				<td colspan="10" class="text-center"> aOh! 暂时还没有内容! </td>
				</notempty>
                </tbody>
            </table>
            </form>
            <include file="Public/page"/>
        </div>
    </div>
</block>

<block name="script">
<script src="__ACE__/js/date-time/bootstrap-datepicker.min.js"></script>
    <script type="text/javascript">
        $(function() {
            //搜索功能
            $("#search").click(function() {
                var url = $(this).attr('url');
                var query = $('.search-form').serialize();
                query = query.replace(/(&|^)(\w*?\d*?\-*?_*?)*?=?((?=&)|(?=$))/g, '');
                query = query.replace(/^&/g, '');
                if (url.indexOf('?') > 0) {
                    url += '&' + query;
                } else {
                    url += '?' + query;
                }
                window.location.href = url;
            });
            //回车搜索
	    $('input.day-input').datepicker({autoclose:true}).next().on(ace.click_event, function(){
			    $(this).prev().focus();
			    });
            $(".search-input").keyup(function(e) {
                if (e.keyCode === 13) {
                    $("#search").click();
                    return false;
                }
            });
        });
    </script>
</block>

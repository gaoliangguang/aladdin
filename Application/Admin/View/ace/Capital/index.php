<extend name="Public/base"/>

<block name="body">
<?php $status=['OK#'=>'正常','FLS'=>'禁用']?>
     <div class="table-responsive">
        <div class="dataTables_wrapper">  
            
            <div class="row">
                <div class="col-sm-12">
                    <form class="search-form">
                        <label>用户名
                            <input type="text" class="search-input" name="nick_name" value="{:I('nick_name')}" placeholder="请输入用户名">
                        </label>
                        <label>账户名ID
                            <input type="text" class="search-input" name="account_id" value="{:I('account_id')}" placeholder="请输入账户ID">
                        </label>
                        <label>状态
<select name="status">
<option value="">请选择</option>
<?php
foreach ($status as $k=>$v){
	$selected = $k==I('status')?'selected':'';
	echo '<option value="'.$k.'" '.$selected.' >'.$v."</option>";
}
?>
</select>
<label>
                            <button class="btn btn-sm btn-primary" type="button" id="search" url="{:U('index')}">
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
                        <th>用户名</th>
                        <th>账户ID</th>
                        <th>可用余额</th>
                        <th>冻结金额</th>
                        <th>状态</th>
                        <th>备注</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
				<notempty name="_list">
                <volist name="_list" id="item">
                    <tr>
                        <td>{$item.nick_name}</td>
                        <td>{$item.account_id}</td>
                        <td>{$item.remaining_sum|price_format}</td>
                        <td>{$item.frozen_sum|price_format}</td>
                        <td><?php echo $status[$item['status']];?></td>
                        <td>{$item.remark}</td>
                        <td>
                            <a title="查看交易明细" href="{:U('showitem?id='.$item['account_id'])}">查看交易明细</a>
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
            $(".search-input").keyup(function(e) {
                if (e.keyCode === 13) {
                    $("#search").click();
                    return false;
                }
            });
        });
    </script>
</block>

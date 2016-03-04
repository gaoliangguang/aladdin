<extend name="Public/base"/>
<block name="body">
<?php $status = ['CRT'=>'待审核','OK#'=>'审核通过','FLS'=>'审核不通过'];
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
                        <label>
                            <button class="btn btn-sm btn-primary" type="button" id="search-btn" url="{:U('information')}">
                               <i class="icon-search"></i>搜索
                            </button>
                        </label>
                    </form>  
                </div>
            </div>
            
            <!-- 数据列表 -->
            <table class="table table-striped table-bordered table-hover dataTable">
                <thead>
                    <tr>
                        <th>用户姓名</th>
                        <th>项目名称</th>
                        <th>申请时间</th>
                        <th>地区</th>
                        <th>工程阶段</th>
                        <th>工程类别</th>
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
                            {$item.object_name}
                        </td>
                        <td>{$item.insert_time}</td>
                        <td>{$item.district2}</td>
                        <td>{$item.phase}</td>
                        <td>{$item.object_type}</td>
                        <td><?php echo $status[$item['status']];?></td>
                        <td>
			                <?php if ($item['status']== 'CRT'){?>
                                <a title="核准" href="<?php echo U('check?id='.$item['id'])?>">核准</a>
                            <?php }else {?>
                                <a title="查看" href="<?php echo U('check?id='.$item['id'])?>">查看</a>
                            <?php }?>
                        </td>
                    </tr>
                </volist>
				<else/>
				<td colspan="10" class="text-center"> aOh! 暂时还没有内容! </td>
				</notempty>
                </tbody>
            </table>
            <div class="row">
                <div class="col-sm-4">
                </div>
                <div class="col-sm-8">
                    <include file="Public/page"/>
                </div>
            </div>
        </div>
    </div>
</block>
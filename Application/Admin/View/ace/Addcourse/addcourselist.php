<extend name="Public/base"/>

<block name="body">
    <!-- 标题栏 -->
    <!-- 数据列表 -->
    <div class="table-responsive">
        <div class="dataTables_wrapper">

            <?php if(I('order_id') == ''):?>
                <div class="row">
                    <form class="search-form">
                        <div class="col-sm-12">
                            <label>宝宝姓名
                                <input type="text" class="search-input" name="baby_name" value="<?=I('baby_name')?>">
                            </label>
                            <label>电话号码
                                <input type="text" class="search-input" name="mobile_num" value="<?=I('mobile_num')?>">
                            </label>
                            <label>订单号 &nbsp; &nbsp;
                                <input type="text" class="search-input" name="order_id" value="<?=I('order_id')?>">
                            </label>
                        </div>
                        <div class="col-sm-12">
                            <label>课程名称
                                <input type="text" class="search-input" name="course_name" value="<?=I('course_name')?>">
                            </label>
                            <label>学校名称
                                <input type="text" class="search-input" name="school_name" value="<?=I('school_name')?>">
                            </label>
                            <label>
                                <button class="btn btn-sm btn-primary" type="button" id="search-btn" url="<?=U('addcourselist')?>">
                                    <i class="icon-search"></i>搜索
                                </button>
                            </label>
                        </div>
                    </form>
                </div>
            <?php endif;?>
            <!-- 数据列表 -->
            <table class="table table-striped table-bordered table-hover dataTable">
                <thead>
                <tr>
                    <th class="hidden-480">订单号</th>
                    <th class="">宝宝姓名</th>
                    <th class="hidden-480">电话</th>
                    <th class="hidden-480">学校名称</th>
                    <th class="hidden-480">课程名称</th>                                                                                    </th>
                    <th class="">课程课时</th>
                    <th class="">购买费用</th>
                    <th class="">购买课时</th>
                    <th class="">赠送课时</th>
                    <th class="hidden-480">操作时间</th>
                    <th class="">操作</th>
                </tr>
                </thead>
                <tbody>
                <?php $today = date('Y-m-d');?>
                <notempty name="_list">
                    <volist name="_list" id="vo">
                        <tr>
                            <td class="hidden-480"><a href="<?=U('addcourselist',array('order_id'=>$vo['order_id']))?>"><?=$vo['order_id']?></a></td>
                            <td><?=$vo['baby_name']?></td>
                            <td class="hidden-480"><?=$vo['mobile_num']?></td>
                            <td class="hidden-480"><?=$vo['school_name']?></td>
                            <td class="hidden-480"><?=$vo['course_name']?></td>
                            <td><?=$vo['course_total']?></td>
                            <td><?=$vo['course_amount']/100?></td>
                            <td><?=$vo['course_count']?></td>
                            <td><?=$vo['given_count']?></td>
                            <td class="hidden-480"><?=$vo['insert_time']?></td>
                            <td>
						<div class="visible-md visible-lg hidden-sm hidden-xs action-buttons">
                                <a href="<?=U('edit',array('order_id'=>$vo['order_id']))?>">修改</a>
                                |
                                <a class="ajax-get confirm" href="<?=U('delete',array('order_id'=>$vo['order_id']))?>">删除</a>
                                |
                                <a href="<?=U('reject',array('order_id'=>$vo['order_id']))?>">退课</a>
				</div>
                            <div class="visible-xs visible-sm hidden-md hidden-lg">
                                <div class="inline position-relative">
                                    <button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown">
                                        <i class="icon-caret-down icon-only bigger-120"></i>
                                    </button>

                                    <ul class="dropdown-menu dropdown-only-icon dropdown-yellow pull-right dropdown-caret dropdown-close">
                                <li><a href="<?=U('edit',array('order_id'=>$vo['order_id']))?>">修改</a></li>
                                <li><a class="ajax-get confirm" href="<?=U('delete',array('order_id'=>$vo['order_id']))?>">删除</a></li>
                                <li><a href="<?=U('reject',array('order_id'=>$vo['order_id']))?>">退课</a></li>
				    </ul>
				    </div>
                            </td>
                        </tr>
                    </volist>
                    <else/>
                    <td colspan="9" class="text-center"> aOh! 暂时还没有内容! </td>
                </notempty>
                </tbody>
            </table>
            <include file="Public/page"/>
        </div>
    </div>
</block>

<block name="script">

    <script src="__STATIC__/thinkbox/jquery.thinkbox.js"></script>

    <script type="text/javascript">
        //导航高亮
        highlight_subnav('{:U('Addcourse/addcourselist')}');
    </script>
</block>

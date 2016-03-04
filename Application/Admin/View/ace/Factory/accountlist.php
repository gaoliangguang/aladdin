<extend name="Public/base"/>

<block name="body">
	
	 <!--列表 -->
	 <div class="table-responsive">
	    <div class="dataTables_wrapper">   
	        <div class="row">
	            <div class="col-sm-12 col-xs-12">
	                <form method="get" action="__SELF__" class="search-form">
                        <label>账号
                            <input type="text" class="search-input" name="accountId" value="{:I('accountId')}">
                        </label>
	                    <label>类型
                            <?php 
                               echo form_dropdown('accountType',array_values($accountTypeList),I('accountType'));
                            ?>
                        </label>
	                    <label>状态
                            <?php 
                               echo form_dropdown('status',array_values($status_list),I('status'));s
                            ?>
                        </label>
	                    <label>
	                        <button class="btn btn-sm btn-primary" type="button" id="search-btn" url="{:U('/factory/accountlist')}">
	                           <i class="icon-search"></i>搜索
	                        </button>
	                    </label>
	                </form>
	            </div>
	        </div>
	        <table class="table table-striped table-bordered table-hover dataTable">
	            <thead>
	                <tr>
	                    <th class="row-selected center" width="5%">
	                       <label>
	                           <input class="ace check-all" type="checkbox"/>
	                           <span class="lbl"></span>
	                       </label>
	                    </th>
				        <th class="">账号</th>
				        <th class="center">状态</th>
				        <th class="center">类型</th>
				        <th class="center">创建时间</th>
	               </tr>
	           </thead>
	           <tbody id="tbody_content">
				    <notempty name="_list">
				        <volist name="_list" id="vo">
				        <tr>
	                        <td class="center">
	                            <label>
	                                <input class="ace ids" type="checkbox" name="id[]" value="{$vo.accountid}" />
	                                <span class="lbl"></span>
	                            </label>
	                        </td>
				            <td>{$vo.accountid}</td>
				            <td class="center"><span>{$status_list[$vo['status']]}</span></td>
				            <td class="center">{$accountTypeList[$vo['accounttype']]}</td>
				            <td class="center"><span>{$vo.inserttime}</span></td>
				        </tr>
				        </volist>
				    <else/>
				    <td colspan="9" class="text-center"> aOh! 暂时还没有内容! </td>
				    </notempty>
	            </tbody>
	        </table>

            <div class="row">
                <div class="col-sm-4">
                    <div class="btn-group">
                        <button class="btn btn-white btn-sm dropdown-toggle" data-toggle="dropdown">
                            修改状态
                            <i class="icon-angle-down icon-on-right"></i>
                        </button>

                        <ul class="dropdown-menu">
                            <volist name="statusCcList" id="vo">
                                <li>
                                    <a href="{:U('changeStatus',array('method'=>$key))}" class="ajax-post" target-form="ids">{$vo}</a>
                                </li>
                            </volist>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-8">
                    <include file="Public/page"/>
                </div>
            </div>
	    </div>
	</div>
</block>
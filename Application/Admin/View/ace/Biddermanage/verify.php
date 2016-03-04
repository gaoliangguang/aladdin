<extend name="Public/base"/>

<block name="body">
    <div class="table-responsive">
        <div class="dataTables_wrapper">

            <div class="row">
                <div class="col-sm-12">
                    <form class="search-form">
                        <label>公司简称
                            <input type="text" class="search-input" name="short_name" value="{:I('short_name')}" placeholder="请输入公司简称">
                        </label>
                        <label>帐户昵称
                            <input type="text" class="search-input" name="nick_name" value="{:I('nick_name')}" placeholder="请输入账户昵称">
                        </label>
                        <label>
                            <button class="btn btn-sm btn-primary" type="button" id="search-btn" url="{:U('verify')}">
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
                    <th>投标人ID</th>
                    <th>公司全称</th>
                    <th>公司简称</th>
                    <th>帐户昵称</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                <notempty name="_list">
                    <volist name="_list" id="item">
                        <tr>
                            <td>{$item.id}</td>
                            <td>
                                {$item.company_name}
                            </td>
                            <td>{$item.short_name}</td>
                            <td>{$item.nick_name}</td>
                            <td>
                                <a title="审核" href="{:U('verifyshow?id='.$item['id'])}">审核</a>
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
<!-- 成员授权编辑页面 -->
<extend name="Public/base" />
<block name="body">
    <div class="tabbable">
        <ul class="nav nav-tabs padding-18">
            <li><a href="{:U('AuthManager/access',array('group_name'=>I('group_name') ,'group_id'=> I('group_id')))}">访问授权</a></li>
            <li><a href="{:U('AuthManager/category',array('group_name'=>I('group_name') ,'group_id'=> I('group_id')))}">分类授权</a></li>
            <li class="active"><a href="javascript:;">成员授权</a></li>
            <li class="dropdown">
                <a data-toggle="dropdown" class="dropdown-toggle" href="#">分组 &nbsp;
                    <i class="icon-caret-down bigger-110 width-auto"></i>
                </a>
                <ul class="dropdown-menu dropdown-info">
                    <volist name="auth_group" id="vo">
                        <li <eq name="vo['id']" value="$this_group['id']">class="active"</eq>>
                        <a data-toggle="tab" href="{:U('AuthManager/access',array('group_id'=>$vo['id'],'group_name'=>$vo['title']))}">{$vo.title}</a>
            </li>
            </volist>
        </ul>
        </li>
        </ul>
        <div class="tab-content no-border padding-24">
            <!-- 访问授权 -->
            <div class="tab-pane active">
                <table class="table table-striped table-bordered table-hover dataTable">
                    <thead>
                    <tr>
                        <th class="">UID</th>
                        <th class="">昵称</th>
                        <th class="">最后登录时间</th>
                        <th class="">最后登录IP</th>
                        <th class="">状态</th>
                        <th class="">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <volist name="_list" id="vo">
                        <tr>
                            <td>{$vo.uid} </td>
                            <td>{$vo.nickname}</td>
                            <td><span>{$vo.last_login_time|time_format}</span></td>
                            <td><span>{$vo.last_login_ip|long2ip}</span></td>
                            <td>{$vo.status_text}</td>
                            <td><a href="{:U('AuthManager/removeFromGroup?uid='.$vo['uid'].'&group_id='.I('group_id'))}" class="ajax-get">解除授权</a>

                            </td>
                        </tr>
                    </volist>
                    </tbody>
                </table>
                {$_page}
            </div>
            <hr>
            <div class="main-title">
                <div id="add-to-group" class="tools fr">
                    <form class="add-user" action="{:U('addToGroup')}" method="post" enctype="application/x-www-form-urlencoded" >
                        <input class="text input-4x" type="text" name="uid" placeholder="请输入uid,多个用英文逗号分隔">
                        <input type="hidden" name="group_id" value="{:I('group_id')}">
                        <button type="submit" class="btn btn-sm btn-white ajax-post" target-form="add-user">新 增</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</block>

<block name="script">
    <script type="text/javascript" charset="utf-8">

        $('.dropdown-menu a').click(function(){
            location.href = this.href;
            return false;
        });
        //导航高亮
        highlight_subnav('{:U('AuthManager/index')}');
    </script>
</block>

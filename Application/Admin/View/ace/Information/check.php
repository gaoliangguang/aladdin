<extend name="Public/base" />

<block name="body">
    <!-- 表单 -->

    <style>
        td{width:50%;}
        img{max-width:400px;}
    </style>
    <input type="hidden" name="id"  value="{$item.id}">
    <div class="widget-box" style="opacity: 1; z-index: 0;margin-bottom:1em;">
        <div class="widget-header" style="color:#999;">
            <h5 class="bigger lighter">项目信息</h5>
        </div>
        <div class="widget-body">
            <div class="">
                <table class="table  table-bordered " style="margin-bottom:0px;">
                    <tbody>
                    <tr>
                        <td><span style="color:#999;padding-right:8px;">项目名称:</span>{$item.object_name}</td>
                        <td><span style="color:#999;padding-right:8px;">用户昵称:</span>{$item.nick_name}</td>

                    </tr>
                    <tr>
                        <td><span style="color:#999;padding-right:8px;">造价:</span>{$item.object_amount|price_format}</td>
                        <td><span style="color:#999;padding-right:8px;">工期:</span>{$item.project_period}</td>
                    </tr>
                    <tr>
                        <td><span style="color:#999;padding-right:8px;">地区:</span>{$item.district}</td>
                        <td><span style="color:#999;padding-right:8px;">地址:</span>{$item.address}</td>
                    </tr>
                    <tr>
                        <td><span style="color:#999;padding-right:8px;">类别:</span>{$item.object_type}</td>
                        <td><span style="color:#999;padding-right:8px;">阶段:</span>{$item.phase}</td>
                    </tr>
                    <tr>
                        <td><span style="color:#999;padding-right:8px;">甲方:</span>{$item.employer}</td>
                        <td><span style="color:#999;padding-right:8px;">概况:</span>{$item.project_situation}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <form action="{:U('check')}" method="POST" class="form-horizontal" id="form_submit" role="form">
        <input type="hidden" value="{$item.id}" name="id">
        <div class="col-xs-12 center" style="margin-top:1em;">
            <input type="radio" name="status" value="OK#"> 发布&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="radio" name="status" value="FLS"> 下线
        </div>

        <div class="clearfix form-actions">
            <div class="col-xs-12 center" style="margin-top:1em;">
                <button id="sub-btn" class="btn btn-success ajax-post no-refresh" target-form="form-horizontal" type="submit">
                    <i class="icon-ok bigger-110"></i> 审核
                </button>
            </div>
        </div>
    </form>
</block>

<block name="script">
    <script type="text/javascript" charset="utf-8">
        Think.setValue('type',{$type|default=1});
    </script>
</block>

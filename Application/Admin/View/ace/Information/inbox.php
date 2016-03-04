<extend name="Public/base"/>
<block name="body">
<div class="message-container">
    <div id="id-message-list-navbar" class="message-navbar align-center clearfix">
        <div class="message-bar">
            <div class="message-infobar" id="id-message-infobar">
                <span class="blue bigger-150">通知列表</span>
                <span class="grey bigger-110">(<?=$unread_count?> 未读)</span>
            </div>

            <div class="message-toolbar hide">
                <div class="inline position-relative align-left">
                    <a href="#" class="btn-message btn btn-sm dropdown-toggle" data-toggle="dropdown">
                        <span class="bigger-110">操作</span>

                        <i class="icon-caret-down icon-on-right"></i>
                    </a>

                    <ul class="dropdown-menu dropdown-lighter dropdown-caret dropdown-125">

                        <li>
                            <a href="<?=U('setbox',['status'=>'1'])?>" class="ajax-post" target-form="ids">
                                <i class="icon-eye-open blue"></i>
                                &nbsp; 标记为已读
                            </a>
                        </li>

                        <li>
                            <a href="<?=U('setbox',['status'=>'0'])?>" class="ajax-post" target-form="ids">
                                <i class="icon-eye-close green"></i>
                                &nbsp; 标记为未读
                            </a>
                        </li>
                    </ul>
                </div>

                <a href="<?=U('setbox',['status'=>'2'])?>" class="btn btn-sm btn-message ajax-post confirm" target-form="ids">
                    <i class="icon-trash bigger-125"></i>
                    <span class="bigger-110">删除</span>
                </a>
            </div>
        </div>

        <div>

            <?php
            $type = [
                'TDR'=>'招标',
                'OTH'=>'其他',
            ];
            $class_list = [
                'TDR'=>'badge-success',
                'OTH'=>'badge-pink',
            ];
            ?>

            <form class="form-search" action="<?=U('inbox')?>" method="get" >
            <div class="messagebar-item-left">
                <label class="middle">
                    <input type="checkbox" id="id-toggle-all" class="ace" />
                    <span class="lbl"></span>
                </label>

                &nbsp;
                <div class="inline position-relative">
                    <a href="#" class="btn-message btn btn-sm dropdown-toggle" data-toggle="dropdown">
                        <span class="bigger-110">请选择类别</span>

                        <i class="icon-caret-down icon-on-right"></i>
                    </a>

                    <ul class="dropdown-menu dropdown-lighter dropdown-caret dropdown-125 drop-select">
                        <li>
                            <a href="javascript:" value="">
                                &nbsp; 全部
                            </a>
                        </li>
                        <?php foreach($type as $key=>$val):?>
                        <li>
                            <a href="javascript:" value="<?=$key?>">
                                &nbsp; <?=$val?>
                            </a>
                        </li>
                        <?php endforeach;?>
                    </ul>
                    <input type="hidden" name="type" value="<?=I('type')?>">
                </div>
                <div class="inline position-relative">
                    <a href="#" class="btn-message btn btn-sm dropdown-toggle" data-toggle="dropdown">
                        <span class="bigger-110">请选择状态</span>

                        <i class="icon-caret-down icon-on-right"></i>
                    </a>

                    <ul class="dropdown-menu dropdown-lighter dropdown-caret dropdown-125 drop-select">
                        <li>
                            <a href="javascript:" value="">
                                &nbsp; 全部
                            </a>
                        </li>
                        <li>
                            <a href="javascript:" value="YES">
                                &nbsp; 已读
                            </a>
                        </li>
                        <li>
                            <a href="javascript:" value="NO#">
                                &nbsp; 未读
                            </a>
                        </li>
                    </ul>
                    <input type="hidden" name="status" value="<?=I('status')?>">
                    <div class="nav-search minimized">
                        <span class="input-icon">
                            <input name="keyword" type="text" autocomplete="off" value="<?=I('keyword')?>" class="input-small nav-search-input" placeholder="搜索通知消息 ..." />
                            <i class="icon-search nav-search-icon"></i>
                        </span>
                    </div>
                </div>
            </div>

            </form>
        </div>
    </div>

    <div class="message-list-container">
        <div class="message-list" id="message-list">

            <?php foreach($list as $item):?>
            <div class="message-item <?=($item['status'] == 'NO#' ? 'message-unread' : '')?>">
                <label class="">
                    <input type="checkbox" class="ace ids" name="id[]" value="<?=$item['id']?>" />
                    <span class="lbl"></span>
                </label>
                <span class="">
                    <span class="badge <?=$class_list[$item['notice_type']]?> mail-tag">
                        <?=$type[$item['notice_type']]?>
                    </span>
                </span>
                <span class="sender">
                    <?=$item['mobile_num']?>
                </span>
                <span class="summary">
                    <span class="text" item_id="<?=$item['id']?>">
                        <?=$item['notice_title']?>
                    </span>
                </span>
                <span class="time"><?=$item['insert_time']?></span>
            </div>
            <?php endforeach;?>
        </div>
    </div><!-- /.message-list-container -->

    <div class="message-footer clearfix">
        <include file="Public/page"/>
    </div>

</div>
</block>
<block name="script">
<script>
    $(function(){
        $(".form-search").submit(function(){

            var url = this.action;
            var query  = $(this).serialize();
            if( url.indexOf('?')>0 ){
                url += '&' + query;
            }else{
                url += '?' + query;
            }
            window.location.href = url;
            return false;
        });
        $(".drop-select a").click(function(){
            $(this).closest('.drop-select').next('input[type=hidden]').val($(this).attr('value'));
            $(".form-search").submit();
        })

        //check/uncheck all messages
        $('#id-toggle-all').removeAttr('checked').on('click', function(){
            if(this.checked) {
                Inbox.select_all();
            } else Inbox.select_none();
        });



        $('.message-list').delegate('.message-item input[type=checkbox]' , 'click', function() {
            $(this).closest('.message-item').toggleClass('selected');
            if(this.checked)
                Inbox.display_bar(1);//display action toolbar when a message is selected
            else {
                Inbox.display_bar($('.message-list input[type=checkbox]:checked').length);
                //determine number of selected messages and display/hide action toolbar accordingly
            }
        });

        var Inbox = {
            //displays a toolbar according to the number of selected messages
            display_bar : function (count) {
                if(count == 0) {
                    $('#id-toggle-all').removeAttr('checked');
                    $('#id-message-list-navbar .message-toolbar').addClass('hide');
                    $('#id-message-list-navbar .message-infobar').removeClass('hide');
                }
                else {
                    $('#id-message-list-navbar .message-infobar').addClass('hide');
                    $('#id-message-list-navbar .message-toolbar').removeClass('hide');
                }
            }
            ,
            select_all : function() {
                var count = 0;
                $('.message-item input[type=checkbox]').each(function(){
                    this.checked = true;
                    $(this).closest('.message-item').addClass('selected');
                    count++;
                });

                $('#id-toggle-all').get(0).checked = true;

                Inbox.display_bar(count);
            }
            ,
            select_none : function() {
                $('.message-item input[type=checkbox]').removeAttr('checked').closest('.message-item').removeClass('selected');
                $('#id-toggle-all').get(0).checked = false;

                Inbox.display_bar(0);
            }
        };
        //display second message right inside the message list
        $('.message-list .message-item .text').on('click', function(){
            var item_id = $(this).attr('item_id');
            var message = $(this).closest('.message-item');

            //if message is open, then close it
            if(message.hasClass('message-inline-open')) {
                message.removeClass('message-inline-open').find('.message-content').hide();
                return;
            }
            if(message.data('opend')){

                message.addClass('message-inline-open').find('.message-content').show();
                return;
            }

            var loading = layer.load();
            $.post('<?=U('boxdetail')?>',{'id':item_id},function(html){
                if(message.hasClass('message-unread')){
                    message.removeClass('message-unread');
                }

                message
                    .data('opend',true)
                    .addClass('message-inline-open')
                    .append('<div class="message-content" />')
                message.find('.message-content:last').html( html );

            },'html').always(function(){
                layer.close(loading);
            });

        });
    })
</script>
</block>
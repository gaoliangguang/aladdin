// JavaScript Document
if (!(window.console && console.log)) {
  (function() {
    var noop = function() {};
    var methods = ['assert', 'clear', 'count', 'debug', 'dir', 'dirxml', 'error', 'exception', 'group', 'groupCollapsed', 'groupEnd', 'info', 'log', 'markTimeline', 'profile', 'profileEnd', 'markTimeline', 'table', 'time', 'timeEnd', 'timeStamp', 'trace', 'warn'];
    var length = methods.length;
    var console = window.console = {};
    while (length--) {
        console[methods[length]] = noop;
    }
  }());
}
//判断浏览器是否支持 placeholder属性  
function isPlaceholder(){  
    var input = document.createElement('input');  
    return 'placeholder' in input;  
}  
  
if (!isPlaceholder()) {//不支持placeholder 用jquery来完成  
    $(document).ready(function() {  
        if(!isPlaceholder()){  
            //对password框的特殊处理1.创建一个text框 2获取焦点和失去焦点的时候切换  
            var inputField    = $("input[type=text],input[type=password]");  
            inputField.each(function(){
            	var $this 	= $(this);
            	var place	= $this.attr('placeholder');
            	if(place != null){
            		var className = $this.attr('class') || '';
            		$this.after('<input class="'+className+'" type="text" value="'+place+'"/>');  
            		if($this.val() == ''){
            			$this.hide().next().show();
            		}else{
            			$this.next().hide();
            		}
            		
            		$this.next().focus(function(){  
            			$(this).hide().prev().show().focus();  
            		});  
            		
            		$this.blur(function(){  
            			if($this.val() == '') {  
            				$(this).hide().next().show();  
            			}  
            		});  
            	}
            });
              
        }  
    });  
      
}  

function sprintf()
{
    var arg = arguments,
        str = arg[0] || '',
        i, n;
    if(arg[1] != null && typeof(arg[1]) == 'object'){

    	$.each(arg[1],function(i,v){
            str = str.replace(/%s/, v);
    	});
    	
    	delete arg[1];
    }
    for (i = 1, n = arg.length; i < n; i++) {
        str = str.replace(/%s/, arg[i]);
    }
    return str;
}
window.updateAlert = function (text,c) {
    text = text||'default';
    c = c||false;
    if ( text!='default' ) {
        if(c == 'alert-success'){
                layer.msg(text,{icon:1});
        }else{
                layer.alert(text,{icon:2});
        }
    }
};

$(document).ready(function(){
    
	$("input:password,input.only-num-letter").keyup(function(){
		var $this = $(this);
		$this.val($this.val().replace(/[^\w\.\/]/ig,''));
	});
	$("input.mobile,input.only-num").keyup(function(){
		var $this = $(this);
		$this.val($this.val().replace(/\D/g,''));
	});
	
	//ajax get请求
    $('.ajax-get').click(function(){
        var target;
        var $this = $(this);
        if ( $this.hasClass('confirm') ) {
            layer.confirm('确认要执行该操作吗?',{icon:3},function(index){
                clean();
                layer.close(index);
            });
        }else{
            clean(); 
        }

        function clean(){
            if ( (target = $this.attr('href')) || (target = $this.attr('url')) ) {
                var loading = layer.load();
                $.get(target).success(function(data){
                    if (data.status==1) {
                        if (data.url) {
                            updateAlert(data.info + ' 页面即将自动跳转~','alert-success');
                        }else{
                            updateAlert(data.info,'alert-success');
                        }
                        setTimeout(function(){
                            $('#top-alert').find('button').click();
                            if (data.url && !$this.hasClass('no-refresh')) {
                                location.href=data.url;
                            }
                        },1500);
                    }else{
                        updateAlert(data.info,'alert-danger');
                        if($this.attr('type') == 'checkbox'){
                            $this.prop('checked',!$this.prop('checked'));
                        }
                        setTimeout(function(){
                            if (data.url) {
                                location.href=data.url;
                            }else{
                                $('#top-alert').find('button').click();
                            }
                        },1500);
                    }
                }).always(function () {
                    layer.close(loading);
                });

            }
        }
        if($this.attr('href') != null){
            return false;
        }
    });
var calculateFunctionValue = function (func, args, defaultValue) {
    if (typeof func === 'string') {
        // support obj.func1.func2
        var fs = func.split('.');

        if (fs.length > 1) {
            func = window;
            $.each(fs, function (i, f) {
                func = func[f];
            });
        } else {
            func = window[func];
        }
    }
    if (typeof func === 'function') {
        return func.apply(null, args);
    }
    return defaultValue;
};
    //ajax post submit请求
    $('.ajax-post').click(function(){
        var target,query,form;
        var target_form = $(this).attr('target-form');
        var that = this;
        var nead_confirm=false;
        if( ($(this).attr('type')=='submit') || (target = $(this).attr('href')) || (target = $(this).attr('url')) ){
            if(target_form.indexOf("#") == 0){
                form = $(target_form);
            }else{
                form = $('.'+target_form);
            }
            switch(true){
                case $(this).attr('hide-data') === 'true'://无数据时也可以使用的功能
                    form = $('.hide-data');
                    query = form.serialize();
                    break;
                case form.get(0)==undefined:
                    return false;
                    break;
                case form.get(0).nodeName=='FORM':
                    if($(this).attr('url') !== undefined){
                        target = $(this).attr('url');
                    }else{
                            target = form.get(0).action;
                    }
                    query = form.serialize();
                    if ( $(this).hasClass('confirm') ) {
                        layer.confirm('确认要执行该操作吗?',{icon:3},function(index){
                            do_post()
                            layer.close(index);
                        });
                    }
                    break;
                case form.get(0).nodeName=='INPUT' || form.get(0).nodeName=='SELECT' || form.get(0).nodeName=='TEXTAREA':

                    query = form.serialize();
                    if ( nead_confirm || $(this).hasClass('confirm') ) {
                        
                        layer.confirm('确认要执行该操作吗?',{icon:3},function(index){
                            do_post()
                            layer.close(index);
                        });
                    }
                    break;
                default:
                    query = form.find('input,select,textarea').serialize();
                    if ( $(this).hasClass('confirm') ) {
                        layer.confirm('确认要执行该操作吗?',{icon:3},function(index){
                            do_post()
                            layer.close(index);
                        });
                    }
            }
            
            function do_post(){

                $(that).addClass('disabled').attr('autocomplete','off').prop('disabled',true);
        var flag = calculateFunctionValue($(that).attr('before'),[that],'');
        if(typeof flag == 'boolean' && !flag){
		$(that).removeClass('disabled').prop('disabled',false);
            return false;
        }
                var loading = layer.load();
                $.post(target,query).success(function(data){
                    if (data.status==1) {
                        if (data.url) {
                            updateAlert(data.info + ' 页面即将自动跳转~','alert-success');
                        }else{
                            updateAlert(data.info ,'alert-success');
                        }
                        setTimeout(function(){
                            $(that).removeClass('disabled').prop('disabled',false);
                            if (data.url) {
                                location.href=data.url;
                            }else if( $(that).hasClass('no-refresh')){
                                $('#top-alert').find('button').click();
                            }else{
                                location.reload();
                            }
                        },1500);
                    }else{
                        updateAlert(data.info,'alert-danger');
                        setTimeout(function(){
                            $(that).removeClass('disabled').prop('disabled',false);
                            if (data.url) {
                                location.href=data.url;
                            }else{
                                $('#top-alert').find('button').click();
                            }
                        },1500);
                    }
                }).always(function () {
                    layer.close(loading);
                });
            }
            if(!nead_confirm && !$(this).hasClass('confirm')){
                do_post();
            }
        }
        return false;
    });
});


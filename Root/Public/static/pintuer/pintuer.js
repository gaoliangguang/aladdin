$(function(){
	$(".win-homepage").click(function(){ 
        if(document.all){
        document.body.style.behavior = 'url(#default#homepage)'; 
        document.body.setHomePage(document.URL); 
        }else{alert("设置首页失败，请手动设置！");} 
	});
	$(".win-favorite").click(function(){
		var sURL=document.URL; 
		var sTitle=document.title; 
		try {window.external.addFavorite(sURL, sTitle);} 
		catch(e){ 
			try{window.sidebar.addPanel(sTitle, sURL, "");} 
			catch(e){alert("加入收藏失败，请使用Ctrl+D进行添加");} 
		}
	});
	$(".win-forward").click(function(){
		window.history.forward(1);
	});
	$(".win-back").click(function(){
		window.history.back(-1);
	});
	$(".win-backtop").click(function(){$('body,html').animate({scrollTop:0},1000);return false;});
	$(".win-refresh").click(function(){
		window.location.reload();
	});
	$(".win-print").click(function(){
		window.print();
	});
	$(".win-close").click(function(){
		window.close();
	});
	$('.checkall').click(function(){
		var e=$(this);
		var name=e.attr("name");
		var checkfor=e.attr("checkfor");
		var type;
		if (checkfor!='' && checkfor!=null && checkfor!=undefined){
			type=e.closest('form').find("input[name='"+checkfor+"']");
		}else{
			type=e.closest('form').find("input[type='checkbox']");
		};
		if (name=="checkall"){
			$(type).each(function(index, element){
				element.checked=true;
			});
			e.attr("name","ok");
		}else{
			$(type).each(function(index, element){
				element.checked=false;
			});
			e.attr("name","checkall");
		}	
	});
	$('.dropdown-toggle').click(function(){
		$(this).closest('.button-group, .drop').addClass("open");
	});
	 $(document).bind("click",function(e){
		 if($(e.target).closest(".button-group.open, .drop.open").length == 0){
			 $(".button-group, .drop").removeClass("open");
		 }
	});
	$checkplaceholder=function(){
		var input = document.createElement('input');
		return 'placeholder' in input;
	};
	if(!$checkplaceholder()){
		$("textarea[placeholder], input[placeholder]").each(function(index, element){
			if($(element).attr("placeholder") || $emptyplaceholder(element)){
				$(element).val($(element).attr("placeholder"));
				$(element).data("pintuerholder",$(element).css("color"));
				$(element).css("color","rgb(169,169,169)");
				$(element).focus(function(){$hideplaceholder($(this));});
				$(element).blur(function(){$showplaceholder($(this));});
			}
		})
	};
	$emptyplaceholder=function(element){
		var $content=$(element).val();
		return ($content.length === 0) || $content == $(element).attr("placeholder");
	};
	$showplaceholder=function(element){
		//不为空及密码框
		if($emptyplaceholder(element) && $(element).attr("type")!="password"){
			$(element).val($(element).attr("placeholder"));
			$(element).data("pintuerholder",$(element).css("color"));
			$(element).css("color","rgb(169,169,169)");
		}
	};
	var $hideplaceholder=function(element){
		if($(element).data("pintuerholder")){
			$(element).val("");
			$(element).css("color", $(element).data("pintuerholder"));		
			$(element).removeData("pintuerholder");
		}
	};
	$('textarea, input, select').blur(function(){
		var e=$(this);
		if(e.attr("data-validate")){
			e.closest('.field').find(".input-help").remove();
			var $checkdata=e.attr("data-validate").split(',');
			var $checkvalue=e.val();
			var $checkstate=true;
			var $checktext="";
			if(e.attr("placeholder")==$checkvalue){$checkvalue="";}
			if($checkvalue!="" || e.attr("data-validate").indexOf("required")>=0){
				for(var i=0;i<$checkdata.length;i++){
					var $checktype=$checkdata[i].split(':');
					if(! $pintuercheck(e,$checktype[0],$checkvalue)){
						$checkstate=false;
						$checktext=$checktext+"<li>"+$checktype[1]+"</li>";
					}
				}
			};
			if($checkstate){
				e.closest('.form-group').removeClass("check-error");
				p.find(".input-help").remove();
				e.closest('.form-group').addClass("check-success");
			}else{
				e.closest('.form-group').removeClass("check-success");
				e.closest('.form-group').addClass("check-error");
				e.closest('.field').append('<div class="input-help"><ul>'+$checktext+'</ul></div>');
			}
		}
	});
	$pintuercheck=function(element,type,value){
		$pintu=value.replace(/(^\s*)|(\s*$)/g, "");
		switch(type){
			case "required":return /[^(^\s*)|(\s*$)]/.test($pintu);break;
			case "chinese":return /^[\u0391-\uFFE5]+$/.test($pintu);break;
			case "number":return /^\d+$/.test($pintu);break;
			case "integer":return /^[-\+]?\d+$/.test($pintu);break;
			case "plusinteger":return /^[+]?\d+$/.test($pintu);break;
			case "double":return /^[-\+]?\d+(\.\d+)?$/.test($pintu);break;
			case "plusdouble":return /^[+]?\d+(\.\d+)?$/.test($pintu);break;
			case "english":return /^[A-Za-z]+$/.test($pintu);break;
			case "username":return /^[a-z]\w{3,}$/i.test($pintu);break;
			case "mobile":return /^((\(\d{3}\))|(\d{3}\-))?13[0-9]\d{8}?$|15[89]\d{8}?$|170\d{8}?$|147\d{8}?$/.test($pintu);break;
			case "phone":return /^((\(\d{2,3}\))|(\d{3}\-))?(\(0\d{2,3}\)|0\d{2,3}-)?[1-9]\d{6,7}(\-\d{1,4})?$/.test($pintu);break;
			case "tel":return /^((\(\d{3}\))|(\d{3}\-))?13[0-9]\d{8}?$|15[89]\d{8}?$|170\d{8}?$|147\d{8}?$/.test($pintu) || /^((\(\d{2,3}\))|(\d{3}\-))?(\(0\d{2,3}\)|0\d{2,3}-)?[1-9]\d{6,7}(\-\d{1,4})?$/.test($pintu);break;
			case "email":return /^[^@]+@[^@]+\.[^@]+$/.test($pintu);break;
			case "url":return /^http:\/\/[A-Za-z0-9]+\.[A-Za-z0-9]+[\/=\?%\-&_~`@[\]\':+!]*([^<>\"\"])*$/.test($pintu);break;
			case "ip":return /^[\d\.]{7,15}$/.test($pintu);break;
			case "qq":return /^[1-9]\d{4,10}$/.test($pintu);break;
			case "currency":return /^\d+(\.\d+)?$/.test($pintu);break;
			case "zip":return /^[1-9]\d{5}$/.test($pintu);break;
			case "radio":
				var radio=element.closest('form').find('input[name="'+element.attr("name")+'"]:checked').length;
				return eval(radio==1);
				break;
			default:
				var $test=type.split('#');
				if($test.length>1){
					switch($test[0]){
						case "compare":
							return eval(Number($pintu)+$test[1]);
							break;
						case "regexp":
							return new RegExp($test[1],"gi").test($pintu);
							break;
						case "length":
							var $length;
							if(element.attr("type")=="checkbox"){
								$length=element.closest('form').find('input[name="'+element.attr("name")+'"]:checked').length;
							}else{
								$length=$pintu.replace(/[\u4e00-\u9fa5]/g,"***").length;
							}
							return eval($length+$test[1]);
							break;
						case "ajax":
							var $getdata;
							var $url=$test[1]+$pintu;
							$.ajaxSetup({async:false});
							$.getJSON($url,function(data){
								$getdata=data.getdata;
							});
							if($getdata=="true"){return true;}
							break;
						case "repeat":
							return $pintu==jQuery('input[name="'+$test[1]+'"]').eq(0).val();
							break;
						default:return true;break;
					}
					break;
				}else{
					return true;
				}
		}
	};
	$('form').submit(function(){
		$(this).find('input[data-validate],textarea[data-validate],select[data-validate]').trigger("blur");
		var numError = $(this).find('.check-error').length;
		if(numError){
			$(this).find('.check-error').first().find('input[data-validate],textarea[data-validate],select[data-validate]').first().focus().select();
			return false;
		}
	});
	$('.form-reset').click(function(){
		$(this).closest('form').find(".input-help").remove();
		$(this).closest('form').find('.form-submit').removeAttr('disabled');
		$(this).closest('form').find('.form-group').removeClass("check-error");
		$(this).closest('form').find('.form-group').removeClass("check-success");
	});
	$('.tab .tab-nav li').each(function(){
		var e=$(this);
		var trigger=e.closest('.tab').attr("data-toggle");
		if (trigger=="hover"){
			e.mouseover(function(){
				$showtabs(e);
			});
			e.click(function(){
				return false;
			});
		}else{
			e.click(function(){
				$showtabs(e);
				return false;
			});
		}
	});
	$showtabs=function(e){
		var detail=e.children("a").attr("href");
		e.closest('.tab .tab-nav').find("li").removeClass("active");
		e.closest('.tab').find(".tab-body .tab-panel").removeClass("active");
		e.addClass("active");
		$(detail).addClass("active");
	};
	$('.dialogs').each(function(){
		var e=$(this);
		var trigger=e.attr("data-toggle");
		if (trigger=="hover"){
			e.mouseover(function(){
				$showdialogs(e);
			});
		}else if(trigger=="click"){
			e.click(function(){
				$showdialogs(e);
			});
		}
	});
	$showdialogs=function(e){
		var trigger=e.attr("data-toggle");
		var getid=e.attr("data-target");
		var data=e.attr("data-url");
		var mask=e.attr("data-mask");
		var width=e.attr("data-width");
		var detail="";
		var masklayout=$('<div class="dialog-mask"></div>');
		if(width==null){width="80%";}
		
		if (mask=="1"){
			$("body").append(masklayout);
		}
		detail='<div class="dialog-win" style="position:fixed;width:'+width+';z-index:11;">';
		if(getid!=null){detail=detail+$(getid).html();}
		if(data!=null){detail=detail+$.ajax({url:data,async:false}).responseText;}
		detail=detail+'</div>';
		
		var win=$(detail);
		win.find(".dialog").addClass("open");
		$("body").append(win);
		var x=parseInt($(window).width()-win.outerWidth())/2;
		var y=parseInt($(window).height()-win.outerHeight())/2;
		if (y<=10){y="10"}
		win.css({"left":x,"top":y});
		win.find(".dialog-close,.close").each(function(){
			$(this).click(function(){
				win.remove();
				$('.dialog-mask').remove();
			});
		});
		masklayout.click(function(){
			win.remove();
			$(this).remove();
		});
	};
	
	$('.tips').each(function(i){
		var e=$(this);
		e.data('index',i)
		var p = e.parent();
		var title=e.attr("title");
		var trigger=e.attr("data-toggle");
		e.attr("title","");
		
		if (trigger=="" || trigger==null){trigger="click";}
		if (trigger=="hover"){
			e.mouseover(function(){
				$showtips(e,title);
			});
		}else if(trigger=="click"){
			e.click(function(){
				if($(".index"+i).length > 0){
					p.removeClass('active');
					$("#tip_one").remove();
					return false;
				}else{
					$('.xbico').not(p).removeClass('active');
					$("#tip_one").remove();
				}
				
				$showtips(e,title);
			});
		}else if(trigger=="show"){
			e.ready(function(){
				$showtips(e,title);
			});
		}
	});
	
	$showtips=function(e,title){

		var trigger=e.attr("data-toggle");
		var place=e.attr("data-place");
		var width=e.attr("data-width");
		var css=e.attr("data-style");
		var image=e.attr("data-image");
		var content=e.attr("content");
		var getid=e.attr("data-target");
		var data=e.attr("data-url");
		var x=0;
		var y=0;
		var html="";
		var detail="";
		var class_fix = e.attr('class_fix') || '';
		if(image!=null){detail=detail+'<img class="image" src="'+image+'" />';}
		if(content!=null){detail=detail+'<p class="tip-body">'+content+'</p>';}
		if(getid!=null){detail=detail+$(getid).html();}
		if(data!=null){detail=detail+$.ajax({url:data,async:false}).responseText;}
		if(title!=null && title!=""){
			if(detail!=null && detail!=""){detail='<p class="tip-title"><strong>'+title+'</strong></p>'+detail;}else{detail='<p class="tip-line">'+title+'</p>';}
		}
		detail='<div class="'+class_fix+'tip index'+e.data('index')+'" id="tip_one">'+detail+'</div>';
		html=$(detail);

		$("body").append( html );
		$("body").append('<div class="tips-mask"></div>')
		if(width!=null){
			html.css("width",width);
		}
		if(place=="" || place==null){place="right";}
		if(place=="left"){
			x=e.offset().left - html.outerWidth()-5;
			y=e.offset().top - html.outerHeight()/2 + e.outerHeight()/2;
		}else if(place=="top"){
			x=e.offset().left - html.outerWidth()/2 + e.outerWidth()/2;
			y=e.offset().top - html.outerHeight()-5;
		}else if(place=="right"){
			x=e.offset().left + e.outerWidth()-20;
			y=e.offset().top - html.outerHeight()/2 + e.outerHeight()/2 + 60;
		}else if(place=="bottom"){
			x=e.offset().left - html.outerWidth()/2 + e.outerWidth()/2 + 100;
			y=e.offset().top + e.outerHeight()+5;
		}
		html.css({"left":x+"px","top":y+"px","position":"absolute",'z-index':10});
		if (css!=""){html.addClass(css);}
		if (trigger=="hover"){
			e.mouseout(function(){html.remove();e.attr("title",title)});
		}
	};
	
	$('.alert .close').each(function(){
		$(this).click(function(){
			$(this).closest('.alert').remove();
		});
	});
	$('.radio label').each(function(){
		var e=$(this);
		e.click(function(){
			e.closest('.radio').find("label").removeClass("active");
			e.addClass("active");
		});
	});
	$('.checkbox label').each(function(){
		var e=$(this);
		e.click(function(){
			if(e.find('input').is(':checked')){
				e.addClass("active");
			}else{
				e.removeClass("active");
			};
		});
	});
	$('.find-share .panel-head').click(function(){
		var e=$(this);
		var next = e.next(".panel-body");
		var p = e.parent('.panel ');
		
		next.slideToggle(500,function(){
			e.closest('.collapse').find('.panel').removeClass('active');
			p.addClass('active');
		})
		// 修改数字控制速度， slideUp(500)控制卷起速度
		e.closest('.collapse').find(".panel-body").not(next).slideUp(500);
	});
	
	$('.faq .panel-head').click(function(){
		var e=$(this);
		var next = e.next(".panel-body");
		var p = e.parent('.panel ');
		if(next.is(":visible")){
			next.hide();
			p.removeClass('active');
			return false;
		}else{
			next.show();
		}
		e.closest('.collapse').find('.panel').removeClass('active');
		p.addClass('active');
		// 修改数字控制速度， slideUp(500)控制卷起速度
		e.closest('.collapse').find(".panel-body").not(next).hide();
	});
	
	$('.icon-navicon').each(function(){
		var e=$(this);
		var target=e.attr("data-target");
		e.click(function(){
			$(target).toggleClass("nav-navicon");
		});
	});
	$(".spy a").each(function(){
		var e=$(this);
		var t=e.closest(".spy");
		var target=t.attr("data-target");
		var top=t.attr("data-offset-spy");
		var thistarget="";
		var thistop="";
		if(top==null){top=0;};
		if(target==null){thistarget=$(window);}else{thistarget=$(target);};
		
		thistarget.bind("scroll",function(){
			if(target==null){
				thistop=$(e.attr("href")).offset().top - $(window).scrollTop() - parseInt(top);	
			}else{
				thistop=$(e.attr("href")).offset().top - thistarget.offset().top - parseInt(top);
			};
	
			if(thistop<0){
				t.find('li').removeClass("active");
				e.parents('li').addClass("active");
			};

		});
	});
	$(".fixed").each(function(){
		var e=$(this);
		var style=e.attr("data-style");
		var top=e.attr("data-offset-fixed");
		if(top==null){top=e.offset().top;}else{top=e.offset().top - parseInt(top);};
		if(style==null){style="fixed-top";};
		
		$(window).bind("scroll",function(){
			var thistop=top - $(window).scrollTop();
			if(style=="fixed-top" && thistop<0){
				e.find('.x4').addClass('padding-15-top');
				$(".header").addClass("header-no-border");
				$("#go-to-store").show();
			}else{
				e.find('.x4').removeClass('padding-15-top');
				$(".header").removeClass("header-no-border");
				$("#go-to-store").hide();
			};
			
			var thisbottom=top - $(window).scrollTop()-$(window).height();
			if(style=="fixed-bottom" && thisbottom>0){
				e.addClass("fixed-bottom");
			}else{
				e.removeClass("fixed-bottom");
			};
		});

	});
	$(document).on('click','.tips-mask',function(){

		$("#tip_one,.tips-mask").remove();
		$(".xbico").removeClass('active');
	})
})
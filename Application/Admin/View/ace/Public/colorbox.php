<link rel="stylesheet" href="__ACE__/css/colorbox.css" />
<script src="__ACE__/js/jquery.colorbox-min.js"></script>
<script>
    $(function () {
        var colorbox_params = {
            reposition:true,
            scalePhotos:true,
            scrolling:false,
            previous:'<i class="icon-arrow-left"></i>',
            next:'<i class="icon-arrow-right"></i>',
            close:'<i class="glyphicon glyphicon-remove-circle bigger-160"></i>',
            current:'{current} of {total}',
            maxWidth:'100%',
            maxHeight:'100%',
            onOpen:function(){
                document.body.style.overflow = 'hidden';
            },
            onClosed:function(){
                document.body.style.overflow = 'auto';
            },
            onComplete:function(){
                $.colorbox.resize();
            }
        };

        $('.ace-thumbnails').colorbox(colorbox_params);
    })
</script>
<?php if (!defined('THINK_PATH')) exit(); $selector = ''; if(!empty($addons_data['id'])){ $selector = 'textarea#'.$addons_data['id']; $addons_data['name'] = $addons_data['id']; }else{ $selector = 'textarea[name="'.$addons_data['name'].'"]'; } ?>
<?php switch($addons_config["editor_type"]): case "1": ?>
		<input type="hidden" name="parse" value="0">
		<script type="text/javascript">
			$('<?php echo $selector?>').height('<?php echo ($addons_config["editor_height"]); ?>');
		</script><?php break;?>
	<?php case "2": ?>
		<input type="hidden" name="parse" value="0">
		<?php if(($addons_config["editor_wysiwyg"]) == "1"): ?><link rel="stylesheet" href="/aladdin/root/Public/static/kindeditor/default/default.css" />
			<script charset="utf-8" src="/aladdin/root/Public/static/kindeditor/kindeditor-min.js"></script>
			<script charset="utf-8" src="/aladdin/root/Public/static/kindeditor/zh_CN.js"></script>
			<script type="text/javascript">
				var editor_<?php echo $addons_data['name'];?>;
				KindEditor.ready(function(K) {
					editor_<?php echo ($addons_data["name"]); ?> = K.create('<?php echo $selector?>', {
						allowFileManager : true,
						//allowPreviewEmoticons : true,
						themesPath: K.basePath,
						width: '100%',
						height: '<?php echo ($addons_config["editor_height"]); ?>',
						resizeType: <?php if(($addons_config["editor_resize_type"]) == "1"): ?>1<?php else: ?>0<?php endif; ?>,
						pasteType : 2,
						urlType : 'domain',
						fileManagerJson : '<?php echo addons_url("EditorForAdmin://Upload/editorfilemanager");?>',
						filterMode : false, //不会过滤HTML代码
						//uploadJson : '<?php echo U('uploadJson');?>' }
						uploadJson : '<?php echo addons_url("EditorForAdmin://Upload/ke_upimg");?>',
						extraFileUploadParams: {
							session_id : '<?php echo session_id();?>'
	                    }
					});
				});

				$(function(){
					//传统表单提交同步
					$('<?php echo $selector?>').closest('form').submit(function(){
						editor_<?php echo ($addons_data["name"]); ?>.sync();
					});
					//ajax提交之前同步
					$('button[type="submit"],#submit,.ajax-post,#autoSave').click(function(){
						editor_<?php echo ($addons_data["name"]); ?>.sync();
					});
				})
			</script>

		<?php else: ?>
			<script type="text/javascript" charset="utf-8" src="/aladdin/root/Public/static/ueditor/ueditor.config.js"></script>
			<script type="text/javascript" charset="utf-8" src="/aladdin/root/Public/static/ueditor/ueditor.all.js"></script>
			<script type="text/javascript" charset="utf-8" src="/aladdin/root/Public/static/ueditor/lang/zh-cn/zh-cn.js"></script>
			<script type="text/javascript">
				$('<?php echo $selector?>').attr('id', 'editor_id_<?php echo ($addons_data["name"]); ?>');
				window.UEDITOR_HOME_URL = "/aladdin/root/Public/static/ueditor";
				window.UEDITOR_CONFIG.initialFrameHeight = parseInt('<?php echo ($addons_config["editor_height"]); ?>');
				window.UEDITOR_CONFIG.scaleEnabled = <?php if(($addons_config["editor_resize_type"]) == "1"): ?>true<?php else: ?>false<?php endif; ?>;
				window.UEDITOR_CONFIG.imageUrl = '<?php echo addons_url("EditorForAdmin://Upload/ue_upimg");?>';
				window.UEDITOR_CONFIG.imagePath = '';
				window.UEDITOR_CONFIG.imageFieldName = 'imgFile';
				UE.getEditor('editor_id_<?php echo ($addons_data["name"]); ?>');
			</script><?php endif; break;?>
	<?php case "3": ?>
		<script type="text/javascript" src="/aladdin/root/Public/static/jquery-migrate-1.2.1.min.js"></script>
		<script charset="utf-8" src="/aladdin/root/Public/static/xheditor/xheditor-1.2.1.min.js"></script>
		<script charset="utf-8" src="/aladdin/root/Public/static/xheditor/xheditor_lang/zh-cn.js"></script>
		<script type="text/javascript" src="/aladdin/root/Public/static/xheditor/xheditor_plugins/ubb.js"></script>
		<script type="text/javascript">
		var submitForm = function (){
			$('<?php echo $selector?>').closest('form').submit();
		}
		$('<?php echo $selector?>').attr('id', 'editor_id_<?php echo ($addons_data["name"]); ?>')
		$('#editor_id_<?php echo ($addons_data["name"]); ?>').xheditor({
			tools:'full',
			showBlocktag:false,
			forcePtag:false,
			beforeSetSource:ubb2html,
			beforeGetSource:html2ubb,
			shortcuts:{'ctrl+enter':submitForm},
			'height':'<?php echo ($addons_config["editor_height"]); ?>',
			'width' :'100%'
		});
		</script>
		<input type="hidden" name="parse" value="1"><?php break;?>
	<?php case "4": ?>
		<link rel="stylesheet" href="/aladdin/root/Public/static/thinkeditor/skin/default/style.css">
		<script type="text/javascript" src="/aladdin/root/Public/static/jquery-migrate-1.2.1.min.js"></script>
		<script type="text/javascript" src="/aladdin/root/Public/static/thinkeditor/jquery.thinkeditor.js"></script>
		<script type="text/javascript">
			$(function(){
				$('<?php echo $selector?>').attr('id', 'editor_id_<?php echo ($addons_data["name"]); ?>');
				var options = {
					"items"  : "h1,h2,h3,h4,h5,h6,-,link,image,-,bold,italic,code,-,ul,ol,blockquote,hr,-,fullscreen",
			        "width"  : "100%", //宽度
			        "height" : "<?php echo ($addons_config["editor_height"]); ?>", //高度
			        "lang"   : "zh-cn", //语言
			        "tab"    : "    ", //Tab键插入的字符， 默认为四个空格
					"uploader": "<?php echo addons_url('Editor://Upload/upload');?>"
			    };
			    $('#editor_id_<?php echo ($addons_data["name"]); ?>').thinkeditor(options);
			})
		</script>
		<input type="hidden" name="parse" value="2"><?php break; endswitch;?>
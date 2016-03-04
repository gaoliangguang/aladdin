<div class="col-sm-{$addons_config.width}">
    <div class="widget-box transparent">
        <div class="widget-header widget-header-flat">
			<h4 class="lighter">
			    <i class="icon-exclamation-sign orange"></i>{$addons_config.title}
		    </h4>
        </div>
	    <div class="widget-body">
            <div class="comments" style="width: auto;">
                <div class="itemdiv commentdiv">
                    <div class="user">
                        <i class="icon-map-marker blue bigger-300"></i>
                    </div>
                    <div class="body">
                        <div class="name blue">定位</div>
                        <div class="text">
                            <i class="icon-quote-left"></i>后台管理门户
                        </div>
                    </div>
                </div>
                <div class="itemdiv commentdiv">
                    <div class="user">
                        <i class="icon-user pink2 bigger-300"></i>
                    </div>
                    <div class="body">
                        <div class="name blue">适用人员</div>
                        <div class="text">
                            <i class="icon-quote-left"></i>运营、财务、运维
                        </div>
                    </div>
                </div>
                <div class="itemdiv commentdiv">
                    <div class="user">
                        <i class="icon-cogs green bigger-300"></i>
                    </div>
                    <div class="body">
                        <div class="name blue">服务器操作系统</div>
                        <div class="text">
                            <i class="icon-quote-left"></i>{$Think.const.PHP_OS}
                        </div>
                    </div>
                </div>
                <div class="itemdiv commentdiv">
                    <div class="user">
                        <i class="icon-cog orange2 bigger-300"></i>
                    </div>
                    <div class="body">
                        <div class="name blue">运行环境</div>
                        <div class="text">
                            <i class="icon-quote-left"></i>{$_SERVER['SERVER_SOFTWARE']}
                        </div>
                    </div>
                </div>
                <div class="itemdiv commentdiv">
                    <div class="user">
                        <i class="icon-hdd brown bigger-300"></i>
                    </div>
                    <div class="body">
                        <div class="name blue">MYSQL版本</div>
                        <div class="text">
                            <i class="icon-quote-left"></i>
                            <?php
                            
    							$system_info_mysql = M()->query("select version() as v;");
        						echo $system_info_mysql[0]['v'];
                            ?>
                        </div>
                    </div>
                </div>
                <div class="itemdiv commentdiv">
                    <div class="user">
                        <i class="icon-cloud-upload purple bigger-300"></i>
                    </div>
                    <div class="body">
                        <div class="name blue">上传限制</div>
                        <div class="text">
                            <i class="icon-quote-left"></i>
    						{:ini_get('upload_max_filesize')}
                        </div>
                    </div>
                </div>
            </div>
	    </div>
    </div>
</div>
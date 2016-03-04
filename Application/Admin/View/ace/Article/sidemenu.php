<div class="sidebar" id="sidebar">
    <script type="text/javascript">
        try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
    </script>

    <ul class="nav nav-list">
        <notempty name="_extra_menu">
            {// 动态扩展菜单 //}
            {:extra_menu($_extra_menu,$__MENU__)}
        </notempty>
        <volist name="__MENU__.main" id="menu">
            
            <li class="<?php if($menu['id'] == 2) :?>active open<?php endif;?>" id="menu-{$menu.id}">
                <a <notempty name="menu.child">class="dropdown-toggle" href="javascript:"<else />href="{$menu.url|U}"</notempty>>
                    <i class="{$menu.class_fix}"></i>
                    <span class="menu-text">{$menu.title}</span>
                    <notempty name="menu.child">
                    <b class="arrow icon-angle-down"></b>
                    </notempty>
                </a>
                <notempty name="menu.child">
                <ul class="submenu">
                    <foreach name="menu.child" item="sub_menu">
                    <!-- 子导航 -->
                    <notempty name="sub_menu">
                    <li>
                        <a href="{$sub_menu.url|U}">
                        <i class="icon-double-angle-right"></i>
                        {$sub_menu.title}
                        </a>
                    </li>
                    </notempty>
                    <!-- /子导航 -->
                    </foreach>
                </ul>
                </notempty>
            </li>
        </volist>
        <volist name="nodes" id="sub_menu">
            <!-- 子导航 -->
            <notempty name="sub_menu">
                <li class="<eq name="sub_menu['current']" value="1">active open</eq>">
                    <a <notempty name="sub_menu._child">class="dropdown-toggle" href="javascript:"<else />href="{$sub_menu.url|U}"</notempty>>
                        <i class="{$sub_menu.groups}"></i>
                        <span class="menu-text">{$sub_menu.title}</span>
                        <notempty name="sub_menu._child">
                        <b class="arrow icon-angle-down"></b>
                        </notempty>
                    </a>
                
                    <ul class="submenu <neq name='sub_menu["current"]' value="1">open</neq>">
                        <volist name="sub_menu['_child']" id="menu">
                            <li <if condition="$menu['id'] eq $cate_id or $menu['current'] eq 1">class="active"</if>>
                                <gt name="menu['allow_publish']" value="0">
                                <a class="item" href="{$menu.url|U}"><i class="icon-double-angle-right"></i>{$menu.title}</a>
                                <else/>
                                <a class="item" href="javascript:void(0);"><i class="icon-double-angle-right"></i>{$menu.title}</a>
                                </gt>
        
                                <!-- 一级子菜单 -->
                                <present name="menu['_child']">
                                <ul class="submenu" style="display: block;">
                                	<foreach name="menu['_child']" item="three_menu">
                                    <li>
                                        <gt name="three_menu['allow_publish']" value="0"><a class="item" href="{$three_menu.url|U}">{$three_menu.title}</a><else/><a class="item" href="javascript:void(0);">{$three_menu.title}</a></gt>
                                        <!-- 二级子菜单 -->
                                        <present name="three_menu['_child']">
                                        <ul class="submenu" style="display: block;">
                                        	<foreach name="three_menu['_child']" item="four_menu">
                                            <li>
                                                <gt name="four_menu['allow_publish']" value="0"><a class="item" href="{:U('index','cate_id='.$four_menu['id'])}">{$four_menu.title}</a><else/><a class="item" href="javascript:void(0);">{$four_menu.title}</a></gt>
                                                <!-- 三级子菜单 -->
                                                <present name="four_menu['_child']">
                                                <ul class="submenu" style="display: block;">
                                                	<volist name="four_menu['_child']" id="five_menu">
                                                    <li>
                                                    	<gt name="five_menu['allow_publish']" value="0"><a class="item" href="{:U('index','cate_id='.$five_menu['id'])}">{$five_menu.title}</a><else/><a class="item" href="javascript:void(0);">{$five_menu.title}</a></gt>
                                                    </li>
                                                    </volist>
                                                </ul>
                                                </present>
                                                <!-- end 三级子菜单 -->
                                            </li>
                                             </foreach>
                                        </ul>
                                        </present>
                                        <!-- end 二级子菜单 -->
                                    </li>
                                    </foreach>
                                </ul>
                                </present>
                                <!-- end 一级子菜单 -->
                            </li>
                        </volist>
                    </ul>
                </li>
            </notempty>
            <!-- /子导航 -->
        </volist>
        <!-- 回收站 -->
    	<eq name="show_recycle" value="1">
        <li>
            <a href="{:U('article/recycle')}">
                <i class="icon-trash"></i>
                <span class="menu-text">回收站</span>
            </a>
        </li>
        </eq>
    </ul><!-- /.nav-list -->

    <div class="sidebar-collapse" id="sidebar-collapse">
        <i class="icon-double-angle-left" data-icon1="icon-double-angle-left" data-icon2="icon-double-angle-right"></i>
    </div>

    <script type="text/javascript">
        try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
    </script>
</div>
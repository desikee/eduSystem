<!-- 左侧菜单栏 -->
<div id="m_ver_menu" class="m-aside-menu  m-aside-menu--skin-dark m-aside-menu--submenu-skin-blue "
     data-menu-vertical="true" data-menu-scrollable="false" data-menu-dropdown-timeout="500">
    <ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow ">

        <li class="m-menu__item  m-menu__item--active" aria-haspopup="true">
            <a href="#" class="m-menu__link ">
                <i class="m-menu__link-icon flaticon-line-graph"></i>
                <span class="m-menu__link-title">
                    <span class="m-menu__link-wrap">
                        <span class="m-menu__link-text">
                            功能列表
                        </span>

                    </span>
                </span>
            </a>
        </li>

        <li class="m-menu__section">
            <h4 class="m-menu__section-text">
            功能组件
            </h4>
            <i class="m-menu__section-icon flaticon-more-v3"></i>
        </li>
        @if( Admin::user()->status === 3)
        <li class="m-menu__item  m-menu__item--submenu m-menu__item--open m-menu__item--expanded"
            aria-haspopup="true" data-menu-submenu-toggle="hover">
            <a href="#" class="m-menu__link m-menu__toggle">
                <i class="m-menu__link-icon flaticon-tabs">
                </i>
                <span class="m-menu__link-text">
                    学员管理
                </span>
                <i class="m-menu__ver-arrow la la-angle-right">
                </i>
            </a>
            <div class="m-menu__submenu">
                <span class="m-menu__arrow">
                </span>
                <ul class="m-menu__subnav">
                    <li class="m-menu__item" aria-haspopup="true">
                        <a href="/admin/student/progress/index" class="m-menu__link ">
                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                <span>
                                </span>
                            </i>
                            <span class="m-menu__link-text">
                                当前学员
                            </span>
                        </a>
                    </li>
                    <li class="m-menu__item" aria-haspopup="true">
                        <a href="/admin/student/complete/index" class="m-menu__link ">
                            <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
                            <span class="m-menu__link-text">
                                结项学员
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>
        @endif
        @if(Admin::user()->status === 0)
        <li class="m-menu__item  m-menu__item--submenu m-menu__item--open m-menu__item--expanded"
            aria-haspopup="true" data-menu-submenu-toggle="hover">
            <a href="#" class="m-menu__link m-menu__toggle">
                <i class="m-menu__link-icon flaticon-list-3">
                </i>
                <span class="m-menu__link-text">
                    课题管理
                </span>
                <i class="m-menu__ver-arrow la la-angle-right">
                </i>
            </a>
            <div class="m-menu__submenu">
                <span class="m-menu__arrow">
                </span>
                <ul class="m-menu__subnav">
                    <li class="m-menu__item" aria-haspopup="true">
                        <a href="/admin/course/index" class="m-menu__link ">
                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                <span>
                                </span>
                            </i>
                            <span class="m-menu__link-text">
                                课题列表
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>
        @endif
        @if(Admin::user()->status === 7)
        <li class="m-menu__item  m-menu__item--submenu m-menu__item--open m-menu__item--expanded"
            aria-haspopup="true" data-menu-submenu-toggle="hover">
            <a href="#" class="m-menu__link m-menu__toggle">
                <i class="m-menu__link-icon flaticon-settings">
                </i>
                <span class="m-menu__link-text">
                    系统管理
                </span>
                <i class="m-menu__ver-arrow la la-angle-right">
                </i>
            </a>
            <div class="m-menu__submenu">
                <span class="m-menu__arrow">
                </span>
                <ul class="m-menu__subnav">
                    <li class="m-menu__item" aria-haspopup="true">
                        <a href="/admin/system/user/index" class="m-menu__link ">
                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                <span>
                                </span>
                            </i>
                            <span class="m-menu__link-text">
                                用户管理
                            </span>
                        </a>
                    </li>
                    <li class="m-menu__item" aria-haspopup="true">
                        <a href="/admin/system/subject/index" class="m-menu__link ">
                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                <span>
                                </span>
                            </i>
                            <span class="m-menu__link-text">
                                新增项目
                            </span>
                        </a>
                    </li>
                    <li class="m-menu__item" aria-haspopup="true">
                        <a href="/admin/system/subject/update" class="m-menu__link ">
                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                <span>
                                </span>
                            </i>
                            <span class="m-menu__link-text">
                                更新项目
                            </span>
                        </a>
                    </li>
                    <!--
                    <li class="m-menu__item" aria-haspopup="true">
                        <a href="/admin/system/support/index" class="m-menu__link ">
                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                <span>
                                </span>
                            </i>
                            <span class="m-menu__link-text">
                                渠道管理
                            </span>
                        </a>
                    </li>
                    -->
                </ul>
            </div>
        </li>
        @endif
        <li class="m-menu__item  m-menu__item--submenu m-menu__item--open m-menu__item--expanded"
            aria-haspopup="true" data-menu-submenu-toggle="hover">
            <a href="#" class="m-menu__link m-menu__toggle">
                <i class="m-menu__link-icon flaticon-user-settings">
                </i>
                <span class="m-menu__link-text">
                    个人中心
                </span>
                <i class="m-menu__ver-arrow la la-angle-right">
                </i>
            </a>
            <div class="m-menu__submenu">
                <span class="m-menu__arrow">
                </span>
                <ul class="m-menu__subnav">
                    <li class="m-menu__item" aria-haspopup="true">
                        <a href="/admin/profile/index" class="m-menu__link ">
                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                <span>
                                </span>
                            </i>
                            <span class="m-menu__link-text">
                                修改个人信息
                            </span>
                        </a>
                    </li>
                    <li class="m-menu__item" aria-haspopup="true">
                        <a href="/admin/profile/background" class="m-menu__link ">
                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                <span>
                                </span>
                            </i>
                            <span class="m-menu__link-text">
                                修改研究背景
                            </span>
                        </a>
                    </li>
                    <li class="m-menu__item" aria-haspopup="true">
                        <a href="/admin/profile/password" class="m-menu__link ">
                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                <span>
                                </span>
                            </i>
                            <span class="m-menu__link-text">
                                修改密码
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>
    </ul>
</div>
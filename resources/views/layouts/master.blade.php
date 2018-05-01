<!DOCTYPE html>
<html lang="en" >
<!-- begin::Head -->
<head>
    <meta charset="utf-8" />
    <title>
        毕昇教育管理系统
    </title>
    <meta name="description" content="Initialized with local json data">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    @if(config('app.debug'))
    <link href="/assets/vendors/base/vendors.bundle.css" rel="stylesheet" type="text/css" />
    <link href="/assets/demo/default/base/style.bundle.css" rel="stylesheet" type="text/css" />
    @else
        <link href="/assets/vendors/base/vendors.bundle.min.css" rel="stylesheet" type="text/css" />
        <link href="/assets/demo/default/base/style.bundle.min.css" rel="stylesheet" type="text/css" />
    @endif

    <!--end::Base Styles -->
    <link rel="shortcut icon" href="/assets/demo/default/media/img/logo/favicon.ico" />

    <link href="/assets/vendors/custom/flavr/flavr.css" rel="stylesheet" type="text/css" />
    <link href="/assets/app/css/custom.css" rel="stylesheet" type="text/css" />
    <!--begin::Extend Styles -->
    @yield('stylesheet')
    <!--end::Extend Styles -->
</head>
<!-- end::Head -->

<!-- end::Body -->
<body class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default"  >
    <!-- begin:: Page -->
    <div class="m-grid m-grid--hor m-grid--root m-page">
        <!-- BEGIN: Header -->
        <header class="m-grid__item m-header" data-minimize-offset="200" data-minimize-mobile-offset="200">
            <div class="m-container m-container--fluid m-container--full-height">
                <div class="m-stack m-stack--ver m-stack--desktop">
                    <!-- BEGIN: Brand -->
                    <div class="m-stack__item m-brand  m-brand--skin-dark ">
                        <div class="m-stack m-stack--ver m-stack--general">
                            <div class="m-stack__item m-stack__item--middle m-brand__logo">
                                <a href="#" class="m-brand__logo-wrapper" id="logo-text-a">
                            <span id="logo-text">
                                毕昇教育
                            </span>
                                </a>
                            </div>
                            <div class="m-stack__item m-stack__item--middle m-brand__tools">
                                <!-- BEGIN: Left Aside Minimize Toggle -->
                                <a href="javascript:;" id="m_aside_left_minimize_toggle" class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-desktop-inline-block">
                            <span>
                            </span>
                                </a>
                                <!-- END -->
                                <!-- BEGIN: Responsive Aside Left Menu Toggler -->
                                <a href="javascript:;" id="m_aside_left_offcanvas_toggle" class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-tablet-and-mobile-inline-block">
                            <span>
                            </span>
                                </a>
                                <!-- END -->
                                <!-- BEGIN: Responsive Header Menu Toggler -->
                                <a id="m_aside_header_menu_mobile_toggle" href="javascript:;" class="m-brand__icon m-brand__toggler m--visible-tablet-and-mobile-inline-block">
                            <span>
                            </span>
                                </a>
                                <!-- END -->
                                <!-- BEGIN: Topbar Toggler -->
                                <a id="m_aside_header_topbar_mobile_toggle" href="javascript:;" class="m-brand__icon m--visible-tablet-and-mobile-inline-block">
                                    <i class="flaticon-more">
                                    </i>
                                </a>
                                <!-- BEGIN: Topbar Toggler -->
                            </div>
                        </div>
                    </div>
                    <!-- END: Brand -->
                    <div class="m-stack__item m-stack__item--fluid m-header-head" id="m_header_nav">
                        <!-- BEGIN: Horizontal Menu -->
                        <!--<button class="m-aside-header-menu-mobile-close m-aside-header-menu-mobile-close&#45;&#45;skin-dark
                        " id="m_aside_header_menu_mobile_close_btn">-->
                        <!--<i class="la la-close"></i>-->
                        <!--</button>-->
                    @include('layouts.horizontal_menu')
                    <!-- END: Horizontal Menu -->
                        <!-- BEGIN: Topbar -->
                    @include('layouts.topbar')
                    <!-- END: Topbar -->
                    </div>
                </div>
            </div>
        </header>
        <!-- END: Header -->

        <!-- begin::Body -->
        <div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">
            <!-- BEGIN: Left Aside -->
            <!--<button class="m-aside-left-close  m-aside-left-close&#45;&#45;skin-dark " id="m_aside_left_close_btn">-->
            <!--<i class="la la-close"></i>-->
            <!--</button>-->
            <div id="m_aside_left" class="m-grid__item	m-aside-left  m-aside-left--skin-dark ">
                <!-- BEGIN: Aside Menu -->
                @include('layouts.aside_menu')
                <!-- END: Aside Menu -->
            </div>
            <!-- END: Left Aside -->

            <div class="m-grid__item m-grid__item--fluid m-wrapper">
                <!-- BEGIN: Subheader -->
                @yield('sub-header')
                <!-- END: Subheader -->

                @yield('content')
            </div>
        </div>
        <!-- end:: Body -->

        <!-- begin::Footer -->
        @include('layouts.footer')
        <!-- end::Footer -->

    </div>
    <!-- end:: Page -->

    <!-- begin::Scroll Top -->
    <div class="m-scroll-top m-scroll-top--skin-top" data-toggle="m-scroll-top" data-scroll-offset="500" data-scroll-speed="300">
        <i class="la la-arrow-up"></i>
    </div>
    <!-- end::Scroll Top -->

    <!-- begin::Quick Sidebar -->
    @include('layouts.quick_sidebar')
    <!-- end::Quick Sidebar -->

    <!--begin::Base Scripts -->
    @if(config('app.debug'))
    <script src="/assets/vendors/base/vendors.bundle.js" type="text/javascript"></script>
    <script src="/assets/demo/default/base/scripts.bundle.js" type="text/javascript"></script>
    @else
        <script src="/assets/vendors/base/vendors.bundle.min.js" type="text/javascript"></script>
        <script src="/assets/demo/default/base/scripts.bundle.min.js" type="text/javascript"></script>
    @endif
    <script src="/assets/vendors/custom/flavr/flavr.js" type="text/javascript"></script>
    <!--end::Base Scripts -->

    <!--begin::Page Resources -->
    @yield('script')
    <!--end::Page Resources -->
</body>
<!-- end::Body -->
</html>

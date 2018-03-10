@extends('layouts.master')

@section('stylesheet')
    <link href="/assets/app/css/link.css" rel="stylesheet" type="text/css">
@endsection

@section('script')
    @if(Admin::hasRole('company_admin'))
    <script src="/assets/app/js/statistics_total.js" type="text/javascript"></script>
    @elseif(Admin::hasRole('company'))
    <script src="/assets/app/js/statistics.js" type="text/javascript"></script>
    @endif
@endsection

@section('sub-header')
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">
                    链接激活统计
                </h3>
                <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                    <li class="m-nav__item m-nav__item--home">
                        <a href="#" class="m-nav__link m-nav__link--icon">
                            <i class="m-nav__link-icon la la-home"></i>
                        </a>
                    </li>
                    <li class="m-nav__separator">
                        -
                    </li>
                    <li class="m-nav__item">
                        <a href="" class="m-nav__link">
                        <span class="m-nav__link-text">
                            地推相关
                        </span>
                        </a>
                    </li>
                    <li class="m-nav__separator">
                        -
                    </li>
                    <li class="m-nav__item">
                        <a href="" class="m-nav__link">
                        <span class="m-nav__link-text">
                            链接激活统计
                        </span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="m-content">
        <div class="row">
            <div class="col-xl-4">
                <!--begin:: Widgets/Product Sales-->
                <div class="m-portlet m-portlet--bordered-semi m-portlet--space m-portlet--full-height ">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">
                                    总新激活量
                                <span class="m-portlet__head-desc">
                                    使用新包激活的新玩家数量
                                </span>
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <div class="m-widget25">
                            <span class="m-widget25__price m--font-brand">
                                {{ $total['used']['new'] ?? 0 }}
                            </span>
                            <br>
                            <span class="m-widget25__desc">
                                从链接创建至今的新增量
                            </span>
                            <div class="m-widget25--progress">
                                <div class="m-widget25__progress">
                                    <span class="m-widget25__progress-number">
                                        {{ $total['percent']['new_visited'] ?? 0 }}%
                                    </span>
                                    <div class="m--space-10">
                                    </div>
                                    <div class="progress m-progress--sm">
                                        <div class="progress-bar m--bg-danger" role="progressbar" style="width: 63%;"
                                             aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
                                        </div>
                                    </div>
                                    <span class="m-widget25__progress-sub">
                                        新增激活量/访问量
                                    </span>
                                </div>
                                <div class="m-widget25__progress">
                                    <span class="m-widget25__progress-number">
                                        {{ $total['percent']['new_all'] }}%
                                    </span>
                                        <div class="m--space-10">
                                        </div>
                                        <div class="progress m-progress--sm">
                                            <div class="progress-bar m--bg-warning" role="progressbar" style="width: 54%;"
                                                 aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
                                            </div>
                                        </div>
                                    <span class="m-widget25__progress-sub">
                                        新增激活量/总激活
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end:: Widgets/Product Sales-->
            </div>
            <div class="col-xl-8">
                <!--begin:: Widgets/Sale Reports-->
                <div class="m-portlet m-portlet--full-height ">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">
                                    每条链接激活量
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <div class="m_datatable" id="index_table"></div>
                    </div>
                </div>
                <!--end:: Widgets/Sale Reports-->
            </div>
        </div>
    </div>
@endsection
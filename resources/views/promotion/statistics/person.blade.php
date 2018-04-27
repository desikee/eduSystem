@extends('layouts.master')

@section('stylesheet')
    <link href="/assets/app/css/custom.css" rel="stylesheet" type="text/css">
@endsection

@section('script')
    <script src="/assets/vendors/custom/qrcode/jqueryqr.js" type="text/javascript"></script>
    <script src="/assets/app/js/statistics/person.js" type="text/javascript"></script>
@endsection

@section('sub-header')
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">
                    推广效果统计
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
                            推广效果统计
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
            <div class="col-xl-6">
                <!--begin:: Widgets/Product Sales-->
                <div class="m-portlet m-portlet--bordered-semi m-portlet--space m-portlet--full-height ">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">
                                    获得酬金
                                <span class="m-portlet__head-desc">
                                    所有推广链接所取得的总酬金
                                </span>
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <div class="m-widget25">
                            <span class="m-widget25__price m--font-danger" id="u-total-pay">
                                <div class="m-loader m-loader--danger" style="display: inline-block;"></div>
                            </span>
                            <br>
                            <span class="m-widget25__desc">
                                所有推广带来的用户酬金
                            </span>
                            <div class="m-widget25--progress">
                                <div class="m-widget25__progress">
                                    <span class="m-widget25__progress-number m--font-success" id="u-total-pay_add">
                                        <div class="m-loader m-loader--success" style="width: 30px; display: inline-block;"></div>
                                    </span>
                                    <div class="m--space-10">
                                    </div>
                                    <span class="m-widget25__progress-sub">
                                        昨日新获取酬金
                                    </span>
                                </div>
                                <div class="m-widget25__progress" style="display: none;">
                                    <span class="m-widget25__progress-number  m--font-warning" id="u-total-percent-pay-text">
                                        <div class="m-loader m-loader--brand" style="width: 30px; display: inline-block;"></div>
                                    </span>
                                    <div class="m--space-10">
                                    </div>
                                    <div class="progress m-progress--sm">
                                        <div class="progress-bar m--bg-warning" role="progressbar" style="width: 0%;"
                                             aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="u-total-percent-pay-bar">
                                        </div>
                                    </div>
                                    <span class="m-widget25__progress-sub">
                                        比昨日提高
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end:: Widgets/Product Sales-->
            </div>
            <div class="col-xl-6">
                <!--begin:: Widgets/Product Sales-->
                <div class="m-portlet m-portlet--bordered-semi m-portlet--space m-portlet--full-height ">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">
                                    激活量统计
                                <span class="m-portlet__head-desc">
                                    所有链接的激活量和访问量统计
                                </span>
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body" style="padding-top: 0;">
                        <div class="m-widget1" style="padding: 0;">
                            <div class="m-widget1__item">
                                <div class="row m-row--no-padding align-items-center">
                                    <div class="col">
                                        <h3 class="m-widget1__title">
                                            新增激活量
                                        </h3>
                                    <span class="m-widget1__desc">
                                        只包含新玩家的有效激活量
                                    </span>
                                    </div>
                                    <div class="col m--align-right">
                                    <span class="m-widget1__number m--font-danger" id="u-visit-used">
                                        <div class="m-loader m-loader--danger" style="display: inline-block;"></div>
                                    </span>
                                    </div>
                                </div>
                            </div>
                            <div class="m-widget1__item" style="border-bottom: 0.07rem dashed #ebedf2">
                                <div class="row m-row--no-padding align-items-center">
                                    <div class="col">
                                        <h3 class="m-widget1__title">
                                            总访问量
                                        </h3>
                                    <span class="m-widget1__desc">
                                        所有链接的点击总量
                                    </span>
                                    </div>
                                    <div class="col m--align-right">
                                    <span class="m-widget1__number m--font-info" id="u-visit-visited">
                                        <div class="m-loader m-loader--info" style="display: inline-block;"></div>
                                    </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="m-widget12" style="padding-top: 1.2rem;">
                            <div class="m-widget12__item">
                                <span class="m-widget12__text1">
                                    老玩家激活量
                                    <br>
                                    <span id="u-visit-used_old" class="m--font-brand">
                                        <div class="m-loader m-loader--brand" style="display: inline-block;"></div>
                                    </span>
                                </span>
                                <div class="m-widget12__text2">
                                    <div class="m-widget12__desc">
                                        新增激活量/总激活
                                    </div>
                                    <br>
                                    <div class="m-widget12__progress">
                                        <div class="m-widget12__progress-sm progress m-progress--sm">
                                            <div class="m-widget12__progress-bar progress-bar bg-brand" role="progressbar"
                                                 aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;" id="u-visit-percent-1-bar"></div>
                                        </div>
                                        <span class="m-widget12__stats m--font-brand" id="u-visit-percent-1-text">
                                            <div class="m-loader m-loader--brand" style="display: inline-block;"></div>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="m-widget12__item">
                                <span class="m-widget12__text1">
                                    访问设备数
                                    <br>
                                    <span id="u-visit-visited_device" class="m--font-success">
                                        <div class="m-loader m-loader--success" style="display: inline-block;"></div>
                                    </span>
                                </span>
                                <div class="m-widget12__text2">
                                    <div class="m-widget12__desc">
                                        访问设备数/总访问次数
                                    </div>
                                    <br>
                                    <div class="m-widget12__progress">
                                        <div class="m-widget12__progress-sm progress m-progress--sm">
                                            <div class="m-widget12__progress-bar progress-bar bg-success" role="progressbar"
                                                 aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;" id="u-visit-percent-2-bar"></div>
                                        </div>
                                        <span class="m-widget12__stats m--font-success" id="u-visit-percent-2-text">
                                            <div class="m-loader m-loader--success" style="display: inline-block;"></div>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="m-widget12__item">
                                <span class="m-widget12__text1">
                                    新玩家激活次数
                                    <br>
                                    <span id="u-visit-used_time_new" class="m--font-info">
                                        <div class="m-loader m-loader--info" style="display: inline-block;"></div>
                                    </span>
                                </span>
                                <div class="m-widget12__text2">
                                    <div class="m-widget12__desc">
                                        新增激活量/新增激活次数
                                    </div>
                                    <br>
                                    <div class="m-widget12__progress">
                                        <div class="m-widget12__progress-sm progress m-progress--sm">
                                            <div class="m-widget12__progress-bar progress-bar bg-info" role="progressbar"
                                                 aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;" id="u-visit-percent-3-bar"></div>
                                        </div>
                                        <span class="m-widget12__stats m--font-info" id="u-visit-percent-3-text">
                                            <div class="m-loader m-loader--info" style="display: inline-block;"></div>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end:: Widgets/Product Sales-->
            </div>
            <div class="col-xl-12">
                <!--begin:: Widgets/Sale Reports-->
                <div class="m-portlet m-portlet--full-height ">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">
                                    详细数据
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

    <!-- 分享链接模态框 -->
    <div class="modal fade" id="u_modal_share" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        分享链接
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            ×
                        </span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="m-portlet__body">
                        <div class="form-group m-form__group row">
                            <label class="col-3 col-form-label">
                                链接名称：
                            </label>
                            <div class="col-8 col-form-label" id="modal-link_name" style="word-break:break-all">
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label class="col-3 col-form-label">
                                链接地址：
                            </label>
                            <div class="col-md-8 col-form-label" id="modal-source_url" style="word-break:break-all">
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div id="QRCode">

                            </div>
                        </div>
                        <div style="display: none;">
                            <img width="100%" height="100%" src="http://www.idreamsky.com/files/image/20171219162934_c8bf0.png" id="modal-game_icon">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        关闭
                    </button>
                    <button type="button" class="btn btn-success" data-dismiss="modal">
                        确认
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
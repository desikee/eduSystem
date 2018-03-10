@extends('layouts.master')

@section('stylesheet')
    <link href="/assets/app/css/link.css" rel="stylesheet" type="text/css">
@endsection

@section('script')
    <script src="/assets/app/js/config.js" type="text/javascript"></script>
@endsection

@section('sub-header')
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">
                    游戏管理
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
                            地推链接管理
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
        <!--
        <div class="m-alert m-alert--icon m-alert--air m-alert--square alert alert-dismissible m--margin-bottom-30" role="alert">
            <div class="m-alert__icon">
                <i class="flaticon-technology m--font-accent"></i>
            </div>
            <div class="m-alert__text">
                Datatable initialized from remote JSON source with local(frontend) pagination, column order and search support.
            </div>
        </div>
        -->
        <div class="m-portlet m-portlet--mobile">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            地推链接表
                            <small>
                                所有的地推链接信息
                            </small>
                        </h3>
                    </div>
                </div>

            </div>

            <div class="m-portlet__body">

                <!--begin: Search Form -->
                <div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
                    <div class="row align-items-center">
                        <div class="col-xl-8 order-2 order-xl-1">
                            <div class="form-group m-form__group row align-items-center">

                                <!--
                                <div class="col-md-4">
                                    <div class="m-input-icon m-input-icon--left">
                                        <input type="text" class="form-control m-input m-input--solid" placeholder="搜索..." id="m_form_search">
                                        <span class="m-input-icon__icon m-input-icon__icon--left">
                                            <span>
                                                <i class="la la-search"></i>
                                            </span>
                                        </span>
                                    </div>
                                </div>
                                -->
                            </div>
                        </div>
                        <div class="col-xl-4 order-1 order-xl-2 m--align-right">
                            <a href="#" class="btn btn-focus m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill u-btn-new">
                                <span>
                                    <i class="la la-plus-circle"></i>
                                    <span>
                                        新增
                                    </span>
                                </span>
                            </a>
                            <div class="m-separator m-separator--dashed d-xl-none"></div>
                        </div>
                    </div>
                </div>
                <!--end: Search Form -->

                <!--begin: Datatable -->
                <div class="m_datatable" id="index_table"></div>
                <!--end: Datatable -->
            </div>
        </div>
    </div>

    <!-- flarv 模态框-新建 -->
    <div class="flarv-dialog">
        <form class="m-form m-form--fit m-form--label-align-right" id="flarv-dialog-new">
            <div class="m-portlet__body">
                <div class="form-group m-form__group row">
                    <label for="game_id" class="col-4 col-form-label">
                        游戏id
                    </label>
                    <div class="col-8">
                        <input class="form-control m-input" type="text" name="game_id" id="game_id">
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <label for="game_name" class="col-4 col-form-label">
                        游戏名称
                    </label>
                    <div class="col-8">
                        <input class="form-control m-input" type="text" name="game_name" id="game_name">
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <label for="channel_id" class="col-4 col-form-label">
                        渠道id
                    </label>
                    <div class="col-8">
                        <input class="form-control m-input" type="text" name="channel_id" id="channel_id">
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <label for="channel_name" class="col-4 col-form-label">
                        渠道名称
                    </label>
                    <div class="col-8">
                        <input class="form-control m-input" type="text" name="channel_name" id="channel_name">
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <label for="link_host" class="col-4 col-form-label">
                        落地页地址
                    </label>
                    <div class="col-8">
                        <input class="form-control m-input" type="text" name="link_host" id="link_host">
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <label for="download_url" class="col-4 col-form-label">
                        下载地址
                    </label>
                    <div class="col-8">
                        <input class="form-control m-input" type="text" name="download_url" id="download_url">
                    </div>
                </div>
            </div>
        </form>
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
                    <button type="button" class="btn btn-primary">
                        确认
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
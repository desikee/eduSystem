@extends('layouts.master')

@section('stylesheet')
<link href="/assets/app/css/custom.css" rel="stylesheet" type="text/css">
@endsection

@section('script')
<script src="/assets/app/js/link/person.js" type="text/javascript"></script>
<script src="/assets/vendors/custom/qrcode/jqueryqr.js" type="text/javascript"></script>
@endsection

@section('sub-header')
<div class="m-subheader ">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="m-subheader__title m-subheader__title--separator">
                地推链接管理
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
                                <div class="col-md-4">
                                    <div class="m-form__group m-form__group--inline">
                                        <div class="m-form__label">
                                            <label class="u-search-select-label-2">
                                                活动：
                                            </label>
                                        </div>
                                        <div class="m-form__control">
                                            <select class="form-control m-bootstrap-select m-bootstrap-select--solid u-search-select" name="action_name">
                                                <option value="">
                                                    All
                                                </option>
                                                @foreach($search_select['action_name'] as $action_name)
                                                <option value="{{ $action_name }}">{{ $action_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="d-md-none m--margin-bottom-10"></div>
                                </div>
                                <!--
                                <div class="col-md-4">
                                    <div class="m-input-icon m-input-icon--left">
                                        <input type="text" class="form-control m-input m-input--solid" placeholder="搜索链接名..." id="u-search-link_name">
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
                    </div>
                </div>
                <!--end: Search Form -->

                <!--begin: Datatable -->
                <div class="m_datatable" id="index_table"></div>
                <!--end: Datatable -->
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
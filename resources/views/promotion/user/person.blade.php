@extends('layouts.master')

@section('stylesheet')
    <link href="/assets/app/css/custom.css" rel="stylesheet" type="text/css">
@endsection

@section('script')
    <script src="/assets/app/js/user/person.js" type="text/javascript"></script>
@endsection

@section('sub-header')
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">
                    推广人员管理
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
                            推广人员管理
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
                            推广人员列表
                            <small>
                                所有的直属用户或者门店
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
                                                公司：
                                            </label>
                                        </div>
                                        <div class="m-form__control">
                                            <select class="form-control m-bootstrap-select m-bootstrap-select--solid u-search-select" name="company" id="u-search-select-company">
                                                <option value="">
                                                    All
                                                </option>
                                                @foreach($search_select['company'] as $item)
                                                    <option value="{{ $item }}">{{ $item }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="d-md-none m--margin-bottom-10"></div>
                                </div>
                                <div class="col-md-4">
                                    <div class="m-input-icon m-input-icon--left">
                                        <input type="text" class="form-control m-input m-input--solid" placeholder="搜索用户..." id="m_form_search">
                                        <span class="m-input-icon__icon m-input-icon__icon--left">
                                        <span>
                                            <i class="la la-search"></i>
                                        </span>
                                    </span>
                                    </div>
                                </div>
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

    <!-- 通用新增模态框 -->
    <div class="modal fade" id="u-modal" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="u-modal-title">
                        新增
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            ×
                        </span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="m-form m-form--fit m-form--label-align-right" id="u-modal-form">
                        <div class="m-portlet__body">
                            <div class="form-group m-form__group row">
                                <label for="username" class="col-3 col-form-label">
                                    用户名
                                </label>
                                <div class="col-8">
                                    <input class="form-control m-input" type="text" name="username" id="u-modal-form-username">
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                <label for="password" class="col-3 col-form-label">
                                    密码
                                </label>
                                <div class="col-4">
                                    <span class="form-control">默认为： 用户名+2018</span>
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                <label for="email" class="col-3 col-form-label">
                                    邮箱地址
                                </label>
                                <div class="col-8">
                                    <input class="form-control m-input" type="text" name="email" id="email">
                                </div>
                            </div>
                            <!--
                            <div class="form-group m-form__group row">
                                <label for="a_ratio" class="col-3 col-form-label">
                                    A系数
                                </label>
                                <div class="col-8 input-group m-input-group m-input-group--square">
                                    <span class="input-group-addon" id="basic-addon1">
                                        %
                                    </span>
                                    <input type="number" class="form-control m-input" value="20" name="a_ratio" id="a_ratio">
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                <label for="s_ratio" class="col-3 col-form-label">
                                    S系数
                                </label>
                                <div class="col-8 input-group m-input-group m-input-group--square">
                                    <span class="input-group-addon" id="basic-addon1">
                                        %
                                    </span>
                                    <input type="number" class="form-control m-input" value="20" name="s_ratio" id="s_ratio">
                                </div>
                            </div>
                            -->
                            <div class="form-group m-form__group row">
                                <label for="company" class="col-3 col-form-label">
                                    公司名称
                                </label>
                                <div class="col-8">
                                    <input class="form-control m-input" type="text" name="company">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        关闭
                    </button>
                    <button type="button" class="btn btn-success" data-url="" id="u-modal-submit">
                        确定
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
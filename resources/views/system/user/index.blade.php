@extends('layouts.master')

@section('stylesheet')
    <link href="/assets/app/css/custom.css" rel="stylesheet" type="text/css">
@endsection

@section('script')
    <script src="{{URL::asset('assets/app/js/system/user.js')}}" type="text/javascript"></script>
@endsection

@section('sub-header')
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">
                    用户管理
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
                            系统管理
                        </span>
                        </a>
                    </li>
                    <li class="m-nav__separator">
                        -
                    </li>
                    <li class="m-nav__item">
                        <a href="" class="m-nav__link">
                        <span class="m-nav__link-text">
                            用户注册
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
            <div class="col-md-6">
                <div class="m-portlet m-portlet--tab">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                        <span class="m-portlet__head-icon m--hide">
                            <i class="la la-gear"></i>
                        </span>
                                <h3 class="m-portlet__head-text">
                                    填写用户信息
                                </h3>
                            </div>
                        </div>
                    </div>
                    <!--begin::Form-->
                    <form class="m-form m-form--fit m-form--label-align-right" id="form-register_user">
                        <div class="m-portlet__body">
                            <div class="form-group m-form__group row">
                                <label for="username" class="col-3 col-form-label">
                                    用户名
                                </label>
                                <div class="col-6">
                                    <input class="form-control m-input" type="text" placeholder="请输入手机号" name="username">
                                </div>
                            </div>


                            <div class="form-group m-form__group row">
                                <label for="realname" class="col-3 col-form-label">
                                    姓名
                                </label>
                                <div class="col-6">
                                    <input class="form-control m-input" type="text" placeholder="请输入真实姓名" name="realname">
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                <label for="password" class="col-3 col-form-label">
                                    初始密码
                                </label>
                                <div class="col-6">
                                    <input class="form-control m-input" type="password" placeholder="请输入手机号" name="password">
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                <label for="role" class="col-3 col-form-label">
                                    用户身份
                                </label>
                                <div class="col-6">
                                    <select class="form-control m-bootstrap-select m-bootstrap-select--solid u-search-select" name="role" id="u-role">

                                        <option value="0">学员</option>
                                        <option value="3">导师</option>
                                        <option value="7">管理员</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="m-portlet__foot m-portlet__foot--fit">
                            <div class="m-form__actions">
                                <div class="row">
                                    <div class="col-3"></div>
                                    <div class="col-8">
                                        <button type="button" class="btn btn-success" id="form-register_user-submit">
                                            确定
                                        </button>
                                        <button type="reset" class="btn btn-secondary">
                                            重置
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>




@endsection
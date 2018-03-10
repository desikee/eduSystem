@extends('layouts.master')

@section('script')
    <script src="/assets/app/js/profile.js" type="text/javascript"></script>
@endsection

@section('sub-header')
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">
                    个人中心
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
                            个人中心
                        </span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="m-content"><div class="row">
        <div class="col-md-6">
            <div class="m-portlet m-portlet--tab">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                        <span class="m-portlet__head-icon m--hide">
                            <i class="la la-gear"></i>
                        </span>
                            <h3 class="m-portlet__head-text">
                                修改个人信息
                            </h3>
                        </div>
                    </div>
                </div>
                <!--begin::Form-->
                <form class="m-form m-form--fit m-form--label-align-right" id="form-update_profile">
                    <div class="m-portlet__body">
                        <div class="form-group m-form__group row">
                            <label for="username" class="col-3 col-form-label">
                                用户名
                            </label>
                            <div class="col-8">
                                <input class="form-control m-input" type="text" value="{{ Auth::getUser()->username }}" name="username" disabled>
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label for="email" class="col-3 col-form-label">
                                邮箱地址
                            </label>
                            <div class="col-8">
                                <input class="form-control m-input" type="email" value="{{ Auth::getUser()->email }}" name="email" disabled>
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label for="avatar" class="col-3 col-form-label">
                                头像地址
                            </label>
                            <div class="col-8">
                                <input class="form-control m-input" type="url" placeholder="http://dl.uu.cc/plugin/user/rumi.jpg" id="avatar" name="avatar">
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label for="company" class="col-3 col-form-label">
                                所属公司名称
                            </label>
                            <div class="col-8">
                                <input class="form-control m-input" type="tel" placeholder="idreamsky" id="company" name="company">
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__foot m-portlet__foot--fit">
                        <div class="m-form__actions">
                            <div class="row">
                                <div class="col-3"></div>
                                <div class="col-8">
                                    <button type="button" class="btn btn-success" id="form-update_profile-submit">
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
        <div class="col-md-6">
            <div class="m-portlet m-portlet--tab">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                        <span class="m-portlet__head-icon m--hide">
                            <i class="la la-gear"></i>
                        </span>
                            <h3 class="m-portlet__head-text">
                                修改密码
                            </h3>
                        </div>
                    </div>
                </div>
                <!--begin::Form-->
                <form class="m-form m-form--fit m-form--label-align-right" id="form-modify_password">
                    <div class="m-portlet__body">
                        <div class="form-group m-form__group row">
                            <label for="old_password" class="col-3 col-form-label">
                                旧密码
                            </label>
                            <div class="col-8">
                                <input class="form-control m-input" type="password" placeholder="请输入旧密码" name="old_password">
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label for="new_password" class="col-3 col-form-label">
                                新密码
                            </label>
                            <div class="col-8">
                                <input class="form-control m-input" type="password" placeholder="请输入新密码" name="new_password">
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label for="confirm_password" class="col-3 col-form-label">
                                确认密码
                            </label>
                            <div class="col-8">
                                <input class="form-control m-input" type="password" placeholder="请重复新密码" name="confirm_password">
                            </div>
                        </div>
                        <div class="m-form__group form-group row">
                            <label class="col-3 col-form-label">
                                是否清空token
                            </label>
                            <div class="col-8">
                                <span class="m-switch m-switch--outline m-switch--success">
                                    <label>
                                        <input type="checkbox" name="clear" value="1">
                                        <span></span>
                                    </label>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__foot m-portlet__foot--fit">
                        <div class="m-form__actions">
                            <div class="row">
                                <div class="col-3"></div>
                                <div class="col-8">
                                    <button type="button" class="btn btn-success" id="form-modify_password-submit">
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
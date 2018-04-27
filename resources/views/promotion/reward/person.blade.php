@extends('layouts.master')

@section('stylesheet')
    <link href="/assets/app/css/custom.css" rel="stylesheet" type="text/css">
@endsection

@section('script')
    <script src="/assets/app/js/reward/company.js" type="text/javascript"></script>
    <script src="/assets/vendors/base/vue.runtime.min.js"></script>
@endsection

@section('sub-header')
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">
                    个人推广酬金
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
                            个人推广酬金
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
            <div class="col-xl-3">
                <div class="m-portlet">
                    <div class="m-portlet__body">
                        <div class="m-widget1" style="padding:0;">
                            <div class="m-widget1__item">
                                <div class="row m-row--no-padding align-items-center">
                                    <div class="col">
                                        <h3 class="m-widget1__title">
                                            可取现酬金
                                        </h3>
                                        <span class="m-widget1__desc">
                                            点击可以申请提现
                                        </span>
                                    </div>
                                    <div class="col m--align-right">
                                        <span class="m-widget1__number m--font-success" id="u-reward-available">
                                            <div class="m-loader m-loader--success" style="display: inline-block;"></div>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3">
                <div class="m-portlet">
                    <div class="m-portlet__body">
                        <div class="m-widget1" style="padding:0;">
                            <div class="m-widget1__item">
                                <div class="row m-row--no-padding align-items-center">
                                    <div class="col">
                                        <h3 class="m-widget1__title">
                                            取现中酬金
                                        </h3>
                                        <span class="m-widget1__desc">
                                            申请中的酬金
                                        </span>
                                    </div>
                                    <div class="col m--align-right">
                                        <span class="m-widget1__number m--font-info" id="u-reward-cashing">
                                            <div class="m-loader m-loader--info" style="display: inline-block;"></div>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3">
                <div class="m-portlet">
                    <div class="m-portlet__body">
                        <div class="m-widget1" style="padding:0;">
                            <div class="m-widget1__item">
                                <div class="row m-row--no-padding align-items-center">
                                    <div class="col">
                                        <h3 class="m-widget1__title">
                                            已取现酬金
                                        </h3>
                                        <span class="m-widget1__desc">
                                            转账成功的酬金
                                        </span>
                                    </div>
                                    <div class="col m--align-right">
                                        <span class="m-widget1__number m--font-danger" id="u-reward-cashed">
                                            <div class="m-loader m-loader--danger" style="display: inline-block;"></div>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3">
                <div class="m-portlet">
                    <div class="m-portlet__body">
                        <div class="m-widget1" style="padding:0;">
                            <div class="m-widget1__item">
                                <div class="row m-row--no-padding align-items-center">
                                    <div class="col">
                                        <h3 class="m-widget1__title">
                                            历史总酬金
                                        </h3>
                                        <span class="m-widget1__desc">
                                            所赚全部酬金
                                        </span>
                                    </div>
                                    <div class="col m--align-right">
                                        <span class="m-widget1__number m--font-brand"  id="u-reward-total">
                                            <div class="m-loader m-loader--brand" style="display: inline-block;"></div>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <!--begin:: Widgets/Sale Reports-->
                <div class="m-portlet m-portlet--full-height">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">
                                    取现记录
                                </h3>
                            </div>
                        </div>
                        <div class="m-portlet__head-tools">
                            <a href="javascript:;" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill" id="u-btn-cash">
                                <span>
                                    <i class="la la-cart-plus"></i>
                                    <span>
                                        申请提现
                                    </span>
                                </span>
                            </a>
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

    <!-- 申请提现模态框 -->
    <div class="modal fade" id="u-modal" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
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
                    <form class="m-form m-form--fit m-form--label-align-right" id="u-modal-form">
                        <div class="m-portlet__body">
                            <div class="form-group m-form__group row">
                                <label for="cash_reward" class="col-3 col-form-label">
                                    该次取现金额
                                </label>
                                <div class="col-8">
                                    <input class="form-control m-input" type="text" name="cash_reward" id="u-modal-form-cash_reward">
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                <label for="alipay_account" class="col-3 col-form-label">
                                    支付宝账号
                                </label>
                                <div class="col-8">
                                    <input class="form-control m-input" type="text" name="alipay_account">
                                    <span class="m-form__help">
                                        请保证输入正确的支付宝账号
                                    </span>
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                <label for="name" class="col-3 col-form-label">
                                    收款人姓名
                                </label>
                                <div class="col-8">
                                    <input class="form-control m-input" type="text" name="name">
                                    <span class="m-form__help">
                                    用于打款失败时电话联系的称呼
                                    </span>
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                <label for="phone" class="col-3 col-form-label">
                                    联系电话
                                </label>
                                <div class="col-8">
                                    <input class="form-control m-input" type="text" name="phone" id="u-modal-form-phone">
                                    <span class="m-form__help">
                                    用于打款失败时的联系方式
                                    </span>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        关闭
                    </button>
                    <button type="button" class="btn btn-success" id="u-modal-submit">
                        确认
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
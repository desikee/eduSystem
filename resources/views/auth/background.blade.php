@extends('layouts.master')

@section('script')
    <script src="{{URL::asset('assets/app/js/profile.js')}}" type="text/javascript"></script>
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
                            修改研究背景
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
            <div class="col-md-8">
                <div class="m-portlet m-portlet--tab">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                        <span class="m-portlet__head-icon m--hide">
                            <i class="la la-gear"></i>
                        </span>
                                <h3 class="m-portlet__head-text">
                                    修改研究背景
                                </h3>
                            </div>
                        </div>
                    </div>
                    <!--begin::Form-->
                    <form class="m-form m-form--fit m-form--label-align-right" id="form-update_background">
                        <div class="m-portlet__body">
                            <div class="form-group m-form__group ">
                                <div >
                                    论文经历
                                </div>
                                <textarea class="form-control m-input"  rows="7" value="{{Auth::getUser()->paper}}" name="paper"></textarea>
                            </div>
                            <div class="form-group m-form__group ">
                                <label for="research" class=" col-form-label">
                                    科研经历
                                </label>
                                <textarea class="form-control m-input"  rows="7" value="{{Auth::getUser()->research}}" name="research"></textarea>
                            </div>
                            <div class="form-group m-form__group ">
                                <label for="advance" class=" col-form-label">
                                    个人特长
                                </label>
                                <textarea class="form-control m-input"  rows="7" value="{{Auth::getUser()->advance}}" name="advance"></textarea>
                            </div>

                        </div>
                        <div class="m-portlet__foot m-portlet__foot--fit">
                            <div class="m-form__actions">
                                <div class="row">
                                    <div class="col-3"></div>
                                    <div class="col-6">
                                        <button type="button" class="btn btn-success"  id="form-update_background-submit">
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
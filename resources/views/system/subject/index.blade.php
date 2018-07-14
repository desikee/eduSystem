@extends('layouts.master')

@section('stylesheet')
    <link href="/assets/app/css/custom.css" rel="stylesheet" type="text/css">
@endsection

@section('script')
    <script src="{{URL::asset('assets/app/js/system/create_subject.js')}}" type="text/javascript"></script>
@endsection

@section('sub-header')
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">
                    项目管理
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
                            新增项目
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
                                    新增项目信息
                                </h3>
                            </div>
                        </div>
                    </div>
                    <!--begin::Form-->
                    <form class="m-form m-form--fit m-form--label-align-right" id="form-course">
                        <div class="m-portlet__body">
                            <div class="form-group m-form__group row">
                                <label for="teacher_name" class="col-3 col-form-label">
                                    导师用户名
                                </label>
                                <div class="col-6">
                                    <input class="form-control m-input" type="text" placeholder="请输入导师手机号" name="teacher_name">
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                <label for="student_name" class="col-3 col-form-label">
                                    学生用户名
                                </label>
                                <div class="col-6">
                                    <input class="form-control m-input" type="text" placeholder="请输入学员手机号" name="student_name">
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                <label for="course_name" class="col-3 col-form-label">
                                    项目名称
                                </label>
                                <div class="col-6">
                                    <input class="form-control m-input" type="text" placeholder="请输入项目名称" name="course_name">
                                </div>
                            </div>

                            <!--
                            <div class="form-group m-form__group row">
                                <label for="teacher_instrument" class="col-3 col-form-label">
                                    指导内容
                                </label>
                                <div class="col-10">
                                    <input class="form-control m-input" type="text" placeholder="请输入导师指导内容" name="teacher_instrument">
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                <label for="student_work" class="col-3 col-form-label">
                                    学员任务
                                </label>
                                <div class="col-10">
                                    <input class="form-control m-input" type="text" placeholder="请输入学员任务" name="student_work">
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                <label for="teacher_duration" class="col-3 col-form-label">
                                    指导时长
                                </label>
                                <div class="col-10">
                                    <input class="form-control m-input" type="text" placeholder="请输入指导时长，整数小时" name="teacher_duration">
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                <label for="role" class="col-3 col-form-label">
                                    项目状态
                                </label>
                                <div class="col-6">
                                    <select class="form-control m-bootstrap-select m-bootstrap-select--solid u-search-select" name="course_status" id="course_select_status">

                                        <option value="0">未结题</option>
                                        <option value="1">已结题</option>

                                    </select>
                                </div>
                            </div>
                            -->
                        </div>

                        <div class="m-portlet__foot m-portlet__foot--fit">
                            <div class="m-form__actions">
                                <div class="row">
                                    <div class="col-3"></div>
                                    <div class="col-8">
                                        <button type="button" class="btn btn-success" id="form-course-submit">
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
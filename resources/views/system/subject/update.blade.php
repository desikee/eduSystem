@extends('layouts.master')

@section('stylesheet')
    <link href="/assets/app/css/custom.css" rel="stylesheet" type="text/css">
@endsection

@section('script')
    <script src="{{URL::asset('assets/app/js/system/update_subject.js')}}" type="text/javascript"></script>
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
                            更新项目
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
                            项目详情
                            <small>
                                查看项目
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
                                <div class="col-md-3">
                                    <div class="m-form__group m-form__group--inline">
                                        <div class="m-form__label">
                                            <label class="u-search-select-label-2">
                                                学员：
                                            </label>
                                        </div>
                                        <div class="m-form__control">
                                            <select class="form-control m-bootstrap-select m-bootstrap-select--solid u-student-search-select" name="student_id" id="u-student-search-select">

                                                @if(isset($students))
                                                    @foreach($students as $student)
                                                        <option value="{{ $student->id }}">{{ $student->realname }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="d-md-none m--margin-bottom-10"></div>
                                </div>
                                <div class="col-md-3">
                                    <button type="button" class="btn btn-success" id="u-current-student-button">
                                        所有学员
                                    </button>
                                </div>

                                <div class="col-md-3">
                                    <div class="m-form__group m-form__group--inline">
                                        <div class="m-form__label">
                                            <label class="u-search-select-label-2">
                                                导师：
                                            </label>
                                        </div>
                                        <div class="m-form__control">
                                            <select class="form-control m-bootstrap-select m-bootstrap-select--solid u-teacher-search-select" name="teacher_id" id="u-teacher-search-select">
                                                @if(isset($teachers))
                                                    @foreach($teachers as $teacher)
                                                        <option value="{{ $teacher->id }}">{{ $teacher->realname }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-3">
                                    <button type="button" class="btn btn-success" id="u-current-teacher-button">
                                        所有导师
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!--
                        <div class="col-xl-4 order-1 order-xl-2 m--align-right">
                            <a href="#" class="btn btn-focus m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill u-btn-new">
                                <span>
                                    <i class="la la-plus-circle"></i>
                                    <span>
                                        新增任务
                                    </span>
                                </span>
                            </a>
                            <div class="m-separator m-separator--dashed d-xl-none"></div>
                        </div>
                        -->
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
                        新增任务
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
                            <div class="form-group m-form__group">
                                <label for="course_name">
                                    项目名称
                                </label>
                                <input class="form-control m-input" id="course_name" name="course_name" type="text">
                            </div>
                            <div class="form-group m-form__group row col-md-8">
                                <label class="u-search-select-label-1" for="course_status">
                                    项目状态
                                </label>
                                <select class="form-control m-bootstrap-select m-bootstrap-select--solid u-status-search-select" name="course_status" id="course_select_status">
                                    <option value="0">未结题</option>
                                    <option value="1">已结题</option>
                                </select>
                            </div>
                            <div class="form-group m-form__group">
                                <label for="teacher_instrument">
                                    指导内容
                                </label>
                                <textarea class="form-control m-input" id="teacher_instrument" name="teacher_instrument" rows="7"></textarea>
                            </div>
                            <div class="form-group m-form__group">
                                <label for="student_work">
                                    学员任务
                                </label>
                                <textarea class="form-control m-input" id="student_work" name="student_work" rows="7"></textarea>
                            </div>
                            <div class="m-form__group form-group">
                                <label for="teacher_duration">
                                    指导时长
                                </label>
                                <input class="form-control m-input" id="teacher_duration" name="teacher_duration" placeholder="4">
                            </div>

                            <div class="m-form__group form-group">
                                <label for="start_time">
                                    开始日期
                                </label>
                                <input type="text" class="form-control m-input" readonly=""  id="start_time" name="start_time">
                            </div>
                            <div class="m-form__group form-group">
                                <label for="complete_time">
                                    完成日期
                                </label>
                                <input type="text" class="form-control m-input" readonly=""  id="complete_time" name="complete_time">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        关闭
                    </button>
                    <button type="button" class="btn btn-success"  id="u-modal-submit">
                        确定
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
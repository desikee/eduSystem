/**
 * Created by rumi.zhao on 2018/1/9.
 */


    //== Private functions

    // basic demo


    // 初始化选择框
var student_selectpicker = $('#course_select_status').selectpicker(),
    select_option = $('#course_select_status option[value=' + student_selectpicker.val() + ']');

var status_id;
// 为每个搜索选择框添加查询事件
$('.u-search-select').each(function() {
    var query_field = $(this).attr('name');
    $(this).on('change', function() {
        if (!$(this).val())
        {
            return false;
        }
        status_id = $(this).val();
    });
});

// toast global option
toastr.options = {
    "closeButton": true,
    "debug": false,
    "newestOnTop": true,
    "progressBar": true,
    "positionClass": "toast-top-right",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "3000",
    "hideDuration": "1000",
    "timeOut": "15000",
    "extendedTimeOut": "10000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
};

$('#form-course-submit').on('click', function() {
    var form_data = $('#form-course').serialize();

    var form_validate = $('#form-course').closest('form');
    form_validate.validate({
        rules: {
            teacher_name: {
                required:true,
                minlength:11,
                maxlength:11
            },
            student_name: {
                required: true,
                minlength:11,
                maxlength:11
            },
            course_name:{
                required:true
            }

        },
        messages: {
            teacher_name:{
                required: '请输入11位手机号',
                minlength:'手机号为11位',
                maxlenght:'手机号为11位'
            },
            student_name:{
                required: '请输入11位手机号',
                minlength:'手机号为11位',
                maxlenght:'手机号为11位'
            },
            course_name:{
                required: '请输入项目名称'
            }
        }
    });

    if (!form_validate.valid()) {
        return false;
    }
//    form_data += '&status=' + status_id;
    $.post('addSubject', form_data, function(ret){
        if (ret.code !== 0) {
            toastr.error("新增项目失败: " + ret.message, "新增失败");
            return false;
        }
        location.reload();
        toastr.success("成功增添新项目", "成功");
    });
});






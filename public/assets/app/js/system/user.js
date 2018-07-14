

    //== Private functions

    // basic demo


        // 初始化选择框
        var student_selectpicker = $('#u-role').selectpicker(),
            select_option = $('#u-role option[value=' + student_selectpicker.val() + ']');
        $('#u-current-student-button').text(select_option.text());
        var role_id;
        // 为每个搜索选择框添加查询事件
        $('.u-search-select').each(function() {
            var query_field = $(this).attr('name');
            $(this).on('change', function() {
                if (!$(this).val())
                {
                    return false;
                }
                role_id = $(this).val();
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

        $('#form-register_user-submit').on('click', function() {
            var form_data = $('#form-register_user').serialize();

            var form_validate = $('#form-register_user').closest('form');
            form_validate.validate({
                rules: {
                    username: {
                        required:true,
                        minlength:11,
                        maxlength:11
                    },
                    password: {
                        required: true,
                        minlength:11,
                        maxlength:11
                    }

                },
                messages: {
                    username:{
                        required: '请输入11位手机号',
                        minlength:'手机号为11位',
                        maxlenght:'手机号为11位'
                    },
                    password:{
                        required: '请输入11位手机号',
                        minlength:'手机号为11位',
                        maxlenght:'手机号为11位'
                    }
                }
            });

            if (!form_validate.valid()) {
                return false;
            }
            form_data += '&status=' + role_id;
            $.post('add', form_data, function(ret){
                if (ret.code !== 0) {
                    toastr.error("注册用户失败: " + ret.message, "注册失败");
                    return false;
                }
                location.reload();
                toastr.success("成功注册新用户", "成功");
            });
        });






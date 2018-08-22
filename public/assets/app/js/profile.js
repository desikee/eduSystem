/**
 * Created by youyouzh on 2018/1/5.
 */

// toast global option
toastr.options = {
    "closeButton": true,
    "debug": false,
    "newestOnTop": true,
    "progressBar": true,
    "positionClass": "toast-top-right",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
};

$('#paper_text').ready(function(){
   this.val("test paper");
});
$('#form-update_profile-submit').on('click', function() {
    var form_data = $('#form-update_profile').serialize();

    var form_validate = $('#form-update_profile').closest('form');
    form_validate.validate({
        rules: {
            avatar: {
                required:true,
                url: true
            },
            realname: {
                required: true
            },
            phone:{
                required:true,
                minlength:11,
                maxlength:11

            },
            email:{
                required:true,
                email:true
            }

        },
        messages: {
            avatar: {
                required:'请输入头像地址',
                url: '请输入正确的url地址'
            },
            realname: {
                required: '请输入真实姓名！'
            },
            phone:{
                required: '请输入11位手机号',
                minlength:'手机号为11位',
                maxlenght:'手机号为11位'
            },
            email:{
                required:'请输入邮箱地址',
                email:'邮箱格式不合法'
            }
        }
    });

    if (!form_validate.valid()) {
        return false;
    }

    form_data += '&id=' + $('#u-user').attr('data-user_id');
    $.post('update_profile', form_data, function(ret){
        if (ret.code !== 0) {
            toastr.error("修改个人信息失败: " + ret.message, "修改失败");
            return false;
        }
        location.reload();
        toastr.success("您已经成功更新了您的个人资料", "更新成功");
    });
});

$('#form-modify_password-submit').on('click', function() {
    var form_data = $('#form-modify_password').serialize();

    var form_validate = $('#form-modify_password').closest('form');

    form_validate.validate({
        rules: {
            old_password: {
                required: true
            },
            new_password: {
                required: true,
                minlength: 8
            },
            confirm_password: {
                required: true,
                minlength: 8
            }
        },
        messages: {
            old_password: {
                required: '请输入原始密码！'
            },
            new_password: {
                required: '请输入新密码！',
                minlength: '密码长度最少为8位'
            },
            confirm_password: {
                required: '请输入重复密码',
                minlength: '密码长度最少为8位'
            }
        }
    });

    if (!form_validate.valid()) {
        return false;
    }

    form_data += '&id=' + $('#u-user').attr('data-user_id');
    $.post('modify_password', form_data, function(ret) {
        if (ret.code !== 0) {
            toastr.error("修改密码失败: " + ret.message, "修改失败");
            return false;
        }
        if (ret.data.redirect) {
            location.href = ret.data.redirect;
        }
        toastr.success("您已经成功修改密码", "修改成功");
    })
});

$('#form-update_background-submit').on('click', function() {
    var form_data = $('#form-update_background').serialize();

    var form_validate = $('#form-update_background').closest('form');

    form_validate.validate({
        rules: {
            paper: {
                required: true
            },
            research: {
                required: true
            },
            advance: {
                required: true
            }
        },
        messages: {
            paper:{
                required: '论文经历必填'
            },
            research: {
                required: '科研经历必填'
            },
            advance: {
                required: '特长必填'
            }
        }
    });

    if (!form_validate.valid()) {
        return false;
    }

    form_data += '&id=' + $('#u-user').attr('data-user_id');
    $.post('update_background', form_data, function(ret) {
        if (ret.code !== 0) {
            toastr.error("更新资料失败: " + ret.message, "更新失败");
            return false;
        }

        location.reload();
        toastr.success("您已经成功更新了您的背景资料", "更新成功");
    })
});
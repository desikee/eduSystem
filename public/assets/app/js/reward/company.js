/**
 * Created by rumi.zhao on 2018/1/4.
 */
/**
 * Created by rumi.zhao on 2018/1/4.
 */

var CustomFunction = function () {
    //== Private functions

    // basic demo
    function demo() {
        var datatable = $('.m_datatable').mDatatable({
            // datasource definition

            translate: {
                records: {
                    processing: '处理中...',
                    noRecords: '没有匹配结果'
                },
                toolbar: {
                    pagination: {
                        items: {
                            default: {
                                first: '首页',
                                prev: '上一页',
                                next: '下一页',
                                last: '末页',
                                more: '更多',
                                input: '页数',
                                select: '选择每页显示的记录数'
                            },
                            info: '当前显示第 {{start}} 至 {{end}} 项，共 {{total}} 项'
                        }
                    }
                }
            },

            data: {
                type: 'remote',
                source: {
                    read: {
                        url: 'getList',
                        params: {
                            game_id: $('#u-current-game').attr('data-game_id')
                        }
                    }
                },
                pageSize: 10,
                saveState: {
                    cookie: true,
                    webstorage: true
                },
                serverPaging: true,
                serverFiltering: true,
                serverSorting: false
            },

            // layout definition
            layout: {
                theme: 'default', // datatable theme
                class: '', // custom wrapper class
                scroll: true, // enable/disable datatable scroll both horizontal and vertical when needed.
                footer: false // display/hide footer
            },
            sortable: false, // column sorting
            filterable: false, // column based filtering
            pagination: true,

            // columns definition
            columns: [{
                field: "id",
                title: "id",
                type: 'number',
                // sortable: 'asc', // default sort
                filterable: false, // disable or enable filtering
                width: 80
            }, {
                field: "username",
                title: "用户名"
            }, {
                field: "email",
                title: "邮箱地址"
            },{
                field: "company",
                title: "所属公司"
            },{
                field: "visited",
                title: "访问量"
            },{
                field: "used",
                title: "激活量"
            },{
                field: "pay",
                title: "贡献酬金",
                template: function(row) {
                    return row['pay'].toFixed(2);
                }
            },{
                field: "pay_down",
                title: "所赚酬金",
                template: function(row) {
                    return row['pay_down'].toFixed(2);
                }
            }]
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
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };


        // 表单提交处理
        var modal_form = $('#u-modal-form'),
            modal_submit = $('#u-modal-submit'),
            modal_title = $('#u-modal-title'),
            modal = $('#u-modal'),
            form_validate = modal_form.validate({
                rules: {
                    cash: {
                        required: true,
                        number: true
                    },
                    name: {
                        required: true
                    },
                    alipay_account: {
                        required: true
                    },
                    phone: {
                        required: true,
                        number: true
                    }
                },
                messages: {
                    cash: {
                        required: '请输入取现金额！',
                        number: '请输入数字'
                    },
                    name: {
                        required: '请输入取款人称呼！'
                    },
                    alipay_account: {
                        required: '请输入支付宝账号！',
                    },
                    phone: {
                        required: '请输入手机号码！',
                        number: '请输入数字'
                    }
                }
            });
        // 点击新增按钮处理
        $('.m-content').on('click', '#u-btn-cash', function() {
            modal_title.text('提现申请');

            form_validate.resetForm();

            $('#u-modal-form-cash_reward').inputmask({
                "mask": "9{1,5}",
                "greedy": false,
                placeholder: ""
            });
            $('#u-modal-form-phone').inputmask({
                "mask": "9{11}",
                "greedy": false,
                placeholder: ""
            });

            // 写入提交地址为新增
            modal_submit.attr('data-url', 'cash');

            // 初始化渠道选择框
            $('#u-form-channel_id').selectpicker();
            modal.modal('show');
        });

        // 点击确认提交表单
        modal_submit.on('click', function() {
            // 校验表单
            if (modal_form.valid()) {
                var form_data = modal_form.serialize(),
                    url = modal_submit.attr('data-url');
                form_data += '&game_id=' + $('#u-current-game').attr('data-game_id');
                $.post(url, form_data, function(ret){
                    if (ret.code !== 0) {
                        toastr.error('该提现申请订单创建失败: ' + ret.message, '提现申请失败');
                        return false;
                    }
                    modal.modal('hide'); // 关闭窗口
                    datatable.reload();
                    toastr.success('该提现申请订单创建成功，请等待审核并注意查看支付宝是否到账', '提现申请成功');
                });
            } else {
                toastr.warning('请检查参数然后重试！', '参数不合法');
            }
        });

        // 初始化总体数据显示
        var initData = setInterval(function() {
            if (!datatable.responseData) {
                return false;
            }
            clearInterval(initData);

            var total = datatable.responseData['extend'];

            // 初始化数据
            for(var item in total) {
                $('#u-reward-' + item).text(total[item]);
            }
        }, 50);
    }

    return {
        // public functions
        init: function () {
            demo();
        }
    };
}();

jQuery(document).ready(function () {
    CustomFunction.init();
});
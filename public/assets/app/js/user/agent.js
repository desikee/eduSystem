/**
 * Created by rumi.zhao on 2018/1/4.
 */

var CustomFunction = function () {
    //== Private functions

    // basic demo
    var demo = function () {

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
                        url: 'getList'
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
                width: 40,
                sortable: false, // disable sort for this column
                responsive: {
                    hidden: 10000
                },
                type: 'number',
                textAlign: 'center',
            }, {
                field: "username",
                title: "用户名",
                // width: 150,
                // template: function (row) {
                // 	// callback function support for column rendering
                // 	return row.ShipCountry + ' - ' + row.ShipCity;
                // }
            },{
                field: "email",
                title: "邮箱地址"
            }, {
                field: "company",
                title: "代理公司名称"
            }, {
                field: "created_at",
                title: "创建时间",
            }, {
                field: "action",
                title: "操作",
                // locked: {left: 'xl'},
                sortable: false,
                overflow: 'visible',
                template: function (row) {
                    var id = row.id;
                    return '\
						<a href="javascript:;" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill u-btn-reset" title="重置密码" data-id="' + id + '">\
							<i class="fa flaticon-lock"></i>\
						</a>\
						<a href="javascript:;" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill u-btn-edit" title="编辑" data-id="' + id + '">\
							<i class="fa fa-edit"></i>\
						</a>\
						<a href="javascript:;" class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill u-btn-delete" title="删除" data-id="' + id + '">\
							<i class="fa fa-trash"></i>\
						</a>\
					';
                }
            }]
        });

        // 异步刷新搜索数据
        var query = datatable.getDataSourceQuery();
        var queryTimer, reload_flag = true;

        $('#m_form_search').on('keyup', function (event) {
            // shortcode to datatable.getDataSourceParam('query');
            reload_flag = true;
            var query = datatable.getDataSourceQuery();
            query.usernameSearch = $(this).val().toLowerCase();
            // shortcode to datatable.setDataSourceParam('query', query);
            datatable.setDataSourceQuery(query);

            queryTimer = setTimeout(function(){
                if (reload_flag) {
                    datatable.load();
                    reload_flag = false;
                }
            }, 500);
        }).val(query.usernameSearch);

        // 为每个搜索选择框添加查询事件
        $('.u-search-select').each(function() {
            var query_field = $(this).attr('name');
            $(this).on('change', function() {
                var query = datatable.getDataSourceQuery();
                query[query_field] = $(this).val();
                datatable.setDataSourceQuery(query);
                datatable.load();
            }).val(typeof query[query_field] !== 'undefined' ? query[query_field] : '');
        });
        // 初始化选择框
        $('.u-search-select').selectpicker();

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
                    username: {
                        required: true
                    },
                    company: {
                        required: true
                    },
                    email: {
                        required: true,
                        email: true
                    }
                },
                messages: {
                    username: {
                        required: '请输入用户名！'
                    },
                    company: {
                        required: '请输入用户所在公司！'
                    },
                    email: {
                        required: '请输入邮箱地址！',
                        email: '请输入合法的邮箱地址呢！'
                    }
                }
            });
        // 点击新增按钮处理
        $('.m-content').on('click', '.u-btn-new', function() {
            modal_title.text('新增地推公司');

            form_validate.resetForm();
            // 初始化值
            modal_form.find('input').each(function(i, node) {
                $(node).val('');
            });
            $('#u-modal-form-username').attr('disabled', false);
            // 写入提交地址为新增
            modal_submit.attr('data-url', 'add');
            modal_submit.attr('data-text', '新增');

            // 初始化渠道选择框
            $('#u-form-channel_id').selectpicker();
            modal.modal('show');
        });

        $('.m-content').on('click', '.u-btn-edit', function() {
            var index = $(this).attr('data-id');

            form_validate.resetForm();
            modal_form.find('input').each(function(i, node) {
                $(node).val(datatable.getColumnValue(index, $(this).attr('name')));
            });
            // 用户名不能修改
            $('#u-modal-form-username').attr('disabled', true);
            // 设置标题
            modal_title.text('编辑地推公司');

            // 写入提交地址为新增
            modal_submit.attr('data-url', 'edit');
            modal_submit.attr('data-id', index);
            modal_submit.attr('data-text', '编辑');

            // 初始化渠道选择框
            $('#u-form-channel_id').val(datatable.getColumnValue(index, 'channel_id')).selectpicker();
            modal.modal('show');
        });

        // 点击确认提交表单
        modal_submit.on('click', function() {
            // 校验表单
            if (modal_form.valid()) {
                var form_data = modal_form.serialize(),
                    text = modal_submit.attr('data-text'),
                    url = modal_submit.attr('data-url');
                form_data += '&id=' + $(this).attr('data-id');
                form_data += '&game_id=' + $('#u-current-game').attr('data-game_id');
                $.post(url, form_data, function(ret){
                    if (ret.code !== 0) {
                        toastr.error('该记录' + text + '失败: ' + ret.message, text + '失败');
                        return false;
                    }
                    modal.modal('hide'); // 关闭窗口
                    datatable.reload();
                    toastr.success('该记录已经' + text, text + '成功');
                });
            } else {
                toastr.warning('请检查参数然后重试！', '参数不合法');
            }
        });


        $('.m-content').on('click', '.u-btn-reset', function() {
            var index = $(this).attr('data-id');
            var flavr = new $.flavr({
                title     : '确定要重置密码吗?',
                content: '该用户的密码将会被重置为 idreamsky',
                dialog      : 'confirm',
                animateEntrance: "shake",
                onConfirm   : function(){
                    $.post('reset', {id: index}, function(ret){
                        if (ret.code !== 0) {
                            toastr.error("该用户密码重置失败", "重置失败");
                            return false;
                        }
                        flavr.close(); // 关闭窗口
                        toastr.success("该用户的密码已经被重置为： idreamsky", "重置成功");
                    });
                }
            });
        });

        $('.m-content').on('click', '.u-btn-delete', function() {
            var index = $(this).attr('data-id');
            var flavr = new $.flavr({
                title     : '确定要删除该用户吗?',
                dialog      : 'confirm',
                animateEntrance: "shake",
                onConfirm   : function(){
                    $.post('delete', {id: index}, function(ret){
                        if (ret.code !== 0) {
                            toastr.error("该用户删除失败，请刷新后重试", "删除失败");
                            return false;
                        }
                        flavr.close(); // 关闭窗口
                        datatable.reload();
                        toastr.success("该用户已经被删除", "删除成功");
                    });
                }
            });
        });
    };

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
/**
 * Created by youyouzh on 2018/1/4.
 */
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
                        url: 'getList',
                        params: {game_id: $('#u-current-game').attr('data-game_id')}
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
                sortable: false, // disable sort for this column
                responsive: {
                    hidden: 10000
                },
                type: 'number',
                textAlign: 'center',
            }, {
                field: "appid",
                title: "应用id",
                width: 80,
                type: 'number',
                // sortable: 'asc', // default sort
                filterable: false, // disable or enable filtering
                // basic templating support for column rendering,
                // template: '{{OrderID}} - {{ShipCountry}}'
            }, {
                field: "game_id",
                title: "游戏id",
                width: 80,
                // width: 150,
                // template: function (row) {
                // 	// callback function support for column rendering
                // 	return row.ShipCountry + ' - ' + row.ShipCity;
                // }
            },{
                field: "game_name",
                title: "游戏名称"
            }, {
                field: "platform",
                title: "平台"
            }, {
                field: "channel_id",
                title: "渠道id"
            }, {
                field: "channel_name",
                title: "渠道名称",
                width: 80
            }, {
                field: "link_host",
                title: "首页地址",
                width: 400
            }, {
                field: "download_url",
                title: "下载地址",
                width: 400
            }, {
                field: "action",
                width: 120,
                title: "操作",
                locked: {left: 'xl'},
                sortable: false,
                overflow: 'visible',
                template: function (row) {
                    var id = row.id;
                    return '\
						<a href="javascript:;" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill u-btn-copy" title="另存为" data-id="' + id + '">\
							<i class="fa fa-copy"></i>\
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
                game_id:{
                    required: true,
                },
                game_name: {
                    required: true,
                },
                channel_id: {
                    required: true,
                },
                channel_name: {
                    required: true
                },
                link_host: {
                    required: true,
                    url: true
                },
                download_url: {
                    required: true,
                    url: true
                }
            },
            messages: {
                game_id:{
                    required: '请输入游戏id'
                },
                game_name: {
                    required: '请输入游戏名称'
                },
                channel_id: {
                    required: '请输入渠道id'
                },
                channel_name: {
                    required: '请输入渠道名'
                },
                link_host: {
                    required: '请输入落地页地址',
                    url: '请输入正确的url地址'
                },
                download_url: {
                    required: '请输入包体下载地址',
                    url: '请输入正确的url地址'
                }
            }
        });
        // 点击新增按钮处理
        $('.m-content').on('click', '.u-btn-new', function() {
            modal_title.text('新建链接');
            form_validate.resetForm();
            // 初始化值
            modal_form.find('input').each(function(i, node) {
                $(node).val('');
            });
            // 开发新增渠道号
            $('#channel_id').attr('readonly', false);
            $('#appid').attr('readonly', false);
            $('#game_id').attr('readonly', false);
            $('#game_name').attr('readonly', false);
            // 写入提交地址为新增
            modal_submit.attr('data-url', 'add');
            modal_submit.attr('data-text', '新增');

            modal.modal('show');
        });

        $('.m-content').on('click', '.u-btn-edit', function() {
            var index = $(this).attr('data-id');
            form_validate.resetForm();
            modal_form.find('input').each(function(i, node) {
                $(node).val(datatable.getColumnValue(index, $(this).attr('name')));
            });
            // 不能修改渠道号
            $('#channel_id').attr('readonly', true);
            $('#appid').attr('readonly', true);
            $('#game_id').attr('readonly', true);
            $('#game_name').attr('readonly', true);

            // 设置标题
            modal_title.text('编辑链接');

            // 写入提交地址为新增
            modal_submit.attr('data-url', 'edit');
            modal_submit.attr('data-id', index);
            modal_submit.attr('data-text', '编辑');

            modal.modal('show');
        });

        $('.m-content').on('click', '.u-btn-copy', function() {
            var index = $(this).attr('data-id');

            modal_form.find('input').each(function(i, node) {
                $(node).val(datatable.getColumnValue(index, $(this).attr('name')));
            });

            // 开发新增渠道号
            $('#channel_id').attr('readonly', false);
            $('#appid').attr('readonly', false);
            $('#game_id').attr('readonly', false);
            $('#game_name').attr('readonly', false);

            // 设置标题
            modal_title.text('新建链接');

            // 写入提交地址为新增
            modal_submit.attr('data-url', 'add');
            modal_submit.attr('data-text', '新增');

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
                // form_data += '&game_id=' + $('#u-current-game').attr('data-game_id');
                $.post(url, form_data, function(ret){
                    if (ret.code !== 0) {
                        toastr.error('该记录' + text + '失败: ' + ret.message, text + '失败');
                        return false;
                    }
                    datatable.load();
                    modal.modal('hide'); // 关闭窗口
                    toastr.success('该记录已经' + text, text + '成功');
                });
            } else {
                toastr.warning('请检查参数然后重试！', '参数不合法');
            }
        });


        $('.m-content').on('click', '.u-btn-delete', function() {
            var index = $(this).attr('data-id');
            var flavr = new $.flavr({
                title     : '确定要删除该条链接吗?',
                dialog      : 'confirm',
                animateEntrance: "shake",
                onConfirm   : function(){
                    $.post('delete', {id: index}, function(ret){
                        if (ret.code !== 0) {
                            toastr.error("该链接删除失败，请刷新后重试", "删除失败");
                            return false;
                        }
                        flavr.close(); // 关闭窗口
                        datatable.reload();
                        toastr.success("该链接已经被删除", "删除成功");
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
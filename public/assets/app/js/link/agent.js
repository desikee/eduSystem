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
				sortable: false, // disable sort for this column
                responsive: {
                    hidden: 10000
                },
                class: 'u-hide',
                type: 'number',
				textAlign: 'center',
			}, {
                field: "user_id",
                title: "user_id",
                sortable: false, // disable sort for this column
                responsive: {
                    hidden: 10000
                },
                class: 'u-hide',
                type: 'number',
                textAlign: 'center',
            },{
				field: "mi_link_id",
				title: "id",
                type: 'number',
                // sortable: 'asc', // default sort
				filterable: false, // disable or enable filtering
                width: 80,
				// basic templating support for column rendering,
				// template: '{{OrderID}} - {{ShipCountry}}'
			}, {
				field: "link_name",
				title: "链接名称",
				// width: 150,
				// template: function (row) {
				// 	// callback function support for column rendering
				// 	return row.ShipCountry + ' - ' + row.ShipCity;
				// }
			},{
				field: "action_name",
				title: "活动名称"
            }, {
                field: "user_name",
                title: "链接拥有人"
			}, {
                field: "created_at",
                title: "创建时间",
                width: 150
            }, {
                field: "source_url",
                title: "下载落地页",
                width: 500
            }, {
				field: "transport",
				title: "自定义透传信息",
				// callback function support for column rendering
				// template: function (row) {
				// 	var status = {
				// 		1: {'title': 'Pending', 'class': 'm-badge--brand'},
				// 		2: {'title': 'Delivered', 'class': ' m-badge--metal'},
				// 		3: {'title': 'Canceled', 'class': ' m-badge--primary'},
				// 		4: {'title': 'Success', 'class': ' m-badge--success'},
				// 		5: {'title': 'Info', 'class': ' m-badge--info'},
				// 		6: {'title': 'Danger', 'class': ' m-badge--danger'},
				// 		7: {'title': 'Warning', 'class': ' m-badge--warning'}
				// 	};
				// 	return '<span class="m-badge ' + status[row.Status].class + ' m-badge--wide">' + status[row.Status].title + '</span>';
				// }
			}, {
				field: "action",
				width: 150,
				title: "操作",
                locked: {left: 'xl'},
				sortable: false,
				overflow: 'visible',
				template: function (row) {
                    var id = row.id;
					return '\
						<a href="javascript:;" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill u-btn-share" title="分享" data-id="' + id + '">\
							<i class="fa fa-share-alt"></i>\
						</a>\
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
                    link_name: {
                        required: true
                    },
                    action_name: {
                        required: true
                    },
                    user_id: {
                        required: true
                    }
                },
                messages: {
                    link_name: {
                        required: '请输入链接名称'
                    },
                    action_name: {
                        required: '请输入该链接所用于哪个活动'
                    },
                    user_id: {
                        required: '请选择链接使用人'
                    }
                }
            });
        // 点击新增按钮处理
        $('.m-content').on('click', '.u-btn-new', function() {
            modal_title.text('新建链接');
            // 初始化值
            modal_form.find('input').each(function(i, node) {
                $(node).val('');
            });
            $('#u-modal-form-username').attr('disabled', false);
            // 写入提交地址为新增
            modal_submit.attr('data-url', 'add');
            modal_submit.attr('data-text', '新增');

            // 初始化渠道选择框
            $('#u-form-user_id').selectpicker();
            modal.modal('show');
        });

        $('.m-content').on('click', '.u-btn-edit', function() {
            toastr.warning("一旦链接创建无法编辑，请重新创建链接或者联系系统管理员", "编辑禁用");
            return false;

            var index = $(this).attr('data-id');

            form_validate.resetForm();
            modal_form.find('input').each(function(i, node) {
                $(node).val(datatable.getColumnValue(index, $(this).attr('name')));
            });
            // 设置标题
            modal_title.text('编辑链接');

            // 写入提交地址为新增
            modal_submit.attr('data-url', 'edit');
            modal_submit.attr('data-id', index);
            modal_submit.attr('data-text', '编辑');

            // 初始化渠道选择框
            $('#u-form-user_id').val(datatable.getColumnValue(index, 'user_id')).selectpicker();
            modal.modal('show');
        });

        $('.m-content').on('click', '.u-btn-copy', function() {
            var index = $(this).attr('data-id');

            form_validate.resetForm();
            modal_form.find('input').each(function(i, node) {
                $(node).val(datatable.getColumnValue(index, $(this).attr('name')));
            });

            // 设置标题
            modal_title.text('新建链接');

            // 写入提交地址为新增
            modal_submit.attr('data-url', 'add');
            modal_submit.attr('data-text', '新增');

            // 初始化渠道选择框
            $('#u-form-user_id').val(datatable.getColumnValue(index, 'user_id')).selectpicker();
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
                    datatable.load();
                    modal.modal('hide'); // 关闭窗口
                    toastr.success('该记录已经' + text, text + '成功');
                });
            } else {
                toastr.warning('请检查参数然后重试！', '参数不合法');
            }
        });


        $('.m-content').on('click', '.u-btn-share', function() {
            var index = $(this).attr('data-id'),
                source_url = datatable.getColumnValue(index, 'source_url'),
                link_name = datatable.getColumnValue(index, 'link_name');
            $('#modal-source_url').text(source_url);
            $('#modal-link_name').text(link_name);
            $('#QRCode').QRCode({
                mode : 4,
                text: source_url,
                radius: 30,
                mSize: 30,
                image: $("#modal-game_icon")[0]
            });
            $('#u_modal_share').modal('show');
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
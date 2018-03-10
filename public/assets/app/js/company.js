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
                title: "公司名称"
			}, {
                field: "channel_id",
                title: "专有渠道id"
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

        function form_validate(element){
            var form = $(element).closest('form');

            form.validate({
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
                    },
                    channel_id: {
                        required: true
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
                    },
                    channel_id: {
                        required: '请输入转有渠道id'
                    }
                }
            });

            return form.valid();
        }

        $('.m-content').on('click', '.u-btn-new', function() {
            var form = $('#flarv-dialog-new');

            var flavr = new $.flavr({
                title       : '创建用户',
                // iconPath    : 'flavr/images/icons/',
                // icon        : 'email.png',
                // content     : html,
                dialog      : 'form',
                closeOverlay : true,
                closeEsc     : true,
                animateEntrance: "flipInX",
                animateClosing: "fadeOut",
                form        : { content: form.html() },
                width : 500,
                onSubmit    : function( $container, $form ){
                    if (form_validate($form)) {
                        var form_data = $form.serialize();
                        form_data += '&game_id=' + $('#u-current-game').attr('data-game_id');
                        $.post('add', form_data, function(ret){
                            if (ret.code !== 0) {
                                toastr.error("创建用户失败: " + ret.message, "新增失败");
                                return false;
                            }
                            flavr.close(); // 关闭窗口
                            datatable.reload();
                            toastr.success("已经成功创建用户", "新增成功");
                        });
                    } else {
                        flavr.shake();  // 表单校验失败则晃动窗口
                    }
                    return false;
                }
            });
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
                        datatable.reload();
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

        $('.m-content').on('click', '.u-btn-edit', function() {
            var form = $('#flarv-dialog-new'),
                index = $(this).attr('data-id');

            form.find('input').each(function(i, node) {
                $(node).attr('value', (datatable.getColumnValue(index, $(this).attr('name'))));
            });

            var flavr = new $.flavr({
                title       : '编辑用户',
                // iconPath    : 'flavr/images/icons/',
                // icon        : 'email.png',
                // content     : html,
                dialog      : 'form',
                closeOverlay : true,
                closeEsc     : true,
                animateEntrance: "flipInX",
                animateClosing: "fadeOut",
                form        : { content: form.html() },
                width : 500,
                onSubmit    : function( $container, $form ){
                    if (form_validate($form)) {
                        var form_data = $form.serialize();
                        form_data += '&id=' + index;
                        form_data += '&game_id=' + $('#u-current-game').attr('data-game_id');
                        $.post('edit', form_data, function(ret){
                            if (ret.code !== 0) {
                                toastr.error("该用户编辑失败: " + ret.message, "编辑失败");
                                return false;
                            }
                            flavr.close(); // 关闭窗口
                            datatable.reload();
                            toastr.success("该用户已经编辑成功", "编辑成功");
                        });
                    } else {
                        flavr.shake();  // 表单校验失败则晃动窗口
                    }
                    return false;
                },
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
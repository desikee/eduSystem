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
			}, {
				field: "action",
				width: 50,
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

        // 分享按钮生成二维码
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
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

        // 初始化总体数据显示
        var initData = setInterval(function() {
            if (!datatable.responseData) {
                return false;
            }
            clearInterval(initData);

            var total = datatable.responseData['extend'];

            var percent_1 = (total['used_new'] / (total['used_new'] + total['used_old']) * 100).toFixed(2),
                percent_2 = (total['visited_device'] / total['visited'] * 100).toFixed(2),
                percent_3 = (total['used_new'] / total['used_time_new'] * 100).toFixed(2),
                pay_add = total['pay'] - total['pay_yesterday'],
                percent_4 = (pay_add / total['pay'] * 100).toFixed(2);
            pay_add = pay_add > 0 ? pay_add : 0;

            $('#u-visit-used').text(total['used_new']);
            $('#u-visit-visited').text(total['visited']);

            $('#u-visit-used_old').text(total['used_old']);
            $('#u-visit-visited_device').text(total['visited_device']);
            $('#u-visit-used_time_new').text(total['used_time_new']);

            $('#u-visit-percent-1-text').text(percent_1 + '%');
            $('#u-visit-percent-2-text').text(percent_2 + '%');
            $('#u-visit-percent-3-text').text(percent_3 + '%');
            $('#u-visit-percent-1-bar').css('width', percent_1 + '%');
            $('#u-visit-percent-2-bar').css('width', percent_2 + '%');
            $('#u-visit-percent-3-bar').css('width', percent_3 + '%');
            $('#u-visit-percent-1-bar').attr('aria-valuenow', percent_1);
            $('#u-visit-percent-2-bar').attr('aria-valuenow', percent_2);
            $('#u-visit-percent-3-bar').attr('aria-valuenow', percent_3);

            $('#u-total-pay').text('￥' + (total['pay']).toFixed(2));
            $('#u-total-pay_add').text('￥' + pay_add.toFixed(2));
            $('#u-total-percent-pay-bar').css('width', percent_4 + '%');
            $('#u-total-percent-pay-text').text(percent_4 + '%');
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
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

            return form.valid();
        }

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

        $('.m-content').on('click', '.u-btn-edit', function() {
            var form = $('#flarv-dialog-new'),
                index = $(this).attr('data-id');

            form.find('input').each(function(i, node) {
                $(node).attr('value', (datatable.getColumnValue(index, $(this).attr('name'))));
            });

            var flavr = new $.flavr({
                title       : '编辑记录',
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
                        $.post('edit', form_data, function(ret){
                            if (ret.code !== 0) {
                                toastr.error("该记录编辑失败: " + ret.message, "编辑失败");
                                return false;
                            }
                            flavr.close(); // 关闭窗口
                            datatable.reload();
                            toastr.success("该记录已经编辑成功", "编辑成功");
                        });
                    } else {
                        flavr.shake();  // 表单校验失败则晃动窗口
                    }
                    return false;
                },
            });
        });

        $('.m-content').on('click', '.u-btn-copy', function() {
            var form = $('#flarv-dialog-new'),
                index = $(this).attr('data-id');
            form.find('input').each(function(i, node) {
                $(node).attr('value', (datatable.getColumnValue(index, $(this).attr('name'))));
            });

            var flavr = new $.flavr({
                title       : '复制记录',
                content : '修改下面信息可以将记录另存',
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
                                toastr.error("该记录保存失败: " + ret.message, "另存失败");
                                return false;
                            }
                            flavr.close(); // 关闭窗口
                            datatable.reload();
                            toastr.success("该记录已经成功添加", "另存成功");
                        });
                    } else {
                        flavr.shake();  // 表单校验失败则晃动窗口
                    }
                    return false;
                },
            });

        });

        $('.m-content').on('click', '.u-btn-new', function() {
            var form = $('#flarv-dialog-new');

            form.find('input').each(function(i, node) {
                $(node).attr('value', ''); // 清空参数
            });

            var flavr = new $.flavr({
                title       : '新增记录',
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
                                toastr.error("该记录新增失败: " + ret.message, "新增失败");
                                return false;
                            }
                            flavr.close(); // 关闭窗口
                            datatable.reload();
                            toastr.success("该记录新增成功", "新增成功");
                        });
                    } else {
                        flavr.shake();  // 表单校验失败则晃动窗口
                    }
                    return false;
                }
            });
        });

        $('.m-content').on('click', '.u-btn-delete', function() {
            var index = $(this).attr('data-id');
            var flavr = new $.flavr({
                title     : '确定要删除该条记录吗?',
                dialog      : 'confirm',
                animateEntrance: "shake",
                onConfirm   : function(){
                    $.post('delete', {id: index}, function(ret){
                        if (ret.code !== 0) {
                            toastr.error("该记录删除失败，请刷新后重试", "删除失败");
                            return false;
                        }
                        flavr.close(); // 关闭窗口
                        datatable.reload();
                        toastr.success("该记录已经被删除", "删除成功");
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
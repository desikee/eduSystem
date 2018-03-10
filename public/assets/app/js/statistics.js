/**
 * Created by rumi.zhao on 2018/1/4.
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
                field: "person_name",
                title: "链接拥有人"
            }, {
                field: "source_url",
                title: "下载落地页",
            },{
                field: "visited",
                title: "访问量",
            },{
                field: "used",
                title: "激活量",
            }]
        });

        // 异步刷新搜索数据
        var query = datatable.getDataSourceQuery();

        $('#m_form_search').on('keyup', function (e) {
            // shortcode to datatable.getDataSourceParam('query');
            var query = datatable.getDataSourceQuery();
            query.generalSearch = $(this).val().toLowerCase();
            // shortcode to datatable.setDataSourceParam('query', query);
            datatable.setDataSourceQuery(query);
            datatable.load();
        }).val(query.generalSearch);

        $('#m_form_action_name').on('change', function () {
            // shortcode to datatable.getDataSourceParam('query');
            var query = datatable.getDataSourceQuery();
            query.action_name = $(this).val().toLowerCase();
            // shortcode to datatable.setDataSourceParam('query', query);
            datatable.setDataSourceQuery(query);
            datatable.load();
        }).val(typeof query.action_name !== 'undefined' ? query.action_name : '');

        $('#m_form_person_name').on('change', function () {
            // shortcode to datatable.getDataSourceParam('query');
            var query = datatable.getDataSourceQuery();
            query.person_name = $(this).val().toLowerCase();
            // shortcode to datatable.setDataSourceParam('query', query);
            datatable.setDataSourceQuery(query);
            datatable.load();
        }).val(typeof query.person_name !== 'undefined' ? query.person_name : '');

        $('#m_form_action_name, #m_form_person_name').selectpicker();

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
                    link_name: {
                        required: true,
                    },
                    person_name: {
                        required: true
                    },
                    action_name: {
                        required: true
                    }
                },
                messages: {
                    link_name: {
                        required: '请输入链接名称！'
                    },
                    person_name: {
                        required: '请输入链接使用人！'
                    },
                    action_name: {
                        required: '请输入该链接所用于哪个活动'
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
                title       : '编辑链接',
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
                                toastr.error("该链接编辑失败: " + ret.message, "编辑失败");
                                return false;
                            }
                            flavr.close(); // 关闭窗口
                            datatable.reload();
                            toastr.success("该链接已经编辑成功", "编辑成功");
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
                title       : '复制链接',
                content : '修改下面信息可以将链接另存',
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
                                toastr.error("该链接保存失败: " + ret.message, "另存失败");
                                return false;
                            }
                            flavr.close(); // 关闭窗口
                            datatable.reload();
                            toastr.success("该链接已经成功添加", "另存成功");
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
                title       : '新建链接',
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
                                toastr.error("该链接新增失败: " + ret.message, "新增失败");
                                return false;
                            }
                            flavr.close(); // 关闭窗口
                            datatable.reload();
                            toastr.success("该链接新增成功", "新增成功");
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
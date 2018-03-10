<!DOCTYPE html>
<html lang="en" xmlns:v-bind="http://www.w3.org/1999/xhtml" xmlns:v-on="http://www.w3.org/1999/xhtml">
<!-- begin::Head -->
<head>
    <meta charset="utf-8" />
    <title>
        Vue测试页面
    </title>
    <meta name="description" content="Initialized with local json data">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

</head>
<!-- end::Head -->

<!-- end::Body -->
<body>
<div id="app">
    <span v-bind:title="message">
        当前时间：@{{ message }}
    </span>
    <button v-on:click="refreshTime">刷新时间</button>
    <br>
    <span v-if="show">
        显示：@{{ show_text }}
    </span>
    <input v-model="show_text">
    <hr>
    <ol>
        <li v-for="item in list">
            @{{ item.text }}
        </li>
        <li-item
            v-for="item in c_list"
            v-bind:li="item"
            v-bind:key="item.id">
        </li-item>
    </ol>
</div>

<script src="/assets/vue.js" type="text/javascript"></script>
<script type="text/javascript">

    Vue.component('li-item', {
        props: ['li'],
        template: '<li>@{{ li.text }}</li>'
    });

    var app = new Vue({
        el: '#app',
        data: {
            message: new Date().toLocaleString(),
            show: true,
            list:[
                { text: 'PHP'},
                { text: 'Java'},
                { text: 'C++'}
            ],
            c_list:[
                { id:1, text: 'PHP'},
                { id:2, text: 'Java'},
                { id:3, text: 'C++'}
            ],
            show_text: 'ok'
        },
        methods: {
            refreshTime: function() {
                this.message = new Date().toLocaleString()
            }
        }
    })
</script>
</body>
<!-- end::Body -->
</html>

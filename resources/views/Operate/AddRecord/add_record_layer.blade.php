<html ng-app="app" lang="zh-CN">

<head>
    <title>添加记录</title>
    @include('Global.global_header')
    <link rel="stylesheet" href="/css/page.css">
    <link rel="stylesheet" type="text/css" href="/css/bootstrap-datepicker.css">

    <script type="text/javascript" src="/js/bootstrap-datepicker.min.js" charset="utf-8"></script>
    <script type="text/javascript" src="/js/bootstrap-datepicker.zh-CN.min.js" charset="utf-8"></script>
    <script src="/js/add_record.js"></script>
    @include('Global.global_navbar')
</head>

<body>
    @include('Operate.AddRecord.add_record_contents')
    @include('Global.global_footer')
</body>

</html>
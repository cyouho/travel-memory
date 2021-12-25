<html lang="zh-CN">

<head>
    @include('Global.global_header')
    <link rel="stylesheet" href="/css/page.css">
    <link rel="stylesheet" type="text/css" href="/css/bootstrap-datepicker.css">

    <script type="text/javascript" src="/js/bootstrap-datepicker.min.js" charset="utf-8"></script>
    <script type="text/javascript" src="/js/bootstrap-datepicker.zh-CN.min.js" charset="utf-8"></script>
    <script src="/js/china_province_city_map.js"></script>
    <script src="/js/city_detail.js"></script>
    @include('Global.global_navbar')
</head>

<body>
    @include('City.city_contents')
    @include('Global.global_footer')
    @include('City.city_detail_modal')
    @include('City.city_detail_amend_modal')
</body>

</html>
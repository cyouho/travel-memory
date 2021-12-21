<html lang="zh-CN">

<head>
    @include('Global.global_header')
    <link rel="stylesheet" href="/css/page.css">
    <script src="/js/china_province_city_map.js"></script>
    <script src="/js/city_detail.js"></script>
    @include('Global.global_navbar')
</head>

<body>
    @include('City.city_contents')
    @include('Global.global_footer')
    @include('City.city_detail_modal')
</body>

</html>
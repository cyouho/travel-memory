<html lang="zh-CN">

<head>
    <title>个人主页</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('Global.global_header')
    <link rel="stylesheet" href="/css/page.css">
    <script src="/js/travel_detail_page.js"></script>
    @include('Global.global_navbar')
</head>

<body>
    @include('Home.TravelDetail.travel_detail_contents')
    @include('Global.global_footer')
</body>

</html>
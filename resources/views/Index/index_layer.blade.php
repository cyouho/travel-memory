<html lang="zh-CN">

<head>
    @include('Global.global_header')
    <link rel="stylesheet" href="/css/page.css">
    <script src="/js/chain_map.js"></script>
    <script src="/js/index.js"></script>
    @include('Global.global_navbar')
</head>

<body>
    @if (isset($data) && !$data['isLogin'])
    @include('Index.index_login_contents')
    @else
    @include('Index.index_contents')
    @endif
    @include('Global.global_footer')
</body>

</html>
<html lang="zh-CN">

<head>
    @if (isset($data) && !$data['isLogin'])
    @include('Global.global_header_unlogin')
    <link rel="stylesheet" href="/css/page.css">
    @include('Global.global_navbar')
    @else
    @include('Global.global_header')
    <link rel="stylesheet" href="/css/page.css">
    <script src="/js/chain_map.js"></script>
    <script src="/js/index.js"></script>
    @include('Global.global_navbar')
    @endif
</head>

<body>
    @if (isset($data) && !$data['isLogin'])
    @include('Index.index_unlogin_contents')
    @else
    @include('Index.index_contents')
    @endif
    @include('Global.global_footer')
</body>

</html>
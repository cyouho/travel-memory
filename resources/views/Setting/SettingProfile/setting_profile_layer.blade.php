<html>

<head>
    <title>设置</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('Global.global_header')
    <link rel="stylesheet" href="/css/page.css">
    <script src="/js/setting_page.js"></script>
    @include('Global.global_navbar')
</head>

<body id="profile">
    @include('Setting.SettingProfile.setting_profile_contents')
    @include('Global.global_footer')
</body>

</html>
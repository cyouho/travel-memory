<nav class="navbar navbar-expand-sm navbar-custom fixed-top">
    <!-- Brand/logo -->
    <a class="navbar-brand" href="/">旅行回忆</a>

    @if (isset($data) && $data['isLogin'])
    <!-- Left Links -->
    <ul class="navbar-nav">
        <!-- Dropdown -->
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                操作
            </a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="/addRecord" target="_blank">添加记录</a>
            </div>
        </li>
    </ul>
    <ul class="navbar-nav navbar-text m-auto">
        <li class="nav-item">
            <!-- Index navbar -->
            @if (isset($province['province_name']))
            <a class="nav-text font-weight-bold" id="province_gone" province-name="{{$province['province_name']}}" province-adcode="{{$province['province_adcode']}}">
                {{$province['province_name']}}
            </a>
            @else
            <!-- Province navbar -->
            <a class="nav-text font-weight-bold" id="province_gone">

            </a>
            @endif
        </li>
    </ul>
    @endif

    <!-- Right Links-->
    <ul class="navbar-nav ml-auto">
        @if (isset($data) && !$data['isLogin'])
        <li class="nav-item">
            <a class="nav-link" href="/register">注册</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/login">登录</a>
        </li>
        @else
        <div class="dropdown">
            <a class="nav-link dropdown-toggle user" href="#" id="navbardroplogin" data-toggle="dropdown" user-id="{{$data['userId']}}">
                {{$data['userName']}}
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="/home">个人主页</a>
                <a class="dropdown-item" href="/travelDetail">旅行详情</a>
                <a class="dropdown-item" href="/setting/profile">设置</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="/logout">退出</a>
            </div>
        </div>
        @endif
    </ul>
</nav>
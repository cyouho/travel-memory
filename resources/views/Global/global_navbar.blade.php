<nav class="navbar navbar-expand-sm navbar-custom fixed-top">
    <!-- Brand/logo -->
    <a class="navbar-brand" href="/">Travel Memory</a>

    @if (isset($data) && $data['isLogin'])
    <!-- Left Links -->
    <ul class="navbar-nav">
        <!-- Dropdown -->
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                Dropdown link
            </a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="#">Link 1</a>
                <a class="dropdown-item" href="#">Link 2</a>
                <a class="dropdown-item" href="#">Link 3</a>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Link 2</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Link 3</a>
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
                <a class="dropdown-item" href="/myPage">个人主页</a>
                <a class="dropdown-item" href="/profile">设置</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="/logout">退出</a>
            </div>
        </div>
        @endif
    </ul>
</nav>
<nav class="navbar navbar-expand-sm navbar-custom fixed-top">
    <!-- Brand/logo -->
    <a class="navbar-brand" href="#">Travel Memory</a>

    <!-- Left Links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" href="#">Link 1</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Link 2</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Link 3</a>
        </li>
    </ul>

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
            <button type="button" class="btn nav-link dropdown-toggle" data-toggle="dropdown">
                {{$data['userName']}}
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="/myPage">个人主页</a>
                <a class="dropdown-item" href="/profile">设置</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="/logout">退出</a>
            </div>
        </div>
        @endif
    </ul>
</nav>
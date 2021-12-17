<div>
    <div class="home-top"></div>
    <div class="row">
        @include('Setting.setting_sidebar')
        <div class="col-sm-9 p-3 container-fluid home-contents-page" id="home-contents">
            <div class="container">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#home">修改用户名</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#menu1">修改密码</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#menu2">Menu 2</a>
                    </li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <div id="home" class="container tab-pane active"><br>
                        <form action="/newName" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="usr" class="word">新用户名:</label>
                                <input type="text" class="form-control" id="usr" name="new_user_name">
                                <input type="hidden" name="user_id" value="{{ $data['userId'] }}">
                            </div>
                            <button type="submit" class="btn btn-primary" id="submit">提交</button>
                        </form>
                        @if(!empty(session('success')))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            {{session('success')}}
                        </div>
                        @endif
                        @foreach($errors->all() as $error)
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            {{ $error }}
                        </div>
                        @endforeach
                    </div>
                    <div id="menu1" class="container tab-pane fade"><br>
                        <h3>Menu 1</h3>
                        <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                    </div>
                    <div id="menu2" class="container tab-pane fade"><br>
                        <h3>Menu 2</h3>
                        <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
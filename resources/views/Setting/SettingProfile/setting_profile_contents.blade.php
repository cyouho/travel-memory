<div>
    <div class="home-top"></div>
    <div class="row">
        @include('Setting.setting_sidebar')
        <div class="col-sm-9 p-3 container-fluid home-contents-page" id="home-contents">
            <div class="container">
                <h3 class="word font-weight-bold">修改用户名</h3>
                <form action="/newName" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="usr" class="word">新用户名:</label>
                        <input type="text" class="form-control" id="usr" name="new_user_name">
                        <input type="hidden" name="user_id" value="{{ $data['userId'] }}">
                    </div>
                    <button type="submit" class="btn btn-primary" id="name_submit">提交</button>
                </form>
                @if(!empty(session('update_name_success')))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    {{session('update_name_success')}}
                </div>
                @endif
                @if ($errors->update_name_errMSG->first())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    {{ $errors->update_name_errMSG->first() }}
                </div>
                @endif

                <br><br>
                <div class="dropdown-divider divider-border-top-color"></div><br><br>
                <h3 class="word font-weight-bold">修改用户密码</h3>
                <form action="/newPassword" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="usr_old_pwd" class="word">旧密码:</label>
                        <input type="password" class="form-control" id="usr_old_pwd" name="old_user_pwd">
                        <label for="usr_new_pwd" class="word">新密码:</label>
                        <input type="password" class="form-control" id="usr_new_pwd" name="new_user_pwd">
                        <input type="hidden" name="user_id" value="{{ $data['userId'] }}">
                    </div>
                    <button type="submit" class="btn btn-primary" id="password_submit">提交</button>
                </form>
                @if(!empty(session('update_password_success')))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    {{session('update_password_success')}}
                </div>
                @endif
                @if ($errors->update_password_errMSG->first())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    {{ $errors->update_password_errMSG->first() }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
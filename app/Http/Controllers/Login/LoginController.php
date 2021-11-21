<?php

namespace App\Http\Controllers\Login;

use App\Http\Controllers\Controller;
use App\Models\User\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class LoginController extends Controller
{
    //
    private $_message = [];

    public function __construct()
    {
        $this->_message = config('message');
    }

    public function showLoginPage()
    {
        return view('Login.login');
    }

    public function doLogin(Request $request)
    {
        $user = new User();
        $email = $request->input('login_email');
        $password = $request->input('login_pwd');
        $userId = $user->getUserId(['user_email' => $email]);
        $data = [
            'user_email' => $email,
        ];

        if (!$userId) {
            return view('login.login', ['errMSG' => [
                'id' => $this->_message['error_message']['login']['not_exist_user_id'],
            ]]);
        } else if (!$user->checkUserPwd($password, $data)) {
            return view('login.login', ['errMSG' => [
                'pwd' => $this->_message['error_message']['login']['password_error']
            ]]);
        }

        $loginTime = time();
        $user->updateLastLoginTime($loginTime, $email);
        $user->updateTotalLoginTimes($email);

        // 获取 admin 登录记录
        $user->updateAdminLoginInfo($loginTime, $email);

        $cookie = $user->getSeesion($email);
        return response()->redirectTo('/')->cookie('_cyouho', $cookie, 60);
    }

    public function doLogout()
    {
        $cookie = Cookie::forget('_cyouho');
        return response()->redirectTo('/')->cookie($cookie);
    }
}

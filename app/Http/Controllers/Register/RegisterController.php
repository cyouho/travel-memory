<?php

namespace App\Http\Controllers\Register;

use App\Http\Controllers\Controller;
use App\Models\User\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    //
    private $_message = [];

    public function __construct()
    {
        $this->_message = config('message');
    }

    public function showRegisterPage()
    {
        return view('Register.register');
    }

    public function doRegister(Request $request)
    {
        $user = new User();
        $email = $request->input('register_email');
        $password = $request->input('register_pwd');
        $userId = $user->getUserId(['user_email' => $email]);

        // 如果没有user ID就生成新的ID
        if (!$userId) {
            $cookie = $user->RegisterSet($email, $password);
        } else {
            return view('register.register', ['errMSG' => $this->_message['error_message']['register']['existed_user']]);
        }

        return response()->redirectTo('/')->cookie('_cyouho', $cookie, 60);
    }
}

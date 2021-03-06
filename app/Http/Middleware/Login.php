<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User\User;
//use App\Models\Admin\Admin;

class Login
{
    /**
     * Handle an incoming request.
     * Check it if Login.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $cookie = request()->cookie('_cyouho');
        $adminCookie = request()->cookie('_zhangfan');

        //$cookie ? view()->share('isLogin', true) : view()->share('isLogin', false);

        if ($cookie) {
            $user = new User();
            $userName = $user->getUserName($cookie);
            $userId = $user->getUserId(['user_session' => $cookie]);
            $data = [
                'isLogin'  => true,
                'userName' => $userName,
                'userId'   => $userId[0]->user_id,
            ];
            view()->share('data', $data);
        } else {
            view()->share('data', ['isLogin' => false]);
        }

        return $next($request);
    }
}

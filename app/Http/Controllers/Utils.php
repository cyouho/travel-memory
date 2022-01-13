<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Utils extends Controller
{
    /**
     * 获取用户 cookie
     */
    public static function getCookie()
    {
        return request()->cookie('_cyouho');
    }

    /**
     * 获取管理员 cookie
     */
    public static function getAdminCookie()
    {
        return request()->cookie('_zhangfan');
    }

    /**
     * 将对象 object 转换成数组 array
     */
    public static function getArrFromObj($data)
    {
        return array_map('get_object_vars', $data);
    }
}

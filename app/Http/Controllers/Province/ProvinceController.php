<?php

namespace App\Http\Controllers\Province;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProvinceController extends Controller
{
    //
    public function index($province = 'others')
    {
        return view('Province.province_layer', ['province' => $province]);
    }

    public function chinaProvinceMapDataAjax()
    {
    }
}

<?php

namespace App\Http\Controllers\City;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Map\ProvinceMap;

class CityController extends Controller
{
    //
    private $_map = [];

    public function __construct()
    {
        $this->_map = config('map');
    }

    public function index($province = 'others', $city = 'others')
    {
        if ($city == 'others') return view('Province.province_layer');

        $provinceAdcode = $this->_map['city'][$province][$city];

        return view('City.city_layer', [
            'province' => [
                'province_name' => $city,
                'province_adcode' => $provinceAdcode,
            ], // e.g. '云南省' => 530000
        ]);
    }

    public function chinaProvinceCityMapDataAjax(Request $request)
    {
        $formData = $request->post();
        $provinceName = $formData['province'];
        $userId = $formData['userId'];

        $province = new ProvinceMap();
        $chinaProvinceMapData = $province->getChinaProvinceMapDataAll($userId, $provinceName);

        return response()->json($chinaProvinceMapData)->setEncodingOptions(JSON_UNESCAPED_UNICODE);
    }
}

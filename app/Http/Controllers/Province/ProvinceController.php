<?php

namespace App\Http\Controllers\Province;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Map\ProvinceMap;

class ProvinceController extends Controller
{
    //
    private $_map = [];

    public function __construct()
    {
        $this->_map = config('map');
    }

    public function index($province = 'others')
    {
        if ($province == 'others') return view('Province.province_layer');

        $provinceAdcode = $this->_map['nation']['中国'][$province];
        dd($this->getProvinceCity($provinceAdcode));
        return view('Province.province_layer', [
            'province' => [
                'province_name' => $province,
                'province_adcode' => $provinceAdcode,
            ], // e.g. '云南省' => 530000
        ]);
    }

    public function chinaProvinceMapDataAjax(Request $request)
    {
        $formData = $request->post();
        $provinceName = $formData['province'];
        $userId = $formData['userId'];

        $province = new ProvinceMap();
        $chinaProvinceMapData = $province->getChinaProvinceMapDataAll($userId, $provinceName);

        // $test = $this->_map['city']['云南省'];
        // $data = [];
        // $data = array_pad($data, 16, ['name' => 'a', 'value' => 0]);
        // //dd($test);
        // $i = 0;
        // foreach ($test as $key => $value) {
        //     $data[$i] = [
        //         'name' => $key,
        //         'value' => 0,
        //     ];
        //     $i++;
        // }
        return response()->json($chinaProvinceMapData)->setEncodingOptions(JSON_UNESCAPED_UNICODE);
    }

    /**
     * 生成数据用，暂时不要删！
     */
    public function getProvinceCity($provinceAdcode)
    {
        $test = file_get_contents(public_path() . "../js/map/province/" . $provinceAdcode . ".json");
        $a = json_decode($test, true);

        $count = count($a['features']);
        //dd($a);
        $b = [];
        $b = array_pad($b, $count, ['adcode' => 0, 'name' => 'a']);

        foreach ($a['features'] as $key => $value) {
            $b[$key] = [
                'adcode' => $value['properties']['adcode'],
                'name' => $value['properties']['name']
            ];
        }

        dd($b);
    }
}

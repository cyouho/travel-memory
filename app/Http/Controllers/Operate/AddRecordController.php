<?php

namespace App\Http\Controllers\Operate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AddRecordController extends Controller
{
    //
    private $_map = [];

    public function __construct()
    {
        $this->_map = config('map');
    }

    public function index()
    {
        $data = [
            'province' => $this->_map['nation']['中国'],
            'region'   => $this->_map['city']['北京市'],
        ];

        return view('Operate.AddRecord.add_record_layer', $data);
    }

    public function firstChinaProvinceCityRegionMapDataAjax(Request $request)
    {
        $formdata = $request->post();
        $data = $formdata['province'];

        if ($data == '-') return view('Operate.AddRecord.add_record_ajax_result', ['city' => ['-' => 0]]);

        $result = [
            'city' => $this->_map['city'][$data],
        ];

        return view('Operate.AddRecord.add_record_ajax_result', $result);
    }

    public function secondChinaProvinceCityRegionMapDataAjax(Request $request)
    {
        $formdata = $request->post();
        $province = $formdata['province'];
        $city = $formdata['city'];

        if ($city == '-') return view('Operate.AddRecord.add_record_ajax_result', ['city' => ['-' => 0]]);

        if ($city == 'first' && $province != '-') {
            $result = [
                'city' => array_shift($this->_map['region'][$province]),
            ];

            return view('Operate.AddRecord.add_record_ajax_result', $result);
        }

        if ($province == '-') return view('Operate.AddRecord.add_record_ajax_result', ['city' => ['-' => 0]]);

        $result = [
            'city' => $this->_map['region'][$province][$city],
        ];

        return view('Operate.AddRecord.add_record_ajax_result', $result);
    }
}

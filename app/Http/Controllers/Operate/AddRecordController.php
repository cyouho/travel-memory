<?php

namespace App\Http\Controllers\Operate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Operate\Record;

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

    public function addNewRecord(Request $request)
    {
        $formdata = $request->post();
        $province = $formdata['province'];
        $city = $formdata['city'];
        $region = $formdata['region'];
        $travelDate = $formdata['travelDate'];
        $userId = $formdata['userId'];
        $timestamp = time();
        $spotName = $formdata['travel_dest'];
        $remark = $formdata['remark'];
        $insertTravelData = [
            'user_id'          => $userId,
            'province_adcode'  => $this->_map['nation']['中国'][$province],
            'province'         => $province,
            'city_adcode'      => $city !== '-' ? $this->_map['city'][$province][$city] : 0,
            'city'             => $city,
            'region_adcode'    => $region !== '-' ? $this->_map['region'][$province][$city][$region] : 0,
            'region'           => $region,
            'travel_date'      => strtotime($travelDate),
            'record_create_at' => $timestamp,
            'record_update_at' => $timestamp,
        ];
        $record = new Record();

        // 使用 insertGetId 获取插入后的自增id | 插入内容: 旅行地点，旅行时间
        $recordId = $record->insertTravelRecord($insertTravelData);

        // 使用框架自带 insert 插入 | 插入内容: 景点名，备注
        $this->addTravelDetail($recordId, $userId, $spotName, $remark);

        // 插入全部数据后跳转至添加记录页面 addRecord
        return response()->redirectTo('/addRecord');
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

    /**
     * 添加旅行详细 | 插入内容: 景点名，备注
     * @param string $travelId
     * @param int $userId
     * @param string $spotName
     * @param string $remark
     */
    public function addTravelDetail($travelId, $userId, $spotName, $remark)
    {
        $data = [
            'travel_id' => $travelId,
            'user_id'   => $userId,
            'spot_name' => $spotName,
            'remark'    => $remark,
        ];

        $record = new Record();
        $record->insertTravelDetail($data);
    }
}

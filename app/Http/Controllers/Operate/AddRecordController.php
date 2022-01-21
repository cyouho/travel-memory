<?php

namespace App\Http\Controllers\Operate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Operate\Record;

/**
 * 添加旅行详细记录
 * 
 * @author cyouho@hotmail.co.jp
 */
class AddRecordController extends Controller
{
    /**
     * 初始化地图数组
     */
    private $_map = [];

    /**
     * 初始化地图数组数据
     */
    public function __construct()
    {
        $this->_map = config('map');
    }

    /**
     * 显示添加记录页面
     * 
     * @return array $data | e.g. key: province, region
     */
    public function index()
    {
        $data = [
            'province' => $this->_map['nation']['中国'],
            'region'   => $this->_map['city']['北京市'],
        ];

        return view('Operate.AddRecord.add_record_layer', $data);
    }

    /**
     * 添加旅行记录主要方法
     * 
     * @param  Request  $request     <传入的参数>
     * @return redirect '/addRecord' <重定向到 addRecord 页面>
     */
    public function addNewRecord(Request $request)
    {
        $formdata = $request->post();
        $province = $formdata['province'];
        $city = is_null($formdata['city']) ? '-' : $formdata['city'];
        $region = is_null($formdata['region']) ? '-' : $formdata['region'];
        $travelDateStart = $formdata['travelDateStart'];
        $travelDateEnd = is_null($formdata['travelDateEnd']) ? '-' : $formdata['travelDateEnd'];
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
            'travel_date'      => strtotime($travelDateStart),
            'travel_date_end'  => strtotime($travelDateEnd),
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
     * 
     * @param string $travelId <旅行Id>
     * @param int    $userId   <用户Id>
     * @param string $spotName <景点名>
     * @param string $remark   <备注内容>
     */
    public function addTravelDetail($travelId, $userId, $spotName, $remark): void
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

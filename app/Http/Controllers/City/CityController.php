<?php

namespace App\Http\Controllers\City;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Map\RegionMap;
use App\Models\Operate\Record;

class CityController extends Controller
{
    //
    private $_map = [];

    /**
     * 地图详细数据分页每页显示数据量
     */
    private $_showPerPage = 5;

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

    public function chinaProvinceCityRegionMapDataAjax(Request $request)
    {
        $formData = $request->post();
        $cityName = $formData['province'];
        $userId = $formData['userId'];

        $province = new RegionMap();
        $chinaProvinceMapData = $province->getChinaProvinceCityRegionMapDataAll($userId, $cityName);

        return response()->json($chinaProvinceMapData)->setEncodingOptions(JSON_UNESCAPED_UNICODE);
    }

    public function getChinaProvinceDetailAjax(Request $request)
    {
        $formData = $request->post();
        $userId = $formData['user_id'];
        $province = $formData['province'];
        $date = $formData['date'];
        $page = $formData['page'];

        if ($date == '30days' || $date == '3months') {
            switch ($date) {
                case '30days':
                    $date = '30 DAY';
                    break;
                case '3months':
                    $date = '3 MONTH';
                    break;
                default:
                    $date = '30 DAY';
            }
            $travelDetail = $this->getChinaProvinceRecordDetailData($userId, $province, $page, (string)$date, $symbol = 'inAYear');
            $totalTravelRecord = $this->countTotalTravelRecord($userId, $province, $date, $symbol = 'inAYear');
        } else {
            $travelDetail = $this->getChinaProvinceRecordDetailData($userId, $province, $page, $date);
            $totalTravelRecord = $this->countTotalTravelRecord($userId, $province, $date);
        }

        return view('City.city_detail', [
            'detail' => [
                'travel_detail' => $travelDetail,
                'paginate'      => [
                    'total_page' => $totalTravelRecord,
                    'now_page'   => $page,
                ],
            ]
        ]);
    }

    public function getTravelDateDetailAjax(Request $request)
    {
        $formData = $request->post();
        $userId = $formData['user_id'];
        $province = $formData['province'];

        $travelRecordYear = $this->getTravelRecordByYear($userId, $province);

        return view('Province.province_date', [
            'date' => $travelRecordYear,
        ]);
    }

    /**
     * 显示旅行详细表格的 ajax 方法
     */
    public function travelDetailModalAjax(Request $request)
    {
        $formData = $request->post();
        $userId = $formData['userId'];
        $recordId = $formData['recordId'];

        $record = new Record();
        $travelDetail = $record->selectTravelDetail($userId, $recordId);

        if (isset($travelDetail[0])) {
            if (is_null($travelDetail[0]->spot_name)) $travelDetail[0]->spot_name = '-';
            if (is_null($travelDetail[0]->remark)) $travelDetail[0]->remark = '-';

            return response()->json($travelDetail[0])->setEncodingOptions(JSON_UNESCAPED_UNICODE);
        }

        return response()->json(['spot_name' => '-', 'remark' => '-'])->setEncodingOptions(JSON_UNESCAPED_UNICODE);
    }

    /**
     * 修改显示旅行详细表格的 ajax 方法
     */
    public function amendTravelDetailAjax(Request $request)
    {
        $formData = $request->post();
        $userId = $formData['userId'];
        $recordId = $formData['amendRecordId'];
        $beforeStart = $formData['beforeStart'];
        $beforeEnd = $formData['beforeEnd'];
        $start = $formData['amendStart'];
        $end = $formData['amendEnd'];

        $updateData = [
            'travel_date'     => (string)strtotime($start),
            'travel_date_end' => $end ? (string)strtotime($end) : ($start > $beforeEnd ? '-' : (string)strtotime($end)),
        ];

        foreach ($updateData as $key => &$value) {
            if (empty($value)) {
                unset($updateData[$key]);
            }
        }
        unset($value);

        if (!empty($updateData)) {
            $record = new Record();
            $record->updateTravelRecord($userId, $recordId, $updateData);
            return response()->json(true);
        }
    }

    /**
     * 获取分页时，每页的数据
     */
    public function getChinaProvinceRecordDetailData($userId, $province, $page, $date, $symbol = 'outAYear')
    {
        $map = new RegionMap();
        $num = $this->_showPerPage;
        $page = ($page - 1) * $num;

        if ($symbol == 'inAYear') {
            $result = $map->getChinaProvinceDetailData($userId, $province, $page, $num, $date);
        } else {
            $result = $map->getChinaProvinceDetailDataByYear($userId, $province, $page, $num, $date);
        }

        return $result;
    }

    /**
     * 计算最大分页数
     */
    public function countTotalTravelRecord($userId, $province, $date, $symbol = 'outAYear')
    {
        $map = new RegionMap();

        if ($symbol == 'inAYear') {
            $result = $map->countTravelDetailRecord($userId, $province, $date);
        } else {
            $result = $map->countTravelDetailRecordByYear($userId, $province, $date);
        }

        $maxPage = ceil($result[0]->total_page / $this->_showPerPage);

        return $maxPage;
    }

    /**
     * 获取旅游了多少年
     */
    public function getTravelRecordByYear($userId, $province)
    {
        $map = new RegionMap();
        $result = $map->getTravelRecordByYear($userId, $province);

        return $result;
    }
}

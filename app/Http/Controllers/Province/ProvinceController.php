<?php

namespace App\Http\Controllers\Province;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Map\ProvinceMap;
use App\Http\Controllers\Utils;
use App\Models\User\User;
use phpDocumentor\Reflection\DocBlock\Tags\Var_;

class ProvinceController extends Controller
{
    //
    private $_map = [];

    /**
     * 地图详细数据分页每页显示数据量
     */
    private $_showPerPage = 5;

    /**
     * 获取地图参数
     */
    public function __construct()
    {
        $this->_map = config('map');
    }

    /**
     * 显示 province (省/自治区/直辖市) 首页
     * 
     * @param string $province <省份名称>
     * 
     * @return array $province <省份名, 省份代码>
     */
    public function index($province = 'others')
    {
        if ($province == 'others') return view('Province.province_layer');

        $provinceAdcode = $this->_map['nation']['中国'][$province];

        return view('Province.province_layer', [
            'province' => [
                'province_name'   => $province,
                'province_adcode' => $provinceAdcode,
            ], // e.g. '云南省' => 530000
        ]);
    }

    /**
     * 获取 省/自治区/直辖市 地图信息 ajax 方法
     */
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
     * 显示按照 日期 获取的 省/自治区/直辖市 信息
     */
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

        return view('Province.province_detail', [
            'detail' => [
                'travel_detail' => $travelDetail,
                'paginate'      => [
                    'total_page' => $totalTravelRecord,
                    'now_page'   => $page,
                ],
                'province_name'  => $province,
            ]
        ]);
    }

    /**
     * 获取可以显示旅行记录的 日期
     */
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
     * 获取分页时，每页的数据
     */
    public function getChinaProvinceRecordDetailData($userId, $province, $page, $date, $symbol = 'outAYear')
    {
        $map = new ProvinceMap();
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
        $map = new ProvinceMap();

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
        $map = new ProvinceMap();
        $result = $map->getTravelRecordByYear($userId, $province);

        return $result;
    }

    /**
     * 生成数据用，暂时不要删！
     */
    public function getProvinceCity($provinceAdcode)
    {
        $test = file_get_contents(public_path() . "/js/map/province/" . $provinceAdcode . ".json");
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

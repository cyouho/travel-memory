<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Operate\Record;
use Illuminate\Http\Request;

class DetailController extends Controller
{
    //
    public function index()
    {
        return view('Home.TravelDetail.travel_detail_layer');
    }

    /**
     * 获取近一年的旅行天数记录
     */
    public function getTravelRecordInAYearForCalendar($userId)
    {
        $record = new Record();
        $result = $record->selectTravelRecord($userId);

        $tests = $result;
        $array = [];
        $j = 0;
        foreach ($tests as $test) {
            $origin = date_create($test->travel_date);
            $target = date_create($test->travel_date_end);
            $interval = date_diff($origin, $target);
            $day = $interval->format('%a');
            for ($i = 0; $i <= $day; $i++) {
                $next = strtotime("+$i day", strtotime($test->travel_date));
                if ($next <= strtotime($test->travel_date_end)) {
                    array_push($array, date('Y-m-d', $next));
                }
            }
            $j++;
        }

        $temp = array_count_values($array);
        $resultArray = [];
        foreach ($temp as $key => $value) {
            $resultArray[] = [
                $key,
                $value,
            ];
        }

        return $resultArray;
    }

    /**
     * 获取旅行天数记录的 ajax 方法
     * 热力图用
     */
    public function getCalendarDataAjax(Request $request)
    {
        $formData = $request->post();
        $userId = $formData['userId'];
        $date = $formData['date'];

        if (empty($date)) {
            $result = $this->getTravelRecordInAYearForCalendar($userId);
        } else {
        }

        return response()->json($result)->setEncodingOptions(JSON_UNESCAPED_UNICODE);
    }

    /**
     * 旅行详细页面<选择年份>下拉菜单获取旅行过的年份
     */
    public function getAllTravelYearAjax(Request $request)
    {
        $formData = $request->post();
        $userId = $formData['userId'];

        $record = new Record();
        $result = $record->selectAllTravelYear($userId);

        return view('Home.TravelDetail.travel_detail_select_year_ajax', ['yearData' => $result]);
    }
}

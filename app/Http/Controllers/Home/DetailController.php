<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Operate\Record;
use Illuminate\Http\Request;

class DetailController extends Controller
{
    /**
     * 显示旅行详细页面
     */
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

        $calendorData = $this->reorganizeDateForCalendar($result);

        return $calendorData;
    }

    /**
     * 按照年份获取旅行记录 | e.g. $year = 2021/2022/2023
     */
    public function getTravelRecordByYearForCalendar($userId, $date)
    {
        $record = new Record();
        $result = $record->selectTravelDetailByYear($userId, $date);

        $calendorData = $this->reorganizeDateForCalendar($result);

        return $calendorData;
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

        if ($date === 'one_year') {
            $result = [
                'date' => $this->getTravelRecordInAYearForCalendar($userId),
                'time_range' => [
                    date("Y-m-d"), // 当前时间
                    date("Y-m-d", strtotime("-1 years", strtotime(date("Y-m-d")))), // 一年前时间
                ],
                'title' => '近一',
            ];
        } else {
            $result = [
                'date' => $this->getTravelRecordByYearForCalendar($userId, $date),
                'time_range' => $date,
                'title' => $date,
            ];
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

    /**
     * 整理日历热力图所需日期数据
     */
    public function reorganizeDateForCalendar($result)
    {
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
}

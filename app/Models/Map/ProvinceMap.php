<?php

namespace App\Models\Map;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProvinceMap extends Model
{
    use HasFactory;

    /**
     * 获取省级地图数据
     * 
     * @return array
     */
    public function getChinaProvinceMapDataAll($userId, $provinceName)
    {
        $result = DB::select('select city as name, count(*) as value from china_province_map_record where user_id = ? and province = ? group by name', [$userId, $provinceName]);
        $result = array_map('get_object_vars', $result);

        return $result;
    }

    public function getTravelRecordByYear($userId, $province)
    {
        $result = DB::select('select from_unixtime(travel_date, "%Y") as year_date from china_province_map_record where user_id = ? and province = ? group by from_unixtime(travel_date, "%Y")', [$userId, $province]);

        return $result;
    }

    public function getChinaProvinceDetailData($userId, $province, $page, $num)
    {
        $result = DB::select('select city_adcode, city, from_unixtime(travel_date, "%Y-%m-%d") as travel_date from china_province_map_record where user_id = ? and province = ? and (DATE_SUB(CURDATE(), INTERVAL 30 DAY) <= FROM_UNIXTIME(travel_date, "%Y-%m-%d")) order by travel_date desc limit ?, ?', [$userId, $province, $page, $num]);

        return $result;
    }

    public function countTravelDetailRecord($userId, $province, $date)
    {
        $result = DB::select('select count(*) as total_page from china_province_map_record where user_id = ? and province = ? and (DATE_SUB(CURDATE(), INTERVAL 30 DAY) <= FROM_UNIXTIME(travel_date, "%Y-%m-%d"))', [$userId, $province]);

        return $result;
    }
}

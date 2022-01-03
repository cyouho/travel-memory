<?php

namespace App\Models\Operate;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Record extends Model
{
    use HasFactory;

    /**
     * 检索旅行详细记录 | 景点名，备注
     */
    public function selectTravelDetail($userId, $travelId)
    {
        $result = DB::select('select spot_name, remark from travel_detail_record where user_id = ? and travel_id = ?', [$userId, $travelId]);

        return $result;
    }

    /**
     * 按照时间检索旅行详细记录天数
     * 旅行详细页面<日历热力图>用
     */
    public function selectTravelRecord($userId)
    {
        $result = DB::select('select record_id, from_unixtime(travel_date, "%Y-%m-%d") as travel_date, if(travel_date_end = "-" , curdate() , from_unixtime(travel_date_end, "%Y-%m-%d")) as travel_date_end from china_province_map_record where user_id = ? and (DATE_SUB(CURDATE(), INTERVAL 1 YEAR) <= FROM_UNIXTIME(travel_date, "%Y-%m-%d"))', [$userId]);
        //$result = DB::select('select record_id, travel_date, if(travel_date_end = "-" , UNIX_TIMESTAMP(CURDATE()) , travel_date_end) as travel_date_end from china_province_map_record where user_id = ?', [$userId]);

        return $result;
    }

    /**
     * 检索详细旅行过的年份
     * 旅行详细页面<日历热力图>用
     */
    public function selectAllTravelYear($userId)
    {
        $result = DB::select('select from_unixtime(travel_date, "%Y") as year_date from china_province_map_record where user_id = ? group by from_unixtime(travel_date, "%Y")', [$userId]);

        return $result;
    }

    /**
     * 插入旅行详细记录并获取插入的id
     */
    public function insertTravelRecord($data)
    {
        $timestamp = time();
        // $id = DB::insertGetId('insert into china_province_map_record (user_id, province_adcode, province, city_adcode, city, region_adcode, region, travel_date, record_create_at, record_update_at) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [$data['user_id'], $data['province_adcode'], $data['province'], $data['city_adcode'], $data['city'], $data['region_adcode'], $data['region'], $data['travel_date'], $timestamp, $timestamp]);

        $id = DB::table('china_province_map_record')->insertGetId(
            $data
        );

        return $id;
    }

    /**
     * 插入旅行目的地，备注
     */
    public function insertTravelDetail($data)
    {
        $affected = DB::table('travel_detail_record')->insert(
            $data
        );
    }

    /**
     * 修改旅行详细记录
     */
    public function updateTravelRecord($userId, $recordId, $data)
    {
        $affected = DB::table('china_province_map_record')
            ->where('user_id', $userId)
            ->where('record_id', $recordId)
            ->update($data);

        dd($affected);
    }
}

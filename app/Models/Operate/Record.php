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
     * 
     * @param int $userId   <用户Id>
     * @param int $travelId <china_province_map_record 表里的 record_id>
     * 
     * @return array $result <结果数组，内部为对象结果集>
     */
    public function selectTravelDetail($userId, $travelId)
    {
        $result = DB::select('select spot_name, remark from travel_detail_record where user_id = ? and travel_id = ?', [$userId, $travelId]);

        return $result;
    }

    /**
     * 按照时间检索旅行详细记录天数
     * 旅行详细页面<日历热力图>用
     * 
     * @param int $userId <用户Id>
     * 
     * @return array $result <结果数组，内部为对象结果集>
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
     * 
     * @param int $userId <用户Id>
     * 
     * @return array $result <结果数组，内部为对象结果集>
     */
    public function selectAllTravelYear($userId)
    {
        $result = DB::select('select from_unixtime(travel_date, "%Y") as year_date from china_province_map_record where user_id = ? group by from_unixtime(travel_date, "%Y") order by year_date desc', [$userId]);

        return $result;
    }

    /**
     * 按照年份检索详细旅行结果 | e.g. 2022 2021 2020 2019
     * 旅行详细页面<日历热力图>用
     * 
     * @param int $userId <用户Id>
     * @param int $year   <年份>
     * 
     * @return array $result <结果数组，内部为对象结果集>
     */
    public function selectTravelDetailByYear($userId, $year)
    {
        $result = DB::select('select from_unixtime(travel_date, "%Y-%m-%d") as travel_date, if (travel_date_end = "-", curdate(), from_unixtime(travel_date_end, "%Y-%m-%d")) as travel_date_end from china_province_map_record where user_id = ? and ? = FROM_UNIXTIME(travel_date, "%Y") order by travel_date desc', [$userId, $year]);

        return $result;
    }

    /**
     * 插入旅行详细记录并获取插入的id
     * 
     * @param array $data <插入数据数组>
     * 
     * @return int $id <插入数据时的旅行详细id>
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
     * 
     * @param array $data <插入的数据数组，travel_id, user_id, spot_name, remark>
     * 
     * @return void
     */
    public function insertTravelDetail($data)
    {
        $affected = DB::table('travel_detail_record')->insert(
            $data
        );
    }

    /**
     * 修改旅行详细记录 | 未完成!
     */
    public function updateTravelRecord($userId, $recordId, $data)
    {
        $affected = DB::table('china_province_map_record')
            ->where('user_id', $userId)
            ->where('record_id', $recordId)
            ->update($data);

        dd($affected);
    }

    /**
     * 删除旅行详细记录 | table: china_province_map_record, travel_detail_record
     * 
     * @param int $userId   <用户Id>
     * @param int $recordId <旅行详细记录Id, table: travel_detail_record>
     * 
     * @return void
     */
    public function deleteTravelDetailRecord($userId, $recordId)
    {
        $deleted = DB::delete('delete from china_province_map_record where user_id = ? and record_id = ?', [$userId, $recordId]);
        $deletedDetail = DB::delete('delete from travel_detail_record where user_id = ? and travel_id = ?', [$userId, $recordId]);
    }
}

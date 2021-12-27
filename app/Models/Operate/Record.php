<?php

namespace App\Models\Operate;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Record extends Model
{
    use HasFactory;

    public function selectTravelDetail($userId, $travelId)
    {
        $result = DB::select('select spot_name, remark from travel_detail_record where user_id = ? and travel_id = ?', [$userId, $travelId]);

        return $result;
    }

    public function insertTravelRecord($data)
    {
        $timestamp = time();
        // $id = DB::insertGetId('insert into china_province_map_record (user_id, province_adcode, province, city_adcode, city, region_adcode, region, travel_date, record_create_at, record_update_at) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [$data['user_id'], $data['province_adcode'], $data['province'], $data['city_adcode'], $data['city'], $data['region_adcode'], $data['region'], $data['travel_date'], $timestamp, $timestamp]);

        $id = DB::table('china_province_map_record')->insertGetId(
            $data
        );

        return $id;
    }

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

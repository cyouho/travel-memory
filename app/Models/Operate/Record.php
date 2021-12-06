<?php

namespace App\Models\Operate;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Record extends Model
{
    use HasFactory;

    public function insertTravelRecord($data)
    {
        $timestamp = time();
        // $id = DB::insertGetId('insert into china_province_map_record (user_id, province_adcode, province, city_adcode, city, region_adcode, region, travel_date, record_create_at, record_update_at) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [$data['user_id'], $data['province_adcode'], $data['province'], $data['city_adcode'], $data['city'], $data['region_adcode'], $data['region'], $data['travel_date'], $timestamp, $timestamp]);

        $id = DB::table('china_province_map_record')->insertGetId(
            $data
        );

        return $id;
    }
}

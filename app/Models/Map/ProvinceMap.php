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

    public function getChinaProvinceDetailDataBy30Days($userId)
    {
        $result = DB::select('select province_adcode, province, from_unixtime(travel_date, "%Y-%m-%d") as travel_date from china_province_map_record where user_id = ? and (DATE_SUB(CURDATE(), INTERVAL 30 DAY) <= FROM_UNIXTIME(travel_date, "%Y-%m-%d")) order by travel_date desc', [$userId]);
        return $result;
    }
}

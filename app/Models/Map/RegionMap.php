<?php

namespace App\Models\Map;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RegionMap extends Model
{
    use HasFactory;
    /**
     * 获取省级地图数据
     * 
     * @return array
     */
    public function getChinaProvinceCityRegionMapDataAll($userId, $cityName)
    {
        $result = DB::select('select region as name, count(*) as value from china_province_map_record where user_id = ? and city = ? group by name', [$userId, $cityName]);
        $result = array_map('get_object_vars', $result);

        return $result;
    }
}

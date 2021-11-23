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
    public function getChinaProvinceMapDataAll($data)
    {
        $key = key($data);
        $result = DB::select('select province as name, travel_times as value from china_map_record where ' . $key . ' = ?', [$data[$key]]);
        $result = array_map('get_object_vars', $result);

        return $result;
    }
}

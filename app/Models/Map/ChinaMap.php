<?php

namespace App\Models\Map;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ChinaMap extends Model
{
    use HasFactory;

    /**
     * 初始化全国地图数据
     */
    public function chinaMapDataInit()
    {
    }

    /**
     * 获取全国地图数据
     * @todo 使用 userId 区分不同用户的数据
     * 
     * @return array
     */
    public function getChinaMapDataAll($data)
    {
        $key = key($data);
        $result = DB::select('select province as name, travel_times as value from china_map_record where ' . $key . ' = ?', [$data[$key]]);
        $result = array_map('get_object_vars', $result);

        return $result;
    }
}

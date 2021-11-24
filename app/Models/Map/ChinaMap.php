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
     * 
     * @return array
     */
    public function getChinaMapDataAll($data)
    {
        $key = key($data);
        $result = DB::select('select province as name, count(*) as value from china_province_map_record where user_id = ' . $key . ' group by name', [$data[$key]]);
        $result = array_map('get_object_vars', $result);

        return $result;
    }
}

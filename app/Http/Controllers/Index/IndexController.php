<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use App\Models\Map\ChinaMap;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * 显示 index 页面
     */
    public function index()
    {
        return view('Index.index_layer');
    }

    /**
     * 获取全国地图记录的 Ajax
     * @todo 按 userId 来区分获取的记录
     */
    public function chinaMapDataAjax(Request $request)
    {
        $formData = $request->post();
        $chinaMap = new ChinaMap();
        $chinaMapData = $chinaMap->getChinaMapDataAll();
        return response()->json($chinaMapData)->setEncodingOptions(JSON_UNESCAPED_UNICODE);
    }
}

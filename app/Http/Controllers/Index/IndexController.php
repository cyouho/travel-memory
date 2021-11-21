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
     */
    public function chinaMapDataAjax(Request $request)
    {
        $formData = $request->post();
        $userId = isset($formData['userId']) ? $formData['userId'] : '';

        $chinaMap = new ChinaMap();
        $chinaMapData = $chinaMap->getChinaMapDataAll(['user_id' => $userId]);

        return response()->json($chinaMapData)->setEncodingOptions(JSON_UNESCAPED_UNICODE);
    }
}

<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use App\Models\Map\ChinaMap;
use App\Models\User\User;
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
     * Index 页面导航栏上显示到过多少个省，没到过多少个省
     */
    public function showHowManyProvinceGoneAjax(Request $request)
    {
        $formData = $request->post();
        $userId = isset($formData['userId']) ? $formData['userId'] : '';

        $user = new User();
        $result = $user->getProvinceGoneRecord(['user_id' => $userId]);

        $provinceRecord = [
            'gone' => $result,
            'go'   => 35 - $result,
        ];

        return response()->json($provinceRecord);
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

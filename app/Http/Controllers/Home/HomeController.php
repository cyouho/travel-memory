<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * 显示home主页
     */
    public function index()
    {
        return view('Home.home_layer');
    }

    /**
     * 显示home页面的sidebar内容用 ajax 方法
     */
    public function homeContentsAjax(Request $request)
    {
        $formData = $request->post();
        $pageName = $formData['pageName'];

        switch ($pageName) {
            case 'profile':
                return view('Home.DetailContents.home_detail_contents_profile');
                break;
            default:
                return view('Home.DetailContents.home_detail_contents_null');
                break;
        }
    }

    /**
     * 获取全国各县市区的方法，功勋方法，不要删！
     */
    public function test()
    {
        $test = file_get_contents(public_path() . "/js/map/location.json");
        $a = json_decode($test, true);
        $b = public_path() . "/js/map/t.txt";
        $c = fopen($b, 'a');
        foreach ($a as $key => $value) {
            fwrite($c, "'" . $value['name'] . "'" . ' => ' . $key . ',' . "\n");
        }
        fwrite($c, 'over!');
        fclose($c);
        echo 'done!';
    }
}

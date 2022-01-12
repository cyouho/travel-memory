<?php

use App\Http\Controllers\City\CityController;
use App\Http\Controllers\Home\DetailController;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\Index\IndexController;
use App\Http\Controllers\Login\LoginController;
use App\Http\Controllers\Operate\AddRecordController;
use App\Http\Controllers\Province\ProvinceController;
use App\Http\Controllers\Register\RegisterController;
use App\Http\Controllers\Setting\SettingController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [
    IndexController::class, 'index'
]);

Route::get('/login', [
    LoginController::class, 'showLoginPage'
]);

Route::post('/doLogin', [
    LoginController::class, 'doLogin'
]);

Route::get('/register', [
    RegisterController::class, 'showRegisterPage'
]);

Route::get('/logout', [
    LoginController::class, 'doLogout'
]);

Route::post('/doRegister', [
    RegisterController::class, 'doRegister'
]);

// need login when use these route below.
Route::middleware(['user'])->group(function () {

    Route::post('/chinaMapDataAjax', [
        IndexController::class, 'chinaMapDataAjax'
    ]);

    Route::post('/showHowManyProvinceGoneAjax', [
        IndexController::class, 'showHowManyProvinceGoneAjax'
    ]);

    Route::get('/home', [
        HomeController::class, 'index'
    ]);

    Route::get('/setting/{kind?}', [
        SettingController::class, 'index'
    ]);

    Route::post('/homeContentsAjax', [
        HomeController::class, 'homeContentsAjax'
    ]);

    Route::get('/province/{province?}', [
        ProvinceController::class, 'index'
    ]);

    Route::post('/chinaProvinceMapDataAjax', [
        ProvinceController::class, 'chinaProvinceMapDataAjax'
    ]);

    Route::get('/province/{province?}/city/{city?}', [
        CityController::class, 'index'
    ]);

    Route::post('chinaProvinceCityRegionMapDataAjax', [
        CityController::class, 'chinaProvinceCityRegionMapDataAjax'
    ]);

    Route::get('/addRecord', [
        AddRecordController::class, 'index'
    ]);

    Route::post('/addNewRecord', [
        AddRecordController::class, 'addNewRecord'
    ]);

    Route::post('/firstChinaProvinceCityRegionMapDataAjax', [
        AddRecordController::class, 'firstChinaProvinceCityRegionMapDataAjax'
    ]);

    Route::post('/secondChinaProvinceCityRegionMapDataAjax', [
        AddRecordController::class, 'secondChinaProvinceCityRegionMapDataAjax'
    ]);

    Route::post('/getChinaProvinceDetailAjax', [
        ProvinceController::class, 'getChinaProvinceDetailAjax'
    ]);

    Route::post('/getTravelDateDetailAjax', [
        ProvinceController::class, 'getTravelDateDetailAjax'
    ]);

    Route::post('/getChinaProvinceDetailForRegionAjax', [
        CityController::class, 'getChinaProvinceDetailAjax'
    ]);

    Route::post('/getTravelDateDetailForRegionAjax', [
        CityController::class, 'getTravelDateDetailAjax'
    ]);

    Route::post('/newName', [
        SettingController::class, 'setNewUserName'
    ]);

    Route::post('/newPassword', [
        SettingController::class, 'setNewUserPassword'
    ]);

    Route::get('/travelDetail', [
        DetailController::class, 'index'
    ]);

    Route::post('/travelDetailModalAjax', [
        CityController::class, 'travelDetailModalAjax'
    ]);

    Route::post('/amendTravelDetailAjax', [
        CityController::class, 'amendTravelDetailAjax'
    ]);

    Route::post('/getCalendarDataAjax', [
        DetailController::class, 'getCalendarDataAjax'
    ]);

    Route::post('/getAllTravelYearAjax', [
        DetailController::class, 'getAllTravelYearAjax'
    ]);

    Route::post('/deleteTravelDetailAjax', [
        CityController::class, 'deleteTravelDetailAjax'
    ]);
});

// 获取全国各县市区的方法，功勋方法，必要时使用，暂时注释掉。
// Route::get('/test', [
//     HomeController::class, 'test'
// ]);

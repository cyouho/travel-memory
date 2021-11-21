<?php

use App\Http\Controllers\Index\IndexController;
use App\Http\Controllers\Login\LoginController;
use App\Http\Controllers\Register\RegisterController;
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

Route::post('/chinaMapDataAjax', [
    IndexController::class, 'chinaMapDataAjax'
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

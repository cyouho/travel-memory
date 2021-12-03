<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    //
    public function index($kind = 'others')
    {
        switch ($kind) {
            case 'profile':
                return view('Setting.SettingProfile.setting_profile_layer');
                break;
            case 'xxx':
                return view('Setting.Settingxxx.setting_xxx_layer');
                break;
            default:
                return redirect('/setting/profile');
                break;
        }
    }
}

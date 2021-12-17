<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Models\User\User;
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

    public function setNewUserName(Request $request)
    {
        $newUserName = $request->input('new_user_name');
        $userId = $request->input('user_id');

        $user = new User();
        $result = $user->updateUserName($newUserName, $userId);

        if ($result) {
            return back()->with('success', '更新成功');
        } else {
            return back()->withErrors('更新失败')->withInput();
        }
    }
}

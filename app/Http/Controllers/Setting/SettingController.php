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

    /**
     * 更新用户名
     */
    public function setNewUserName(Request $request)
    {
        $newUserName = $request->input('new_user_name');
        $userId = $request->input('user_id');

        $user = new User();
        $result = $user->updateUserName($newUserName, $userId);

        if ($result) {
            return back()->with('update_name_success', '更新成功');
        } else {
            return back()->withErrors(['update_name_defeated' => '更新失败'], 'update_name_errMSG');
        }
    }

    /**
     * 更新用户密码
     */
    public function setNewUserPassword(Request $request)
    {
        $newUserPSW = $request->input('new_user_pwd');
        $oldUserPSW = $request->input('old_user_pwd');
        $userId = $request->input('user_id');

        $user = new User();
        $result = $user->checkUserPwd($oldUserPSW, ['user_id' => $userId]);

        if ($result) {
            $user->updateUserPassword($newUserPSW, $userId);
            return back()->with('update_password_success', '更新成功');
        } else {
            return back()->withErrors(['update_password_deteated' => '旧密码输入错误，更新失败'], 'update_password_errMSG');
        }
    }
}

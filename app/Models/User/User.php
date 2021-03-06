<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Utils as ModelsUtils;
use App\Http\Controllers\Utils as ControllersUtils;

/**
 * 用户所有的数据库操作类
 */
class User extends Model
{
    use HasFactory;

    // get | select ----------------------------------------------------------------------------
    /**
     * 获取 user ID
     * 
     * @param array $data <检索userId所需数据数组>
     * 
     * @return array $userId | '' <用户Id | ''>
     */
    public function getUserId($data)
    {
        $key = key($data);
        $userId = DB::select('select user_id from users where ' . $key . ' = ?', [$data[$key]]);

        return isset($userId[0]) ? $userId : '';
    }

    /**
     * 获取 user session
     * 
     * @param string $email <用户email>
     * 
     * @return string $session <用户email对应的session>
     */
    public function getSeesion($email)
    {
        $data = DB::select('select user_session from users where user_email = ?', [$email]);
        $session = $data[0]->user_session;
        return $session;
    }

    /**
     * 获取 user name
     * 
     * @param string $session <用户session>
     * 
     * @return string $userName[0]['user_name'] <用户session>
     */
    public function getUserName($session)
    {
        $data = DB::select('select user_name from users where user_session = ?', [$session]);
        $userName = array_map('get_object_vars', $data);

        return $userName[0]['user_name'];
    }

    /**
     * 获取去过的省份
     * 
     * @param array $data <检索所需键值对>
     * 
     * @return object $$result[0]->gone <去过的省份>
     */
    public function getProvinceGoneRecord($data)
    {
        $key = key($data);
        $result = DB::select('select count(*) as gone from travel_memory.china_map_record where ' . $key . ' = ? and travel_times > 0', [$data[$key]]);

        return $result[0]->gone;
    }

    // update | update ---------------------------------------------------------------------------
    /**
     * 更新最后登录时间
     * 
     * @param string $loginTime <登录时间>
     * @param string $email     <用户email>
     * 
     * @return void
     */
    public function updateLastLoginTime($loginTime, $email)
    {
        $affected = DB::update('update users set last_login_at = ? where user_email = ?', [$loginTime, $email]);
    }

    /**
     * 更新总登录次数
     * 
     * @param string $email <用户email>
     * 
     * @return void
     */
    public function updateTotalLoginTimes($email)
    {
        $affected = DB::update('update users set total_login_times = total_login_times + 1 where user_email = ?', [$email]);
    }

    /**
     * 更新管理员登录信息
     * 
     * @param string $loginTime <管理员登录时间>
     * @param string $email     <管理员邮件email>
     * 
     * @return void
     */
    public function updateAdminLoginInfo($loginTime, $email)
    {
        $userId = $this->getUserId(['user_email' => $email]);
        $result = DB::select('select record_id, login_day from user_login_record where from_unixtime(login_day, "%Y%m%d") = curdate() and user_id = ?', [$userId[0]->user_id]);

        // 如果没有这天的记录就插入新的记录
        if (!$result) {
            $this->insertUserLoginRecord($userId[0]->user_id, $loginTime);
        } else {
            // 如果有记录就获取记录
            $result = ControllersUtils::getArrFromObj($result);
            $recordId = $result[0]['record_id'];
            // 更新一次登录次数
            $this->updateUserLoginTimes($recordId);
        }
    }

    /**
     * 更新用户名
     * 
     * @param string $newUserName <新用户名>
     * @param int    $userId      <用户Id>
     * 
     * @return int $affected <更新成功与否判定值 0 | 1>
     */
    public function updateUserName($newUserName, $userId)
    {
        $affected = DB::update('update users set user_name = ? where user_id = ?', [$newUserName, $userId]);

        return $affected;
    }

    /**
     * 更新用户密码
     * 
     * @param string $newPassword <用户新密码>
     * @param int    $userId      <用户Id>
     * 
     * @return void
     */
    public function updateUserPassword($newPassword, $userId)
    {
        $password = Hash::make($newPassword);
        $affected = DB::update('update users set user_password = ? where user_id = ?', [$password, $userId]);
    }

    /**
     * 更新 user 登录记录里的登录次数
     * 
     * @param int $recordId <同一天登录时更新当日 recordId 的次数>
     * 
     * @return void
     */
    public function updateUserLoginTimes($recordId)
    {
        $affected = DB::update('update user_login_record set login_times = login_times + 1 where record_id = ?', [$recordId]);
    }

    // 注册用方法 ------------------------------------------------------------------------------
    /**
     * 注册功能
     * 
     * @param string $email    <用户email>
     * @param string $password <用户密码>
     * 
     * @return string $session <用户session>
     */
    public function RegisterSet($email, $password)
    {
        $userName = ModelsUtils::getNameFromEmail($email);
        $session = ModelsUtils::getSessionRandomMD5();
        $password = Hash::make($password);
        $timestamp = time();
        $data = [
            'user_name'         => $userName,
            'user_email'        => $email,
            'user_password'     => $password,
            'user_session'      => $session,
            'create_at'         => $timestamp,
            'update_at'         => $timestamp,
            'last_login_at'     => $timestamp,
            'total_login_times' => 1,
        ];
        DB::insert('insert into users (user_name, user_email, user_password, user_session, create_at, update_at, last_login_at, total_login_times) values (?, ?, ?, ?, ?, ?, ?, ?)', [$data['user_name'], $data['user_email'], $data['user_password'], $data['user_session'], $data['create_at'], $data['update_at'], $data['last_login_at'], $data['total_login_times']]);

        $result = $this->getUserId(['user_email' => $email]);
        $userId = isset($result[0]->user_id) ? $result[0]->user_id : '';

        // 建立第一次 user 的登录信息
        $this->insertUserLoginRecord($userId, $timestamp);

        // 建立第一次 China map 记录
        $this->insertChinaMapRecord($userId);

        return $session;
    }

    /**
     * 检查用户密码
     * 
     * @param string $password <用户密码>
     * @param array  $data     <数据数组>
     * 
     * @return bool
     */
    public function checkUserPwd($password, $data)
    {
        $key = key($data);
        $data = DB::select('select user_password from users where ' . $key . ' = ?', [$data[$key]]);
        $hashPwd = $data[0]->user_password;
        return Hash::check($password, (string)$hashPwd);
    }

    // insert | insert --------------------------------------------------------------------------
    /**
     * 插入用户登录记录
     * 
     * @param int    $userId    <用户Id>
     * @param string $timestamp <用户登录时间戳>
     * 
     * @return void
     */
    public function insertUserLoginRecord($userId, $timestamp)
    {
        $insertData = [
            'user_id'     => $userId,
            'login_day'   => $timestamp,
            'login_times' => 1,
        ];
        $affected = DB::insert('insert into user_login_record (user_id, login_day, login_times) values (?, ?, ?)', [$insertData['user_id'], $insertData['login_day'], $insertData['login_times']]);
    }

    /**
     * 插入地图数据
     * 
     * @param int $userId <用户Id>
     * 
     * @return void
     */
    public function insertChinaMapRecord($userId)
    {
        $data = ModelsUtils::initChinaMapRecord($userId);
        $affected = DB::table("china_map_record")->insert($data);
    }
}

<?php

namespace App\Models;

/**
 * 所有模型 Models 所使用的静态方法类
 */
class Utils
{
    /**
     * 从 email 中获取 name
     */
    public static function getNameFromEmail($email)
    {
        return substr($email, 0, strripos($email, "@"));
    }

    /**
     * 使用 md5 来生成所需的 session
     */
    public static function getSessionRandomMD5()
    {
        return md5(time());
    }

    /**
     * 初始化第一次 China map 的访问记录
     * @param string $userId
     * @return array
     */
    public static function initChinaMapRecord($userId)
    {
        return [
            [
                'user_id'      => $userId,
                'adcode'       => 110000,
                'province'     => '北京市',
                'travel_times' => 0,
            ],
            [
                'user_id'      => $userId,
                'adcode'       => 120000,
                'province'     => '天津市',
                'travel_times' => 0,
            ],
            [
                'user_id'      => $userId,
                'adcode'       => 130000,
                'province'     => '河北省',
                'travel_times' => 0,
            ],
            [
                'user_id'      => $userId,
                'adcode'       => 140000,
                'province'     => '山西省',
                'travel_times' => 0,
            ],
            [
                'user_id'      => $userId,
                'adcode'       => 150000,
                'province'     => '内蒙古自治区',
                'travel_times' => 0,
            ],
            [
                'user_id'      => $userId,
                'adcode'       => 210000,
                'province'     => '辽宁省',
                'travel_times' => 0,
            ],
            [
                'user_id'      => $userId,
                'adcode'       => 220000,
                'province'     => '吉林省',
                'travel_times' => 0,
            ],
            [
                'user_id'      => $userId,
                'adcode'       => 230000,
                'province'     => '黑龙江省',
                'travel_times' => 0,
            ],
            [
                'user_id'      => $userId,
                'adcode'       => 310000,
                'province'     => '上海市',
                'travel_times' => 0,
            ],
            [
                'user_id'      => $userId,
                'adcode'       => 320000,
                'province'     => '江苏省',
                'travel_times' => 0,
            ],
            [
                'user_id'      => $userId,
                'adcode'       => 330000,
                'province'     => '浙江省',
                'travel_times' => 0,
            ],
            [
                'user_id'      => $userId,
                'adcode'       => 340000,
                'province'     => '安徽省',
                'travel_times' => 0,
            ],
            [
                'user_id'      => $userId,
                'adcode'       => 350000,
                'province'     => '福建省',
                'travel_times' => 0,
            ],
            [
                'user_id'      => $userId,
                'adcode'       => 360000,
                'province'     => '江西省',
                'travel_times' => 0,
            ],
            [
                'user_id'      => $userId,
                'adcode'       => 370000,
                'province'     => '山东省',
                'travel_times' => 0,
            ],
            [
                'user_id'      => $userId,
                'adcode'       => 410000,
                'province'     => '河南省',
                'travel_times' => 0,
            ],
            [
                'user_id'      => $userId,
                'adcode'       => 420000,
                'province'     => '湖北省',
                'travel_times' => 0,
            ],
            [
                'user_id'      => $userId,
                'adcode'       => 430000,
                'province'     => '湖南省',
                'travel_times' => 0,
            ],
            [
                'user_id'      => $userId,
                'adcode'       => 440000,
                'province'     => '广东省',
                'travel_times' => 0,
            ],
            [
                'user_id'      => $userId,
                'adcode'       => 450000,
                'province'     => '广西壮族自治区',
                'travel_times' => 0,
            ],
            [
                'user_id'      => $userId,
                'adcode'       => 460000,
                'province'     => '海南省',
                'travel_times' => 0,
            ],
            [
                'user_id'      => $userId,
                'adcode'       => 500000,
                'province'     => '重庆市',
                'travel_times' => 0,
            ],
            [
                'user_id'      => $userId,
                'adcode'       => 510000,
                'province'     => '四川省',
                'travel_times' => 0,
            ],
            [
                'user_id'      => $userId,
                'adcode'       => 520000,
                'province'     => '贵州省',
                'travel_times' => 0,
            ],
            [
                'user_id'      => $userId,
                'adcode'       => 530000,
                'province'     => '云南省',
                'travel_times' => 0,
            ],
            [
                'user_id'      => $userId,
                'adcode'       => 540000,
                'province'     => '西藏自治区',
                'travel_times' => 0,
            ],
            [
                'user_id'      => $userId,
                'adcode'       => 610000,
                'province'     => '陕西省',
                'travel_times' => 0,
            ],
            [
                'user_id'      => $userId,
                'adcode'       => 620000,
                'province'     => '甘肃省',
                'travel_times' => 0,
            ],
            [
                'user_id'      => $userId,
                'adcode'       => 630000,
                'province'     => '青海省',
                'travel_times' => 0,
            ],
            [
                'user_id'      => $userId,
                'adcode'       => 640000,
                'province'     => '宁夏回族自治区',
                'travel_times' => 0,
            ],
            [
                'user_id'      => $userId,
                'adcode'       => 650000,
                'province'     => '新疆维吾尔自治区',
                'travel_times' => 0,
            ],
            [
                'user_id'      => $userId,
                'adcode'       => 810000,
                'province'     => '香港',
                'travel_times' => 0,
            ],
            [
                'user_id'      => $userId,
                'adcode'       => 820000,
                'province'     => '澳门',
                'travel_times' => 0,
            ],
            [
                'user_id'      => $userId,
                'adcode'       => 830000,
                'province'     => '台湾省',
                'travel_times' => 0,
            ],
            [
                'user_id'      => $userId,
                'adcode'       => 900000,
                'province'     => '南海诸岛',
                'travel_times' => 0,
            ],
        ];
    }
}

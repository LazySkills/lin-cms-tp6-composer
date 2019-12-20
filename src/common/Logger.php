<?php
/** Created by 嗝嗝<china_wangyu@aliyun.com>. Date: 2019-12-12  */

namespace LinCmsTp6\common;


use LinCmsTp6\model\LinLog;
use paa\annotation\common\authorize\Jwt;
use think\facade\Log;

class Logger
{

    /** 创建记录 */
    public static function create(int $user_id,string $username = '',string $message = ''){
        try{
            Linlog::create([
                'message' => $username . $message,
                'user_id' => $user_id,
                'user_name' => $username,
                'status_code' => response()->getCode(),
                'method' => request()->method(),
                'path' => request()->url(),
                'authority' => ''
            ]);
        }catch (\Exception $exception){
            Log::write('[写入用户记录失败] : userId='.$user_id.
                ',username='.$username.',message='.$message,
                'notice');
        }
    }

    /**
     * 通过注解完成日志
     * @param string $message
     */
    public static function annotation(string $message = ''){
        $jwt = Jwt::decode();
        $userInfo = json_decode($jwt['signature'],true);
        static::create($userInfo['id'],$userInfo['username'],$message);
    }
}
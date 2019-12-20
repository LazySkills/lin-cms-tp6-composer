<?php
/** Created by 嗝嗝<china_wangyu@aliyun.com>. Date: 2019-12-11  */

namespace LinCmsTp6\model;


use LinCmsTp6\exception\LinLogException;
use think\db\Query;

/**
 * 管理系统平台用户操作日志
 * Class LinUser
 * @package app\model
 */
class LinLog extends BaseModel
{
    protected $createTime="time";
    protected $updateTime=false;
    protected $autoWriteTimestamp="timestamp";

    public static function getLogs($params)
    {
        $filter = [];
        if (isset($params['name'])) {
            $filter ['user_name'] = $params['name'];
        }

        if (isset($params['start']) && isset($params['end'])) {
            $filter['time'] = [$params['start'], $params['end']];
        }

        $log = self::withSearch(['user_name', 'time'], $filter)->order('time desc');
        $totalNums = $log->count();
        $log = $log->pageX();

        $list = $log->select();
        if (!$list) throw new LinLogException();

        return $log->pageDate($list,$totalNums);
    }

    public function searchUserNameAttr(Query $query, $value, $data)
    {
        if (!empty($value)) {
            $query->where('user_name', $value);
        }
    }

    public function searchTimeAttr(Query $query, $value, $data)
    {
        if (!empty($value)) {
            $query->whereBetweenTime('time', $value[0], $value[1]);
        }
    }
}
<?php
/** Created by 嗝嗝<china_wangyu@aliyun.com>. Date: 2019-12-11  */

namespace LinCmsTp6\model;


use LinCmsTp6\exception\ParameterException;
use think\Model;
use think\db\Query;

/**
 * 模型基类，做统一事务回滚使用
 * Class BaseModel
 * @package app\model
 */
class BaseModel extends Model
{
    /** 简单分页 */
    public static function pageX(Query $model){
        $listRows = $listRows ?? request()->get('count') ?? 10;
        $page = $page ?? request()->get('page') ?? 0;

        if ($page < 0 || $listRows < 0) throw new ParameterException();

        return $model->page($page, $listRows);
    }

    /** 返回数据 */
    public static function pageData(Query $model,array $list = [],int $totalNums = 0){
        return [
            'items' => $list,
            'total' => $totalNums,
            'count' => $model->getOptions()['page'][1],
            'page' => $model->getOptions()['page'][0],
            'total_page' => ceil($totalNums / $model->getOptions()['page'][1])
        ];
    }

}
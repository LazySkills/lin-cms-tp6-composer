<?php
/** Created by 嗝嗝<china_wangyu@aliyun.com>. Date: 2019-12-11  */

namespace LinCmsTp6\model;


use LinCmsTp6\exception\ParameterException;
use think\Model;

/**
 * 模型基类，做统一事务回滚使用
 * Class BaseModel
 * @package app\model
 */
class BaseModel extends Model
{

    /** 简单分页 */
    public function pageX(int $page = null,int $listRows = null){
        $listRows = $listRows ?? request()->get('count') ?? 10;
        $page = $page ?? request()->get('page') ?? 0;

        if ($page < 0 || $listRows < 0) throw new ParameterException();

        $this->options['page'] = [$page, $listRows];

        return $this;
    }

    /** 返回数据 */
    public function pageData(array $list = [],int $totalNums = 0){
        return [
            'items' => $list,
            'total' => $totalNums,
            'count' => $this->options['page'][1],
            'page' => $this->options['page'][0],
            'total_page' => ceil($totalNums / $this->options['page'][1])
        ];
    }

}
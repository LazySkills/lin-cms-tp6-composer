<?php
/** Created by 嗝嗝<china_wangyu@aliyun.com>. Date: 2019-11-20  */

namespace LinCmsTp6\exception;


class LinLogException extends \Exception
{
    protected $message = '暂无数据';
    protected $code = 400;
    protected $error_code = 1101;
}
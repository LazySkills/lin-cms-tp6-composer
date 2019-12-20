<?php
/** Created by 嗝嗝<china_wangyu@aliyun.com>. Date: 2019-12-16  */

namespace LinCmsTp6\common;



class AuthMap
{
    public static $instance;

    protected $data;

    private function __construct(){}

    public static function instance():self {
        if (!isset(static::$instance)){
            static::$instance = new static();
        }
        return static::$instance;
    }

    public function getData(string $type)
    {
        return $this->data[$type] ?? [];
    }

    public function setData(array $annotation): void
    {
        $this->data[$annotation['hide']][$annotation['group']][$annotation['value']] = [];
    }

    public static function init(array $annotation):self {
        $self = static::instance();
        $self->setData($annotation);
        return $self;
    }

    public static function findAuthModule(string $auth){
        $authMap = static::instance()->getData('false');
        foreach ($authMap as $key => $value) {
            foreach ($value as $k => $v) {
                if ($auth === $k) {
                    return [
                        'auth' => $k,
                        'module' => $key
                    ];
                }
            }
        }
        return [];
    }


    public static function splitModules(array $auths, $module = 'module')
    {
        if (empty($auths)) {
            return [];
        }

        $items = [];
        $result = [];

        foreach ($auths as $key => $value) {
            if (isset($items[$value[$module]])) {
                $items[$value[$module]][] = $value;
            } else {
                $items[$value[$module]] = [$value];
            }
        }
        foreach ($items as $key => $value) {
            $item = [
                $key => $value
            ];
            array_push($result, $item);
        }
        return $result;

    }
}
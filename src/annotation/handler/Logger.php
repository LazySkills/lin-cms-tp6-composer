<?php
declare (strict_types = 1);

namespace LinCmsTp6\annotation\handler;

use Doctrine\Common\Annotations\Annotation;
use think\annotation\handler\Handler;
use think\route\RuleItem;

final class Logger extends Handler
{

    public function func(\ReflectionMethod $refMethod, Annotation $annotation, \think\route\RuleItem &$rule)
    {
        if ($this->isCurrentMethod($refMethod,$rule)){
            $params = $this->getParams($rule);
            $message = $this->getMessage($annotation->value,$params);
            \LinCmsTp6\common\Logger::annotation($message);
        }else{
            return ;
        }
    }

    public function getMessage(string $message,array $params = []){
        $args = [];
        $value = [];
        preg_match_all('/({.*})/U', $message, $args);
        foreach ($args[0] as $arg){
            $key = str_replace(['{','}'],'',$arg);
            array_push($value,$params[$key] ?? '');
        }
        return str_replace($args[0],$value,$message) ?? '';
    }


    public function getParams($rule){
        $url =  str_replace('/','|',trim(request()->url(),'/'));
        $options = method_exists($rule,'mergeGroupOptions') != false ? $rule->mergeGroupOptions() :  [];
        $getUrlParam = function ()use ($url,$options){
            if ($this instanceof RuleItem){
                $options = $this->match($url, $options, false);
                return $options;
            }
            return [];
        };

        $urlParams = $options == [] ? [] : $getUrlParam->call($rule);
        $methodParams = request()->{strtolower(request()->method())}();
        return empty($urlParams) ? $methodParams : (empty($methodParams) ? $urlParams : $urlParams + $methodParams);
    }
}

<?php
declare (strict_types = 1);

namespace LinCmsTp6\annotation\handler;

use Doctrine\Common\Annotations\Annotation;
use LinCmsTp6\common\AuthMap;
use think\annotation\handler\Handler;

final class Auth extends Handler
{

    public function func(\ReflectionMethod $refMethod, Annotation $annotation, \think\route\RuleItem &$rule)
    {
        AuthMap::init((array)$annotation);
    }

}

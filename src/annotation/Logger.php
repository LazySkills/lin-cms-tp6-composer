<?php
declare (strict_types = 1);

namespace LinCmsTp6\annotation;

use Doctrine\Common\Annotations\Annotation;

/**
 * class Logger
 * @package app\annotation
 * @Annotation
 * @Target({"METHOD"})
 */
final class Logger extends Annotation
{
    /**
     * @var array
     */
    public $format;
}

<?php

namespace Zeus\Common;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Zeus\Common\Skeleton\SkeletonClass
 */
class ZeusCommonFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'zeus-common';
    }
}

<?php

namespace ZeusVision\Common;

use Illuminate\Support\Facades\Facade;

/**
 * @see \ZeusVision\Common\Skeleton\SkeletonClass
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

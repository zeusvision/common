<?php

namespace ZeusVision\Common\Contracts;

use ZeusVision\Common\BaseRequest;

interface Action
{
    public function run(BaseRequest $request);
}

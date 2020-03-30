<?php

namespace Zeus\Common\Contracts;

use Zeus\Common\BaseRequest;

interface Action
{
    public function run(BaseRequest $request);
}

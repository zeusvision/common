<?php

namespace ZeusVision\Common;

use Illuminate\Support\Facades\DB;

abstract class BaseAction
{
    public function handle(...$args)
    {
        DB::beginTransaction();

        try {
            $this->run(...$args);
        } catch (\Throwable $exception) {
            DB::rollBack();
        }

        DB::commit();
    }

    abstract protected function run();
}

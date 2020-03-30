<?php

namespace ZeusVision\Common;

use Illuminate\Support\ServiceProvider;

class ZeusCommonServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('zeus-common.php'),
            ], 'config');
        }
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'zeus-common');
    }
}

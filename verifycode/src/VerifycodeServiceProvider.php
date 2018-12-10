<?php

namespace Cenzimo\Verifycode;

use Illuminate\Support\ServiceProvider;

class VerifycodeServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // 配置文件
        $this->publishes([
            __DIR__.'/config.php' => config_path('verifycode.php'),
        ]);
        // 数据库迁移
        $this->loadMigrationsFrom(
            __DIR__.'/migrations'
        );
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->mergeConfigForm(
            __DIR__.'/config.php', 'verifycode'
        );
    }
}

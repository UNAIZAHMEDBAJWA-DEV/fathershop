<?php

namespace fatherShop\EmailCampaign;

use Illuminate\Support\ServiceProvider;

class EmailCampaignServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__ . '/../routes/api.php');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'emailcampaign');
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
    }

    public function register(): void
    {
        //
    }
}

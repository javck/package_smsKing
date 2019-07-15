<?php
namespace Javck\SmsKing;

use Illuminate\Support\ServiceProvider;
use Javck\SmsKing\SmsKing;

class SmsKingServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->registerConfigs();
        }
        //$this->registerResources();
    }

    protected function registerConfigs()
    {
        $publishablePath = dirname(__DIR__) .'/publishable';
        $this->publishes([
            $publishablePath . '/config/smsking.php' => config_path('smsking.php')
        ], 'smsking');
    }

    public function register()
    {
        $this->app->singleton('smsking', function () {
            return new SmsKing;
        });
    }

    public function provides()
    {
        return ['smsking'];
    }

    // protected function registerResources()
    // {
    //     $this->loadViewsFrom(__DIR__ . '/../resources/views', 'ecpay');
    // }
}
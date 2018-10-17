<?php namespace Modules\Phone;

use Illuminate\Support\ServiceProvider;

class PhoneServiceProvider extends ServiceProvider
{

    /**
     * Register any application services.
     *
     * @return  void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return  void
     */
    public function boot()
    {
        //
        $this->loadViewsFrom(__DIR__ . DIRECTORY_SEPARATOR . 'resources' . DIRECTORY_SEPARATOR . 'views',
        'Modules\Phone');
    }
}
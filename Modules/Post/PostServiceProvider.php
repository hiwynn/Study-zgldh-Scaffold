<?php namespace Modules\Post;

use Illuminate\Support\ServiceProvider;

class PostServiceProvider extends ServiceProvider
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
        'Modules\Post');
    }
}
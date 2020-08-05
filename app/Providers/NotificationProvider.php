<?php

namespace App\Providers;
use View;
use Illuminate\Support\ServiceProvider;

class NotificationProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
        View::composer('app', function($view){
            $val = auth()->user()->id;
            $view->with('foo', $val);
        });
    }
}

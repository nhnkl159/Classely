<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;

use Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Carbon::setLocale('he');
        date_default_timezone_set('asia/jerusalem');

        view()->composer('*', function ($view) 
        {
            if (Auth::check())
            {
                $data = json_decode(Auth::user()->details, true);
                $view->with('current_user_details', $data);
            }
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

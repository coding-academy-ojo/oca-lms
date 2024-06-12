<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        // view()->composer(['traineesProgress', 'trainees-progress-details'], function ($view) {

        //     $notifications = \App\Absence::all(); //Change this to the code you would use to get the notifications

        //     $view->with('Absence', $absence);
        // });
    }
}

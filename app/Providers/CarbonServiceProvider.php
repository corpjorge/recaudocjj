<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use View;

class CarbonServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
      $carbon = new \Carbon\Carbon();
      \Carbon\Carbon::setLocale('es');
      View::share('carbon', $carbon);

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

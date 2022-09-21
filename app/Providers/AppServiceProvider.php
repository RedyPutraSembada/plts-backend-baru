<?php

namespace App\Providers;

use App\Models\Login;
use Illuminate\Support\Facades\Gate;
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
        if(in_array(env('APP_ENV'), ['dev','prod'])){
            \URL::forceScheme('https');
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Gate::define('admin', function(Login $login) {
            return $login->roles == "admin";
        });

        Gate::define('operator', function(Login $login) {
            return $login->roles == "operator";
        });

        Gate::define('plts', function(Login $login) {
            return $login->roles == "plts";
        });
    }
}

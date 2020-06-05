<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;


class ValidatorServiceProvider extends ServiceProvider
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
        Validator::extend('check_array', function ($attribute, $value, $parameters, $validator) {
            return count(array_filter($value, function($var) use ($parameters) { return ( $var && $var >= $parameters[0]); }));
       });
    }
}

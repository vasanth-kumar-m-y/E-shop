<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\Controllers\Requests\Request;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \Validator::extend('title', function($attribute, $value, $parameters, $validator) {
            return is_string($value) && preg_match('/^[\pL0-9 \pM]+$/u', $value);
        });

        \Validator::replacer('title', function($message, $attribute, $rule, $parameters) {
            return 'only acceptable letters, numbers and spaces';
        });        
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }
}

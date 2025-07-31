<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Blade::if('seller', function () {
            return auth()->check() && auth()->user()->roles()->first()?->name === 'فروشنده';
        });

        Blade::if('customer', function () {
            return auth()->check() && auth()->user()->roles()->first()?->name === 'کاربر عادی';
        });

        Blade::if('user', function () {
            return !auth()->check() || auth()->user()->roles()->first()?->name==='کاربر عادی';
        });
        Blade::if('admin', function () {
            return auth()->check() && auth()->user()->roles()->first()?->name==='مدیر';
        });
        //هرکی جز ادمین
        Blade::if('all', function () {
            return !auth()->check() || auth()->user()->roles()->first()?->name !=='مدیر';
        });
    }
}

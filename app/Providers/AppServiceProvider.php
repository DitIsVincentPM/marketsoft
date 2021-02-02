<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use DB;

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
        $companyname = DB::table('settings')->first();
        view()->share('companyname', $companyname->CompanyName);
        view()->share('companylogo', $companyname->CompanyLogo);
    }
}

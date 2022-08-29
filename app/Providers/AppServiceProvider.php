<?php

namespace App\Providers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

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
        // Carbon::setLocale('id');
        Paginator::useBootstrap();

        Gate::define('bendahara', function (User $user) {
            return $user->is_bendahara;
        });

        Gate::define('ketua', function (User $user) {
            return $user->name === 'Ketua Yayasan';
        });
    }
}

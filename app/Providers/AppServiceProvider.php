<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use App\Models\User;

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
        Paginator::useBootstrap();
        Gate::define('admin', function(User $user){
            return $user->level === 3;
        });
        Gate::define('freelancer', function(User $user){
            return $user->level === 1;
        });
        Gate::define('provider', function(User $user){
            return $user->level === 2;
        });
    }
}

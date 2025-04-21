<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use App\Actions\Fortify\CreateNewUser;


class FortifyServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Fortify::createUsersUsing(CreateNewUser::class);
    
        Fortify::registerView(function () {
            return view('auth.register');
        });
    
        Fortify::loginView(function () {
            return view('auth.login');
        });
    }

    public function register()
    {
    $this->app->singleton(CreatesNewUsers::class, CreateNewUser::class);
    }
}
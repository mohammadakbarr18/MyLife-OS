<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
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
        // Share user's categories globally for the transaction modal dropdowns
        View::composer('*', function ($view) {
            if (Auth::check()) {
                $user = Auth::user();
                $view->with('globalIncomeCategories', $user->categories()->income()->orderBy('name')->get());
                $view->with('globalExpenseCategories', $user->categories()->expense()->orderBy('name')->get());
            }
        });
    }
}


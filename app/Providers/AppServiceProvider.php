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
        // Share data used by the global transaction and todo modals.
        View::composer('layouts.app', function ($view) {
            if (Auth::check()) {
                $user = Auth::user();
                $view->with([
                    'globalIncomeCategories' => $user->categories()->income()->orderBy('name')->get(),
                    'globalExpenseCategories' => $user->categories()->expense()->orderBy('name')->get(),
                    'globalTaskPriorities' => $user->taskPriorities()->orderBy('created_at')->get(),
                ]);
            }
        });
    }
}

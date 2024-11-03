<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
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
        view()->composer(['layouts.navigation'], function ($view) {
            if (Auth::check()) {

                $contactsCount = Auth::user()->contacts()->count();
                $trashContactsCount = Auth::user()->contacts()->onlyTrashed()->count();

                $view->with([
                    'contactsCount' => $contactsCount,
                    'trashContactsCount' => $trashContactsCount,
                ]);
            } else {
                // Handle the case where there is no authenticated user (e.g., set it to 0 or skip)
                $view->with([
                    'contactsCount' => 0,
                    'trashContactsCount' => 0,
                ]);
            }
        });
    }
}

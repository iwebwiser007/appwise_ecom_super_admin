<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Inquiry;
use App\Observers\InquiryObserver;

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
        //
        Gate::before(function ($user, $ability) {
            return $user->hasRole('superadmin') ? true : null;
        });
        Inquiry::observe(InquiryObserver::class);
    }
}

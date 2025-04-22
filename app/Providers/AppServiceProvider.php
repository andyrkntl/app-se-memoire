<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use App\Models\Activite;
use App\Observers\ActiviteObserver;


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
        Schema::defaultStringLength(191); // Fixe la longueur des chaînes à 191

        Activite::observe(ActiviteObserver::class);

        View::composer('*', function ($view) {
            $notifications = Activite::getNotifications();
            $view->with('activiteNotifications', $notifications);
        });
    }
}

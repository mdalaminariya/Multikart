<?php

namespace App\Providers;

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
        // database migration path
         $this->loadMigrationsFrom([
            database_path('migrations/digital'),
            database_path('migrations/physical'),
        ]);
    }
}

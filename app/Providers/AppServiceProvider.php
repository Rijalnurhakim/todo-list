<?php

namespace App\Providers;

use App\Models\Position;
use App\Models\Task;
use App\Models\UserPosition;
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
        Task::observe(\App\Observers\TaskObserver::class);
        Position::observe(\App\Observers\PositionObserver::class);
        UserPosition::observe(\App\Observers\UserPositionObserver::class);
    }
}

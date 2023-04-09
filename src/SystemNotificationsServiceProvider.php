<?php

declare(strict_types=1);

namespace Dminustin\SystemNotifications;

use Dminustin\SystemNotifications\Console\Commands\BroadcastNotifications;
use Illuminate\Support\ServiceProvider;

class SystemNotificationsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/config.php' => config_path('system-notifications.php'),
            ], 'config');

            $this->commands([
                BroadcastNotifications::class
            ]);
        }
    }

    /**
     * Register the application services.
     */
    public function register(): void
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'system-notifications.php');

        // Register the main class to use with the facade
        $this->app->singleton('system-notifications', fn () => new SystemNotifications());
    }
}

<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // Prune expired database sessions - run every hour
        $schedule->command('session:prune-stale-files')->hourly();

        // Alternative: run every 6 hours (less frequent, less DB strain)
        // $schedule->command('session:prune-stale-files')->everyFourHours();

        // Log session cleanup
        $schedule->call(function () {
            \Illuminate\Support\Facades\Log::info('Session cleanup executed at ' . now());
        })->hourly();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}

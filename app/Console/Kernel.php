<?php

namespace App\Console;

use Carbon\Carbon;
use App\Models\Notification;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
         // Schedule the notification deletion task to run daily
        $schedule->call(function () {
        Notification::where('user_id', auth()->id())
            ->whereDate('created_at', '<=', Carbon::yesterday())
            ->delete();
        })->daily();
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

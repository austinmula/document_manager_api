<?php

namespace App\Console;

use App\Console\Commands\TempFilesReminders;
use App\Events\ExpiringSoon;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */

    protected $commands =[TempFilesReminders::class];
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('tempfiles:reminders')->everyMinute()->emailOutputOnFailure("admin@admin.com");
    }

    // doadimfr
    /** 
     *  Kerne
     * Register the commands for the application.
     *
     * @return void
     */ 
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}

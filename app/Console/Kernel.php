<?php

namespace App\Console;

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
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $schedule->call(function () {

            $files = DB::table('temporary_files')->where('expires_at', '<=', Carbon::now()->add(6, 'hours')->toDateTimeString())
                ->where('expires_at', '>', Carbon::now()->toDateTimeString())
                ->where('notified', 0)
                ->get();

            foreach ($files as $booking){
//                $booking->expert->user->notify(new MeetingReminderNotification());
//                $booking->customer->user->notify(new MeetingReminderNotification());
                $booking->notified = 1;
                $booking->save();
            }
        })->hourly();
    }

    /**
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

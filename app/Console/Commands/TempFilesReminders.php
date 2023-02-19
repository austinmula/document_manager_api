<?php

namespace App\Console\Commands;

use App\Events\ExpiringSoon;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class TempFilesReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tempfiles:reminders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Emails on given time intervals';

    /**
     * Execute the console command.
     */
    public function handle()

    {
//            soft Delete
        DB::table('temporary_files')
            -> where('expires_at' , '>=', Carbon::now()->toDateTimeString())
            ->update(array('deleted_at' => DB::raw('NOW()')));

// 12 hours to exp
        $files = DB::table('temporary_files')->where('expires_at', '<=', Carbon::now()->add(12, 'hours')->toDateTimeString())
            ->where('expires_at', '>', Carbon::now()->toDateTimeString())
            ->where('notified', 0)
            ->get();

        if($files){
            foreach ($files as $file){
//                $email = User::find($file->user_id)->get(['email'])->email;
//                $file->notified = 1;
//                $file->update(['notified' => 1]);

                DB::table('temporary_files')
                    ->where('user_id', $file->user_id)
                    ->where('file_id', $file->file_id)
                    ->update(['notified' => 1]);

                $email = User::find($file->user_id)->email;

                event(new ExpiringSoon('admin@admin.com', $email, 'Access To file expiring in 12 hours'));


            }
        }

// six hours to exp
        $files_two = DB::table('temporary_files')->where('expires_at', '<=', Carbon::now()->add(6, 'hours')->toDateTimeString())
            ->where('expires_at', '>', Carbon::now()->toDateTimeString())
            ->where('notified_again', 0)
            ->get();
            foreach ($files_two as $file){
//                $email = User::find($file->user_id)->get(['email'])->email;
                $email = User::find($file->user_id)->email;

                DB::table('temporary_files')
                    ->where('user_id', $file->user_id)
                    ->where('file_id', $file->file_id)
                    ->update(['notified_again' => 1]);

                event(new ExpiringSoon('admin@admin.com', $email, 'Access To file expiring in 6 hours'));
//                $file->save();
            }
    }
}

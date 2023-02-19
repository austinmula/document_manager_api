<?php

namespace App\Listeners;

use App\Events\NewUserCreated;
use App\Mail\DefaultLoginDetails;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class EmailDefaultCredentials
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(NewUserCreated $event)
    {
        //
        Mail::to($event->email)->send(new DefaultLoginDetails($event->email, $event->password));
    }
}

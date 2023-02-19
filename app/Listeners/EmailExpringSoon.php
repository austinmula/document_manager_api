<?php

namespace App\Listeners;

use App\Events\ExpiringSoon;
use App\Mail\ExpiringSoonEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class EmailExpringSoon
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
    public function handle(ExpiringSoon $event)
    {
        //
        Mail::to($event->receiverEmail)->send(new ExpiringSoonEmail($event->senderEmail, $event->receiverEmail, $event->message));

    }
}

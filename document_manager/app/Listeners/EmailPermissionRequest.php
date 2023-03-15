<?php

namespace App\Listeners;

use App\Events\UserMadePermissionRequest;
use App\Mail\PermissionRequest;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class EmailPermissionRequest
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
    public function handle(UserMadePermissionRequest $event)
    {
        //
        Mail::to($event->receiverEmail)->send(new PermissionRequest($event->senderEmail, $event->receiverEmail, $event->message));
    }
}

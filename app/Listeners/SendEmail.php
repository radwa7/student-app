<?php

namespace App\Listeners;

use App\Event\StudentCreated;
use App\Mail\StudentCreatedMessage;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendEmail
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
     * @param  \App\Event\StudentCreated  $event
     * @return void
     */
    public function handle(StudentCreated $event)
    {
        Mail::to($event->email)->send(new StudentCreatedMessage());

    }
}

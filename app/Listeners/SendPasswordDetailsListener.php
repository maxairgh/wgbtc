<?php

namespace App\Listeners;

use App\Events\PasswordResetEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendPasswordDetailsListener
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
     * @param  \App\Events\PasswordResetEvent  $event
     * @return void
     */
    public function handle(PasswordResetEvent $event)
    {
        //
    }
}

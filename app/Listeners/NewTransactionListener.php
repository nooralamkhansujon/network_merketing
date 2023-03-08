<?php

namespace App\Listeners;

use App\Models\Affiliate;
use App\Notifications\NewTransactionNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class NewTransactionListener
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
    public function handle($event)
    {
        $affiliateUser = Affiliate::findOrFail($event->affiliateUserId);
        Notification::send($affiliateUser, new NewTransactionNotification($event->affiliateUserId,$event->commission,$event->percentage,$event->user));

    }
}

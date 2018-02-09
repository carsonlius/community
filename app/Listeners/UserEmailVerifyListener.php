<?php

namespace App\Listeners;

use App\Events\UserEmailVerifyEvent;
use App\Mail\UserEmailVerify;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserEmailVerifyListener
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
     * @param  UserEmailVerifyEvent  $event
     * @return void
     */
    public function handle(UserEmailVerifyEvent $event)
    {
        dump('listening');
//        $obj_email = new UserEmailVerify($event->user);
        dump($event->user->toArray());

        \Mail::to($event->user->email)
            ->queue(new UserEmailVerify($event->user));
    }
}

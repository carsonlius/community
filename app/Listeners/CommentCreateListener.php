<?php

namespace App\Listeners;

use App\Discuss;
use App\Events\CommentCreateEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CommentCreateListener
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
     * @param CommentCreateEvent $event
     * @return void
     */
    public function handle(CommentCreateEvent $event)
    {
        // discussion 操作者的user_id
        $last_user_id = $event->comment->user_id;
        $discussion_id = $event->comment->discussion_id;
        $discussion = Discuss::find($discussion_id);
        $discussion->last_user_id = $last_user_id;
        $discussion->save();
    }
}

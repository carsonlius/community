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
        $updated_at = date('Y-m-d H:i:s');
        Discuss::where(['id' => $discussion_id])->update(compact('last_user_id','updated_at'));
    }
}

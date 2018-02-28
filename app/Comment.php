<?php

namespace App;

use App\Events\CommentCreateEvent;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['user_id', 'discussion_id', 'body'];

    protected $dispatchesEvents = [
        'created' => CommentCreateEvent::class
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function discussion()
    {
        return $this->belongsTo(Discuss::class);
    }
}

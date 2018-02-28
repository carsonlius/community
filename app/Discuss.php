<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discuss extends Model
{

    protected $fillable = ['user_id', 'last_user_id', 'body', 'title', 'father'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function lastUser()
    {
        return $this->belongsTo(User::class, 'last_user_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'discussion_id');
    }
}

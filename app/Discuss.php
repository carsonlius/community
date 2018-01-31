<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discuss extends Model
{

    protected $fillable = ['user_id', 'last_user_id', 'body', 'title'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

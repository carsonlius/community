<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    protected $fillable = ['user_id', 'discuss_id'];

    public function user()
    {
        return $this->belongsToMany(User::class);
    }

    public function discussions()
    {
        return $this->belongsToMany(Discuss::class);
    }
}

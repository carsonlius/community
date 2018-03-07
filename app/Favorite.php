<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    protected $fillable = ['user_id', 'discuss_id'];

    public function user()
    {
        $this->belongsToMany(User::class);
    }

    public function discussions()
    {
        $this->belongsToMany(Discuss::class);
    }
}

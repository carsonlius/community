<?php

namespace App;

use App\Events\UserEmailVerifyEvent;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'is_confirmed', 'confirm_code', 'name', 'email', 'password', 'avatar', 'social_id', 'social_type'
    ];

    protected $dispatchesEvents = [
        'created' => UserEmailVerifyEvent::class
    ];

    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];

    // password 加密存入数据库
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    public function discussions()
    {
        return $this->hasMany(Discuss::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function lastUser()
    {
        return $this->belongsTo(User::class, 'last_user_id');
    }

    // 收藏的帖子 多对多
    public function loveFavorites()
    {
        return $this->belongsToMany(Discuss::class, 'favorites', 'user_id', 'discuss_id')->withTimestamps();
    }
}

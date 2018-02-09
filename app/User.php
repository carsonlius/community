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
        'is_confirmed', 'confirm_code','name', 'email','password','avatar'
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

    public function discussions()
    {
        return $this->hasMany(Discuss::class);
    }

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }
}
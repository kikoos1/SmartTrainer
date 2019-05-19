<?php

namespace App;

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
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function friends()
	{
        return $this->belongsToMany(User::class, 'friends', 'user_id', 'friend_id')
        // if you want to rely on accepted field, then add this:
            ->withPivot('is_friends')
        ->wherePivot('is_friends', '=', 1);
	}
}

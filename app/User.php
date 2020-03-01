<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'password',
        'confirmed',
        'enabled',
        'locked'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'username_verified_at' => 'datetime',
    ];

    public function member() {
        return $this->hasOne('App\Member');
    }

    /**
     * Find the user instance for the given username.
     *
     * @param  string  $username
     * @return \App\User
     */
    public function findForPassport($username)
    {
        return $this->where('username', $username)->first();
    }
}

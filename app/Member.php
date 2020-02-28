<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model {
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'first_name',
        'middle_names',
        'last_name',
        'email_address',
        'gender',
        'occupation'
    ];

    /**
     * Get all of the addresses for the member.
     */
    public function addresses() {
        return $this->hasMany('App\Address');
    }

    /**
     * Get the user that owns the member.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

}

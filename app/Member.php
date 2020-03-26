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
        'first_name',
        'middle_name',
        'last_name',
        'email',
        'gender',
        'occupation',
        'phone_number',
        'community_id'
    ];

    /**
     * Get the address of the member.
     */
    public function address() {
        return $this->hasOne('App\Address');
    }

    /**
     * Get the community that owns the member.
     */
    public function community() {
        return $this->belongsTo('App\Community');
    }
}

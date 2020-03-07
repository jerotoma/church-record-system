<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patron extends Model {
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'member_id',
        'giving_id',
        'amount',
    ];

     /**
     * Get the member that owns the patron.
     */
    public function member() {
        return $this->belongsTo('App\Member');
    }

    /**
     * The givings that belong to the member.
     */
    public function giving() {
        return $this->belongsTo('App\Giving');
    }
}

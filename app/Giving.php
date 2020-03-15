<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Giving extends Model {

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'member_id',
        'giving_type_id',
        'amount',
        'date_paid',
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
    public function givingType() {
        return $this->belongsTo('App\GivingType');
    }
}

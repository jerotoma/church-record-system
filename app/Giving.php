<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Giving extends Model {
    protected $fillable = [
        'name',
        'amount',
        'minAmount',
        'maxAmount',
        'targetNumber',
        'description'
    ];

    /**
     * The members that belong to the giving.
     */
    public function members() {
        return $this->belongsToMany('App\Member');
    }
}

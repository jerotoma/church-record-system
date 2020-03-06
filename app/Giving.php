<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Giving extends Model {
    protected $fillable = [
        'name',
        'amount',
        'min_amount',
        'max_amount',
        'target_number',
        'description'
    ];

    /**
     * The members that belong to the giving.
     */
    public function members() {
        return $this->belongsToMany('App\Member');
    }
}

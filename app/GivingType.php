<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GivingType extends Model {
    protected $fillable = [
        'name',
        'amount',
        'min_amount',
        'max_amount',
        'target_number',
        'description'
    ];



    /**
     * The patrons that belong to the giving.
     */
    public function patrons() {
        return $this->hasMany('App\Patron');
    }
}

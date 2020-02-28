<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model {

    protected $fillable = [
        'member_id',
        'street_address',
        'unit_number',
        'city',
        'country',
        'state',
        'postal_code',
    ];

     /**
     * Get the member that owns the address.
     */
    public function member() {
        return $this->belongsTo('App\Member');
    }

}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Community extends Model {

    protected $fillable = [
            'name',
            'code',
            'zone_id'
        ];

        /**
     * Get all of the addresses for the member.
     */
    public function zone() {
        return $this->belongTo('App\Zone');
    }

}

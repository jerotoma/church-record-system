<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parish extends Model {

    protected $fillable = [
        'name',
        'code'
    ];
    //

    /**
     * Get all of the zones for the Parish.
     */
    public function zones() {
        return $this->hasMany('App\Zone');
    }
}

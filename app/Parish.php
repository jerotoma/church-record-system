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
     * Get all of the addresses for the member.
     */
    public function zones() {
        return $this->hasMany('App\Zone');
    }
}

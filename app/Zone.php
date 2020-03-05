<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Zone extends Model {

    protected $fillable = [
            'name',
            'code',
            'parish_id'
        ];

    protected $with = ['parish'];

     /**
     * Get the member that owns the address.
     */
    public function parish() {
        return $this->belongsTo('App\Parish');
    }

     /**
     * Get all of the addresses for the member.
     */
    public function communities() {
        return $this->hasMany('App\Community');
    }

}

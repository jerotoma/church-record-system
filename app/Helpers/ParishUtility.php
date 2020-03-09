<?php
namespace App\Helpers;

use App\Parish;

class ParishUtility {

    public static function  mapParishes($parishes) {
        $mParishes = array();
        if ($parishes != null ) {
            foreach ($parishes as $parish) {
                $mParishes[] = self::mapParish($parish);
            }
           return $mParishes;
        }
        return [];
    }

    public static function mapParish(Parish $parish) {

       //dd($member );
        return [
            'id' => $parish->id,
            'name' => $parish->name,
            'code' => $parish->code
        ];
    }

}

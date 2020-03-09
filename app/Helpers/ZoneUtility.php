<?php
namespace App\Helpers;

use App\Zone;

class ZoneUtility {

    public static function  mapZones($zones) {
        $mZones = array();
        if ($zones != null ) {
            foreach($zones as $zone) {
                $mZones[] = self::mapZone($zone);
            }
           return $mZones;
        }
        return [];
    }

    public static function mapZone(Zone $zone) {

       //dd($member );
        return [
            'id' => $zone->id,
            'name' => $zone->name,
            'code' => $zone->code,
            'parishId' =>$zone->parish_id,
            'parish' =>$zone->parish
        ];
    }

}

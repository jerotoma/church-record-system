<?php
namespace App\Helpers;

use App\Community;
use App\Helpers\ZoneUtility;

class CommunityUtility {

    public static function  mapCommunities($communities) {
        $mCommunities = array();
        if ($communities != null ) {
            foreach ($communities as $community) {
                $mCommunities[] = self::mapCommunity($community);
            }
           return $mCommunities;
        }
        return [];
    }

    public static function mapCommunity(Community $community) {

       //dd($member );
        return [
            'id' => $community->id,
            'name' => $community->name,
            'code' => $community->code,
            'zoneId' => $community->zone_id,
            'zone' => ZoneUtility::mapZone($community->zone),
        ];
    }

}

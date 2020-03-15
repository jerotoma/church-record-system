<?php
namespace App\Helpers;

use App\Giving;
use App\Helpers\MemberUtility;
use App\Helpers\GivingUtility;


class GivingUtility {

    public static function  mapGivings($givings) {
        $mGivings = array();
        if ($givings != null ) {
            foreach ($givings as $giving) {
                $mGivings[] = self::mapGiving($giving);
            }
           return $mGivings;
        }
        return [];
    }

    public static function mapGiving(Giving $giving) {

        $member = MemberUtility::mapMember($giving->member);
        $giving = GivingTypeUtility::mapGiving($giving->givingType);

        return [
            'id' => $giving->id,
            'member' => $member,
            'giving' => $giving,
            'fullName' => $member['firstName'] . ' ' . $member['lastName'],
            'amount' => $giving->amount,
            'givingType' => $giving['name'],
            'zone' => $member['community']['zone']['name'],
            'community' => $member['community']['name'],
            'datePaid' => $giving->date_paid,
        ];
    }

}

<?php
namespace App\Helpers;

use App\Patron;
use App\MemberUtility;
use App\GivingUtility;


class PatronUtility {

    public static function  mapPatrons($patrons) {
        $mPatrons = array();
        if ($patrons != null ) {
            foreach ($patrons as $patron) {
                $mPatrons[] = self::mapPatron($patron);
            }
           return $mPatrons;
        }
        return [];
    }

    public static function mapPatron(Patron $patron) {

        $member = MemberUtility::mapMember($patron->member);
        $giving = GivingUtility::mapMember($patron->member);
        return [
            'id' => $patron->id,
            'member' => $member,
            'giving' => $giving,
            'fullName' => $member->firstName . ' ' . $member->lastname,
            'amount' => $patron->amount,
            'givingType' => $giving->name,
            'zone' => $member->community->zone->name,
            'community' => $member->community->name,
            'datePaid' => $patron->date_paid,
        ];
    }

}

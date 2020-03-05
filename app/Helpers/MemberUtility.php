<?php
namespace  App\Helpers;

use App\Member;
use App\Helpers\AddressUtility;

class MemberUtility {

    public static function mapMember(Member $member) {
        if ($member == null) {
            return [];
        }

        return [
            'id' => $member->id,
            'firstName' => $member->first_name,
            'lastName' => $member->last_name,
            'middleName' => $member->middle_name,
            'email' => $member->email,
            'phoneNumber' => $member->phone_number,
            'gender' => $member->gender,
            'occupation' => $member->occupation,
            'addresses' => AddressUtility::mapAddresses($member),
            'community' => [
                'id' => $member->community->id,
                'name' => $member->community->name,
                'code' => $member->community->code,
                'zone' => [
                    'id' => $member->community->zone->id,
                    'name' => $member->community->zone->name,
                    'code' => $member->community->zone->code,
                    'parish' => [
                        'id' => $member->community->zone->parish->id,
                        'name' => $member->community->zone->parish->name,
                        'code' => $member->community->zone->parish->code,
                    ]
                ]
            ],
        ];
    }


}
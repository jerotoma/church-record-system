<?php
namespace  App\Helpers;

use App\Member;
use App\Address;
use App\Helpers\AddressUtility;
use App\Helpers\HelperUtility;

class MemberUtility {

    public static function mapMembers($members) {
        $items = array();
        if ($members == null) {
            return array();
        }
        foreach ($members as $member) {
            $items[] = self::mapMember($member);
        }
        return $items;
    }

    public static function mapMember(Member $member) {
        if ($member == null) {
            return [];
        }
       // dd($member);
        $address = HelperUtility::arrayToObject(
            AddressUtility::mapAddress($member->address == null ? Address::find($member->addressId) : $member->address));
        return [
            'id' => $member->id,
            'firstName' => $member->first_name,
            'lastName' => $member->last_name,
            'middleName' => $member->middle_name,
            'email' => $member->email,
            'phone' => $member->phone,
            'gender' => $member->gender,
            'occupation' => $member->occupation,
            'addressId' => $address->id,
            'streetAddress' => $address->streetAddress,
            'unitNumber' => $address->unitNumber,
            'city' => $address->city,
            'country' => $address->country,
            'state' => $address->state,
            'postalCode' => $address->postalCode,
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
            'parishId' => $member->community->zone->parish->id,
            'zoneId' => $member->community->zone->id,
            'communityId' => $member->community->id,
        ];
    }
}

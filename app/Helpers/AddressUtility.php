<?php
namespace  App\Helpers;

use App\Member;
use App\Address;

class AddressUtility {

    public static function mapAddresses(Member $member) {
        $mAddresses = array();
        if ($member != null && $member->addresses != null) {
            foreach ($member->addresses as $address) {
                $mAddresses[] = self::mapAddress($address);
            }
           return $mAddresses;
        }
        return [];
    }

    public static function mapAddress(Address $address){
        return [
            'id' => $address->id,
            'streetAddress' => $address->street_address,
            'unitNumber' => $address->unit_number,
            'city' => $address->city,
            'country' => $address->country,
            'state' => $address->state,
            'postalCode' => $address->postal_code,
        ];
    }

}

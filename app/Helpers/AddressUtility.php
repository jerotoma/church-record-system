<?php
namespace  App\Helpers;

use App\Member;

class AddressUtility {

    public static function mapAddresses(Member $member) {
        $mAddresses = array();
        if ($member != null && $member->addresses != null) {
            foreach ($member->addresses as $address) {
                $mAddresses[] = [
                    'streetAddress' => $address->street_address,
                    'unitNumber' => $address->unit_number,
                    'city' => $address->city,
                    'country' => $address->country,
                    'state' => $address->state,
                    'postalCode' => $address->postal_code,
                ];
            }
           return $mAddresses;
        }
        return [];
    }

}

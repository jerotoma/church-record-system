<?php
namespace  App\Helpers;

use App\User;
use App\Helpers\AddressUtility;
use App\Helpers\HelperUtility;
use \stdClass;

class UserUtility {

    public static function mapUser(User $user) {
        if ($user == null) {
            return [];
        }
        return [
            'id' => $user->id,
            'firstName' => $user->first_name,
            'lastName' => $user->last_name,
            'middleName' => $user->middle_name,
            'username' => $user->username,
            'phoneNumber' => $user->phone_number,
            'gender' => $user->gender,
        ];
    }
}

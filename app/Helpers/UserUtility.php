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
            'role' => $user->role
        ];
    }
    public static function mapRole($role) {
        if ($role == null) {
            return [];
        }
        return  [
            'id' => $role->id,
            'name' => $role->name,
            'slug' => $role->slug,
            'description' => $role->description,
            'level' => $role->level,
        ];
    }

    public static function mapPermissions($permissions) {
       //dd($permissions);
        $userPermissions = array();
        if ($permissions != null) {
            foreach ($permissions as $key => $permission) {
                $userPermissions[] = [
                    'id' => $permission->id,
                    'name' => $permission->name,
                    'slug' => $permission->slug,
                    'description' => $permission->description
                ];
            }
        }
       return $userPermissions;
    }

}

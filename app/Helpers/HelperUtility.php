<?php
namespace  App\Helpers;

use \stdClass;

class HelperUtility {

    public static function array_to_obj($array, &$obj) {
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $obj->$key = new stdClass();
                self::array_to_obj($value, $obj->$key);
            } else {
                $obj->$key = $value;
            }
        }
        return $obj;
    }

    public static function arrayToObject($array) {
        $object = new stdClass();
        return self::array_to_obj($array, $object);
    }

}

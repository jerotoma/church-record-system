<?php
namespace  App\Helpers;

use App\GivingType;

class GivingTypeUtility {

    public static function mapGivingType(GivingType $givingType){
        return [
            'id'  => $givingType->id,
            'name'  => $givingType->name,
            'amount' => $givingType->amount,
            'minAmount' => $givingType->min_amount,
            'maxAmount' => $givingType->max_amount,
            'targetNumber' => $givingType->target_number,
            'description' => $givingType->description,
        ];
    }

    public static function mapGivingTypes($givingTypes){
        $mGivingTypes = array();
        foreach ($givingTypes as $givingType) {
            $mGivingTypes[] = self::mapGivingType($givingType);
        }
        return $mGivingTypes;
    }

}

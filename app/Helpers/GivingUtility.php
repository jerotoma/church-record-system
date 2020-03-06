<?php
namespace  App\Helpers;

use App\Giving;

class GivingUtility {

    public static function mapGiving(Giving $giving){
        return [
            'id'  => $giving->id,
            'name'  => $giving->name,
            'amount' => $giving->amount,
            'minAmount' => $giving->min_amount,
            'maxAmount' => $giving->max_amount,
            'targetNumber' => $giving->target_number,
            'description' => $giving->description,
        ];
    }

    public static function mapGivings($givings){
        $mGivings = array();
        foreach ($givings as $giving) {
            $mGivings[] = self::mapGiving($giving);
        }
        return $mGivings;
    }

}

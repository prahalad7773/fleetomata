<?php

namespace App\Models\Trips;

class MoneyFormatter
{
    public static function format($amount)
    {
        list($number, $decimal) = explode('.', sprintf('%.2f', floatval($amount)));
        $sign = $number < 0 ? '-' : '';
        $number = abs($number);
        for ($i = 3; $i < strlen($number); $i += 3) {
            $number = substr_replace($number, ',', -$i, 0);
        }
        return $sign . $number . '.' . $decimal;
    }
}

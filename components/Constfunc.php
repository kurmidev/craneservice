<?php

namespace app\components;


class ConstFunc
{

    public static function getLabels($label, $values)
    {
        return !empty($label[$values]) ? $label[$values] : null;
    }

    public static function calculateTax($amount,$percentage){
        return ($amount*$percentage)/100;
    }

}

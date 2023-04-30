<?php

namespace app\components;


class ConstFunc
{

    public static function getLabels($label, $values)
    {
        return !empty($label[$values]) ? $label[$values] : null;
    }
}

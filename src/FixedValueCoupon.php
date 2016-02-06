<?php

namespace App;

class FixedValueCoupon
{
    public $value;

    public function __construct($attributes)
    {
        $this->value = $attributes['value'];
    }

    public function discount($order)
    {
        return $this->value;
    }
}

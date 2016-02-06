<?php

namespace App;

class PercentOffCoupon
{
    public $value;

    public function __construct($attributes)
    {
        $this->value = $attributes['value'];
    }

    public function discount($order)
    {
        return $order->grossTotal() * ($this->value / 100);
    }
}

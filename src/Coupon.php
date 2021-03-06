<?php

namespace App;

class Coupon
{
    public $value;
    public $is_percent;

    public function __construct($attributes)
    {
        $this->value = $attributes['value'];
        $this->is_percent = $attributes['is_percent'];
    }

    public function discount($order)
    {
        if ($this->is_percent) {
            return $order->grossTotal() * ($this->value / 100);
        }

        return $this->value;
    }
}

<?php

namespace App;

class MinimumQuantityCoupon
{
    public $coupon;
    public $minimum_quantity;

    public function __construct($attributes)
    {
        $this->coupon = $attributes['coupon'];
        $this->minimum_quantity = $attributes['minimum_quantity'];
    }

    public function discount($order)
    {
        if ($order->quantity() < $this->minimum_quantity) {
            return 0;
        }

        return $this->coupon->discount($order);
    }
}

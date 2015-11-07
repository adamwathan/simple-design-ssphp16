<?php

namespace App;

class Coupon
{
    public $value;

    public function __construct($attributes)
    {
        $this->value = $attributes['value'];
    }
}

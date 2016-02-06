<?php

namespace App;

use Illuminate\Support\Collection;

class Order
{
    private $books;
    private $coupon;

    public function __construct($books)
    {
        $this->books = new Collection($books);
        $this->coupon = new NoCoupon;
    }

    public function applyCoupon($coupon)
    {
        $this->coupon = $coupon;
    }

    public function total()
    {
        return $this->grossTotal() - $this->calculateDiscount();
    }

    public function grossTotal()
    {
        return $this->books->sum('price');
    }

    public function quantity()
    {
        return $this->books->count();
    }

    private function calculateDiscount()
    {
        return $this->coupon->discount($this);
    }
}

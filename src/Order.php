<?php

namespace App;

class Order
{
    private $books;
    private $coupon;

    public function __construct($books)
    {
        $this->books = $books;
    }

    public function applyCoupon($coupon)
    {
        $this->coupon = $coupon;
    }

    public function total()
    {
        if (isset($this->coupon)) {
            $discount = $this->coupon->value;
        } else {
            $discount = 0;
        }

        $totalPrice = 0;

        foreach ($this->books as $book) {
            $totalPrice += $book->price;
        }

        return $totalPrice - $discount;
    }
}

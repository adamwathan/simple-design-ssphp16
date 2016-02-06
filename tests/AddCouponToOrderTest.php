<?php

use App\Book;
use App\Coupon;
use App\FixedValueCoupon;
use App\MinimumQuantityCoupon;
use App\Order;
use App\PercentOffCoupon;

class AddCouponToOrderTest extends PHPUnit_Framework_TestCase
{
    function test_an_order_with_no_coupon_is_not_discounted()
    {
        $books = [
            new Book(['price' => 2000]),
            new Book(['price' => 3000]),
            new Book(['price' => 4000]),
        ];

        $order = new Order($books);

        $this->assertEquals(9000, $order->total());
    }

    function test_a_discount_is_applied_when_a_coupon_is_added_to_an_order()
    {
        $books = [
            new Book(['price' => 2000]),
            new Book(['price' => 3000]),
            new Book(['price' => 4000]),
        ];

        $coupon = new FixedValueCoupon([
            'value' => 1000,
        ]);

        $order = new Order($books);

        $order->applyCoupon($coupon);

        $this->assertEquals(8000, $order->total());
    }






    function test_an_order_is_discounted_by_a_percentage_when_a_percent_off_coupon_is_applied()
    {
        $books = [
            new Book(['price' => 2000]),
            new Book(['price' => 3000]),
            new Book(['price' => 4000]),
        ];

        $coupon = new PercentOffCoupon([
            'value' => 30,
        ]);

        $order = new Order($books);

        $order->applyCoupon($coupon);

        $this->assertEquals(6300, $order->total());
    }






    function test_a_minimum_quantity_coupon_applies_a_discount_if_the_order_contains_the_minimum_amount_of_items()
    {
        $books = [
            new Book(['price' => 2000]),
            new Book(['price' => 3000]),
            new Book(['price' => 4000]),
        ];

        $coupon = new MinimumQuantityCoupon([
            'coupon' => new PercentOffCoupon(['value' => 20]),
            'minimum_quantity' => 2,
        ]);

        $order = new Order($books);

        $order->applyCoupon($coupon);

        $this->assertEquals(7200, $order->total());
    }

    function test_a_minimum_quantity_coupon_does_not_apply_a_discount_if_the_order_does_not_contain_the_minimum_amount_of_items()
    {
        $books = [
            new Book(['price' => 2000]),
            new Book(['price' => 3000]),
        ];

        $coupon = new MinimumQuantityCoupon([
            'coupon' => new PercentOffCoupon(['value' => 20]),
            'minimum_quantity' => 3,
        ]);

        $order = new Order($books);

        $order->applyCoupon($coupon);

        $this->assertEquals(5000, $order->total());
    }
}

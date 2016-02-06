<?php

namespace App;

class NoCoupon
{
    public function discount($order)
    {
        return 0;
    }
}

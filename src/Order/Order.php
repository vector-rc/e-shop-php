<?php

namespace E5\Order;

class Order
{
    
    public function __construct(
        public ?int $id=null,
        public int $user_id,
        public string $date_time,
        public float $discount,
        public float $subtotal,
        public float $total,
        public string $state,
        public int $enable
    ) {
    }
}

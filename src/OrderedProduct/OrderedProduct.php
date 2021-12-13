<?php 
namespace E5\OrderedProduct;


class OrderedProduct
{
    public function __construct(
        public ?int $id = null,
        public int $product_id,
        public int $order_id,
        public int $quantity=1,
        public int $enable = 1,
    ) {
    }
}

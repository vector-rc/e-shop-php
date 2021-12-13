<?php 
namespace E5\Product;


class Product
{
    public function __construct(
        public ?int $id = null,
        public string $name,
        public string $price,
        public string $state,
        public string $description,
        public int $stock = 1,
        public int $user_id,
        public int $category_id,
        public string $image = '',
        public int $enable = 1
    ) {
    }
}

 ?>

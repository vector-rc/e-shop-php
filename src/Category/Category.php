<?php

namespace E5\Category;

final class Category
{
    public function __construct(
        public $id,
        public $name,
        public $description,
        public $enable
    ) {
    }
}

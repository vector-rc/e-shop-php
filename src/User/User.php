<?php

namespace E5\User;

class User
{
    public function __construct(
        public $id,
        public $names,
        public $surnames,
        public $email,
        public $password,
        public $address,
        public $mobile,
        public $image,
        public $enable
    ) {
    }
}

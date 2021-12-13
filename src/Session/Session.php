<?php

namespace E5A\Session;

final class Session
{
    public function __construct(
        public $id,
        public $user_id,
        public $date_expiration,
    ) {
    }

    public function __invoke()
    {
    }
}

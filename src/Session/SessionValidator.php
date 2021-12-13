<?php

namespace E5A\Session;

use E5\Shared\MysqlRepository;

final class SessionValidator
{
    public function __construct(public $id)
    {
    }

    public function __invoke()
    {
        $mysql_repository = new MysqlRepository();
        $session = $mysql_repository->select('session',null,'id=:id', ['id' => $this->id]);
        return $session?$session[0]:$session;
      
    }
}

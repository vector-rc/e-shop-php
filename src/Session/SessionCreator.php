<?php

namespace E5\Session;

use E5\User\User;
use E5\Shared\MysqlRepository;
use DateTime;

final class SessionCreator
{
    public function __construct(public User $user)
    {
    }

    public function __invoke()
    {
        $mysql_repository = new MysqlRepository();
        $token = hash('sha256', $this->user->email . time());
        $mysql_repository->delete('session', 'user_id=:user_id', ['user_id' => $this->user->id], true);

        $new_session = $mysql_repository->insert('session', ['id' => $token, 'user_id' => $this->user->id, 'user_email' => $this->user->email, 'date_expiration' => date_modify(new DateTime(), '+1 day')->format('Y-m-d')]);
        if ($new_session) {
            return $new_session;
        }
    }
}

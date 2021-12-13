<?php

namespace E5\User;


class AuthenticateUser
{
    public function __construct(private $email, private $password)
    {
    }
    public function __invoke()
    {
        $user_repository = new UserRepository();
        if (!$user_repository->exist($this->email)) {
            return false;
        }
        $password_validate = new PasswordValidate($this->password, $this->email);
        $user = $password_validate();


        return $user ? new User($user['id'], $user['names'], $user['surnames'], $user['mobile'], $user['email'], $user['password'], $user['address'], $user['image'], 1) : false;
    }
}

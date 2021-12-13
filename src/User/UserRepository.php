<?php

namespace E5\User;

use E5\Shared\MysqlRepository;

class UserRepository
{
    private $repository;
    public function __construct()
    {
        $this->repository = new MysqlRepository();
    }

    public function findAll()
    {
        return $this->repository->select('user', null, 'enable=1');
    }
    public function findByEmail($email)
    {
        $data = $this->repository->select('user', null, 'email=:email', ['email' => $email]);
        return $data ? $data[0] : $data;
    }
    public function findById($id)
    {
        $data = $this->repository->select('user', null, 'id=:id', ['id' => $id]);
        return $data ? $data[0] : $data;
    }

    public function save(User $user)
    {
        if ($this->findByEmail($user->email)) {
            return;
        }
        $encrypt_password = new EncryptPassword($user->password);
        $user->password = $encrypt_password();
        return $this->repository->insert('user', (array)$user);
    }

    public function edit(User $user)
    {
        $encrypt_password = new EncryptPassword($user->password);
        $user->password = $encrypt_password();
        $response = $this->repository->update("user", (array)$user, 'id=:id');
        return $response;
    }

    public function delete($id)
    {
        return $this->repository->delete('user', 'id=:id', ['id' => $id]);
    }

    public function exist($email)
    {
        return $this->repository->select('user', null, 'email=:email', ['email' => $email]);
    }
}

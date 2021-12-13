<?php

namespace E5\Order;

use E5\Shared\MysqlRepository;

class OrderRepository
{
    public MysqlRepository $repository;
    public function __construct()
    {
        $this->repository = new MysqlRepository();
    }

    public function findAll()
    {
        $response = $this->repository->select("`order`", null, "enable=1");
        return $response;
    }

    public function findById($id)
    {
        $response = $this->repository->select("`order`", null, 'id=:id and enable=1', [':id' => $id]);
        return $response[0];
    }
    public function findByUserId($user_id)
    {
        $response = $this->repository->select("`order`", null, 'user_id=:user_id and enable=1', [':user_id' => $user_id]);
        return $response;
    }

    public function save(Order $new_order)
    {
        $response = $this->repository->insert("`order`", (array)$new_order);
        return $response;
    }


    public function edit(Order|array $order)
    {
        $response = $this->repository->update("`order`", (array)$order, 'id=:id');
        return $response;
    }

    public function delete(int $id)
    {
        return $this->repository->delete("`order`",'id=:id',['id'=>$id]);
    }
}

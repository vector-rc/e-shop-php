<?php

namespace E5\OrderedProduct;

use E5\Shared\MysqlRepository;

class OrderedProductRepository
{
    private $repository;
    public function __construct()
    {
        $this->repository = new MysqlRepository();
    }

    public function findAll()
    {
        return $this->repository->select('ordered_product', null, 'enable=1');
    }
    public function findById($id)
    {
        $data = $this->repository->select('ordered_product', null, 'id=:id and enable=1', ['id' => $id]);
        return $data ? $data[0] : $data;
    }

    public function findByOrderId($order_id)
    {
        $data = $this->repository->select('ordered_product', null, 'order_id=:order_id and enable=1', ['order_id' => $order_id]);
        return $data;
    }

    public function save(OrderedProduct $ordered_product)
    {

        return $this->repository->insert('ordered_product', (array)$ordered_product);
    }
    public function edit(OrderedProduct $ordered_product)
    {

        return $this->repository->update('ordered_product', (array)$ordered_product, 'id=:id');
    }
    public function delete($id, $permanent = false)
    {
        return $this->repository->delete('ordered_product','id=:id',['id'=>$id], $permanent);
    }
}

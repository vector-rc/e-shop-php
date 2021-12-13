<?php

namespace E5\Product;


use E5\Shared\MysqlRepository;

class ProductRepository
{
    private $repository;
    public function __construct()
    {
        $this->repository = new MysqlRepository();
    }

    public function findAll()
    {
        return $this->repository->select('product', null, 'enable=1');
    }

    public function findById($id)
    {
        $data = $this->repository->select('product', null, 'id=:id and enable=1', ['id' => $id]);
        return $data ? $data[0] : $data;
    }

    public function findByUserId($user_id)
    {
        $data = $this->repository->select('product', null, 'user_id=:user_id and enable=1', ['user_id' => $user_id]);
        return $data;
    }

    public function findByCategoryId($category_id)
    {
        $data = $this->repository->select('product', null, 'category_id=:category_id and enable=1', ['category_id' => $category_id]);
        return $data;
    }
    public function findLast($limit = 40)
    {
        $data = $this->repository->select('product', null, 'enable=1 ORDER BY id DESC LIMIT '.$limit);
        return $data;
    }

    public function search(string $expression)
    {
        $wordsFinder = explode(' ', $expression);
        $response = array();
        foreach ($wordsFinder as $i) {
            if (strlen($i) < 2) continue;
            $request = $this->repository->select('product', null, '(concat(name,description) like :expression) and enable=1', [':expression' => "%$i%"]);
            foreach ($request as $k) {
                if (count($response) == 0) {
                    array_push($response, (array)$k);
                    continue;
                }
                if (!in_array($k['id'], array_column($response, 'id'))) {
                    array_push($response, (array)$k);
                }
            }
        }

        return $response;
    }

    // print('<pre>');
    // print_r($response);
    // print('</pre>');
    public function save(Product $product)
    {

        return $this->repository->insert('product', (array)$product);
    }

    public function edit(Product $product)
    {

        return $this->repository->update('product', (array)$product, 'id=:id');
    }

    public function delete($id)
    {
        return $this->repository->delete('product', 'id=:id', ['id' => $id]);
    }
}

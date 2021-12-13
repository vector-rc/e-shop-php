<table class="table table-bordered " id="list-cart">
    <thead>
        <tr>
            <th scope="col">Imagen</th>
            <th scope="col">Nombre</th>
            <th scope="col">Precio unitario</th>
            <th scope="col">Cantidad</th>
            <th scope="col">Monto</th>
        </tr>
    </thead>
    <tbody>
        <?php

        use E5\Order\OrderRepository;
        use E5\OrderedProduct\OrderedProductRepository;
        use E5\Product\ProductRepository;

        $_or = new OrderRepository();
        $_pr = new ProductRepository();
        $_opr = new OrderedProductRepository();
        $order = $_or->findById($id);
        $products_ordered = $_opr->findByOrderId($id);
        $total = 0;
        foreach ($products_ordered as $prod_ord) {
            $product = $_pr->findById($prod_ord['product_id']);
            $total += $product['price'] * $prod_ord['quantity'];
        ?>
            <tr>
                <th scope="row"><img src="/tienda_e5/images_products/<?= $product['image'] ?>" style="width: 5rem;height: 5rem;" alt=""></th>
                <td><?= $product['name'] ?></td>
                <td>S/.<?= $product['price'] ?></td>
                <td><?= $prod_ord['quantity'] ?></td>
                <td>S/.<?= $product['price'] * $prod_ord['quantity'] ?></td>
            </tr>

        <?php
        }

        ?>
        <tr style="font-weight: bold">
            <th colspan='3'></th>
            <td>TOTAL</td>
            <td>S/ <?= $total ?></td>
        </tr>
    </tbody>
</table>
<div>
    <?php
    if ($order['state'] == 'not_payed') {
    ?>
        <a name="" id="" class="btn btn-outline-dark" href="/tienda_e5/pay_details/<?= $order['id'] ?>" role="button">Comprar ahora</a>
    <?php
    }
    ?>
</div>

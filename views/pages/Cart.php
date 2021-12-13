<?php

use E5\Product\ProductRepository;

if (count($_SESSION['cart']) > 0) {


?>
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


            if (isset($_SESSION['cart'])) {
                $_pr = new ProductRepository();
                $total = 0;
                foreach ($_SESSION['cart'] as $prod_id => $stock) {
                    $product = $_pr->findById($prod_id);
                    $total += $product['price'] * $stock;
            ?>
                    <tr>
                        <th scope="row"><img src="/tienda_e5/images_products/<?= $product['image'] ?>" style="width: 5rem;height: 5rem;" alt=""></th>
                        <td><?= $product['name'] ?></td>
                        <td>S/.<?= $product['price'] ?></td>
                        <td><input data-price="<?= $product['price'] ?>" data-id="<?= $product['id'] ?>" type="number" class="field-quantity" name='stock' value="<?= $stock ?>"></td>
                        <td>S/.<?= $product['price'] * $stock ?></td>
                        <td><a class="btn btn-danger" href="/tienda_e5/controllers/quit_cart/<?= $product['id'] ?>">Quitar</a></td>
                    </tr>

            <?php
                }
            }
            ?>
            <tr style="font-weight: bold">
                <th colspan='3'></th>
                <td>TOTAL</td>
                <td id="total-mount">S/ <?= $total ?></td>
            </tr>
        </tbody>
    </table>

    <div>
        <a name="" id="" class="btn btn-outline-dark" href="/tienda_e5/controllers/sale" role="button">Comprar ahora</a>
        <a name="" id="" class="btn btn-link" href="/tienda_e5/controllers/new_order" role="button">o guardar para comprar mas tarde</a>
    </div>

    <script>
        let list_cart = document.getElementById('list-cart')
        let stock_cart = document.getElementById('stock-cart')
        let total_mount = document.getElementById('total-mount')
        list_cart.onchange = e => {
            if (e.target.name === 'stock') {
                if (e.target.value < 1) e.target.value = 1;
                let cant = Number(e.target.value);
                let p = e.target.parentElement.parentElement;
                let precio = e.target.dataset.price;
                p.children[4].innerHTML = `S/.${cant*precio}`;
                let data = new FormData()
                data.append('quantity', cant)
                data.append('redirect', false)
                fetch('/tienda_e5/controllers/add_cart/' + e.target.dataset.id, {
                        method: 'POST',
                        body: data,
                    })
                    .then(response => response.json())
                    .then(data => {
                        stock_cart.innerHTML = data.stock;
                        total_mount.innerHTML = 'S/. ' + data.total;
                    })
            }
        }
    </script>
<?php
} else {
    echo 'Aun no has agregado productos al carrito';
}
?>

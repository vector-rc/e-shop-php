<table class="table table-striped table-bordered" id="list-cart">
<thead>
    <tr>
      <th scope="col">Fecha y hora</th>
      <th scope="col">Subtotal</th>
      <th scope="col">Descuento</th>
      <th scope="col">Total</th>
      <th scope="col"></th>
    </tr>
  </thead>
    <tbody>
        <?php

        use E5\Order\OrderRepository;

        $_or = new OrderRepository();
        $orders = $_or->findByUserId($_SESSION['user']['id']);

        foreach ($orders as $order) {
        ?>
            <tr>
                <th scope="row"><?= $order['date_time'] ?></th>
                <td>S/ <?= $order['subtotal'] ?></td>
                <td>S/ <?= $order['discount'] ?></td>
                <td>S/ <?= $order['total'] ?></td>
                <!-- <td><?= $order['state'] ?></td> -->
                <td>
                    <?php 
                    if($order['state']=='not_payed'){
                     ?>
                    <a class="btn btn-success" href="/tienda_e5/pay_details/<?= $order['id'] ?>">Comprar</a>
                    <a class="btn btn-danger" href="/tienda_e5/controllers/delete_order/<?= $order['id'] ?>">Quitar</a>
                    <?php 
                    }
                     ?>
                    <a class="btn btn-dark" href="/tienda_e5/order/<?= $order['id'] ?>">Ver detalles</a>
                </td>
            </tr>

        <?php
        }

        ?>
    </tbody>
</table>

<?php

if (isset($_SESSION['session_id']) && ($_SESSION['user']['id'] == $product['user_id'])) {
?>
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Eliminar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>
                <div class="modal-body">
                    ¿Esta seguro de eliminar el producto <?= $product['name'] ?>?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="btn_close" data-bs-dismiss="modal">Cancelar</button>
                    <a href="/tienda_e5/controllers/delete_product/<?= $product['id'] ?>" class="btn btn-danger btn-add-car">Eliminar <i class="bi bi-trash"></i></a>
                </div>
            </div>
        </div>
    </div>

<?php
}
?>

<div class="container row" style="background: #eee;">
    <img class="col-6 mx-1" src="/tienda_e5/images_products/<?= $product['image'] ?>" alt="">

    <div class="col-5">
        <h3 class="card-title"><?= $product['name'] ?></h3>
        <h4 class="card-title">S/. <?= $product['price'] ?></h4>
        <pre style=" white-space: pre-wrap;font-family: verdana;" class="card-text"><?= $product['description'] ?></pre>


        <?php
        if (isset($_SESSION['session_id']) && !($_SESSION['user']['id'] == $product['user_id']) && !in_array('id' . $product['id'], array_keys($_SESSION['cart']))) {
        ?>
            <form class="d-flex" action="/tienda_e5/controllers/add_cart/<?= $product['id'] ?>" method="POST">
                <input class=" me-2" type="number" name="quantity" value="1" id="quantity">
                <button class="btn btn-success">Agregar <i class="bi bi-cart-plus"></i></button>
            </form>
        <?php
        }
        if (isset($_SESSION['session_id']) && ($_SESSION['user']['id'] == $product['user_id'])) {
        ?>
            <a href="/tienda_e5/edit_product/<?= $product['id'] ?>" class="btn btn-success btn-add-car">Editar <i class="bi bi-pencil"></i></a>
            <button type="button" data-action="delete" data-bs-toggle="modal" data-bs-target="#deleteModal" class="btn btn-danger btn-add-car">Eliminar <i class="bi bi-trash"></i></button>

        <?php
        }
        ?>
    </div>
</div>

<script>
    let field_quantity = document.getElementById('quantity')    
    field_quantity.onchange = e => {
        if (e.target.value < 1) e.target.value = 1;
    }
</script>

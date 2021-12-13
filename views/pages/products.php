<?php
if (isset($_GET['page']) && $_GET['page'] == 'my_products' && isset($_SESSION['session_id'])) {
?>
    <a class="btn btn-primary" href="/tienda_e5/add_product">Agregar nuevo producto</a>

<?php
}
?>


<div class="row">
    <?php foreach ($products as $product) { ?>

        <div class="card m-3 p-2 prod" style="width: 18rem;border-radius:6px;">
            <a href="/tienda_e5/product/<?php echo $product['id'] ?>">
                <img src="/tienda_e5/images_products/<?= $product['image'] ?>" class="card-img-top" alt="img_prod" style="height: 18rem ;object-fit: cover;">
                <hr>
                <div class="card-body">

                    <h6 class="card-subtitle"> <?php echo $product['name']; ?> </h5>
                        <h5 class="card-subtitle mt-2"> <?php echo "S/." . $product['price']; ?>
                    </h6>
                </div>
            </a>
        </div>

    <?php } ?>
    <style>
        .prod {
            transition: all;
            transition-duration: 0.3s;
        }

        .prod:hover {
            box-shadow: 0px 0px 10px #878787;
        }
    </style>
</div>

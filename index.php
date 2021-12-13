<?php
session_start();
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}
include_once 'vendor/autoload.php';

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/tienda_e5/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="/tienda_e5/bootstrap/bootstrap-icons.css">

    <title>E5 Shop</title>
</head>

<body>
    <script src="/tienda_e5/bootstrap/bootstrap.bundle.min.js"></script>

    <main class="container-fluid m-0 p-0 d-flex flex-column">

        <?php

        use E5\Product\ProductRepository;
        use E5\Shared\Router;
        use E5\User\UserRepository;
        use E5\Order\OrderRepository;

        include_once 'views/components/header.php';
        ?>

        <div class="d-flex flex-column align-items-center" style="width:100%;min-height: 80vh;background: #ededed;">

            <div class="container p-3" style="height:98%;border-radius:1.5rem">

                <?php
                if (isset($_GET['page'])) {

                    $router = new Router($_GET['page']);
                    $router->add('/product/:id', function ($id) {
                        $_pr = new ProductRepository();
                        $product = $_pr->findById($id);
                        if ($product) {
                            include_once 'views/pages/ProductDetails.php';
                        } else {
                            include 'views/pages/404.php';
                        }
                    });
                    $router->add('/login', function () {
                        if (isset($_SESSION['session_id'])) {
                            echo 'ya iniciaste session';
                            return;
                        }
                        include_once 'views/pages/Login.php';
                    });
                    $router->add('/signup', function () {
                        if (isset($_SESSION['session_id'])) {
                            echo 'cierra la session para registrar una cuenta nueva';
                            return;
                        }
                        include_once 'views/pages/Signup.php';
                    });
                    $router->add('/products/search/:query', function ($query) {
                        $_product_repository = new ProductRepository();
                        $products = $_product_repository->search($query);
                        include_once 'views/pages/products.php';
                    });
                    $router->add('/products/category/:id', function ($id) {
                        $_product_repository = new ProductRepository();
                        $products = $_product_repository->findByCategoryId($id);
                        include_once 'views/pages/products.php';
                    });
                    $router->add('/my_products', function () {
                        if (!isset($_SESSION['user'])) {
                            include_once 'views/pages/Login.php';
                            return;
                        }
                        $_product_repository = new ProductRepository();
                        $products = $_product_repository->findByUserId($_SESSION['user']['id']);
                        include_once 'views/pages/products.php';
                    });
                    $router->add('/edit_product/:id', function ($id) {
                        if (!isset($_SESSION['user'])) {
                            include_once 'views/pages/Login.php';
                            return;
                        }
                        $_product_repository = new ProductRepository();
                        $product = $_product_repository->findById($id);
                        if ($product && $product['user_id'] == $_SESSION['user']['id']) {
                            include_once 'views/pages/EditProduct.php';
                            return;
                        }
                        include 'views/pages/404.php';
                    });
                    $router->add('/add_product', function () {
                        if (!isset($_SESSION['user'])) {
                            include_once 'views/pages/Login.php';
                            return;
                        }
                        include_once 'views/pages/AddProduct.php';
                        return;
                    });
                    $router->add('/cart', function () {
                        if (!isset($_SESSION['user'])) {
                            include_once 'views/pages/Login.php';
                            return;
                        }
                        include 'views/pages/cart.php';
                    });
                    $router->add('/profile', function () {
                        if (!isset($_SESSION['user'])) {
                            include_once 'views/pages/Login.php';
                            return;
                        }
                        $ur = new UserRepository();
                        $user = $ur->findById($_SESSION['user']['id']);
                        include 'views/pages/UserProfile.php';
                    });
                    $router->add('/edit_profile', function () {
                        if (!isset($_SESSION['user'])) {
                            include_once 'views/pages/Login.php';
                            return;
                        }
                        $ur = new UserRepository();
                        $user = $ur->findById($_SESSION['user']['id']);
                        include 'views/pages/EditProfile.php';
                    });
                    $router->add('/pay_details/:order_id', function ($order_id) {

                        $_or = new OrderRepository();
                        $order = $_or->findById($order_id);
                        if (!isset($_SESSION['user'])) {
                            include_once 'views/pages/Login.php';
                            return;
                        }
                        include 'views/pages/PayDetails.php';
                    });
                    $router->add('/pay/:order_id/:type_pay', function ($order_id, $type_pay) {

                        $_or = new OrderRepository();
                        $order = $_or->findById($order_id);
                        if (!isset($_SESSION['user'])) {
                            include_once 'views/pages/Login.php';
                            return;
                        }
                        include 'views/pages/pay.php';
                    });
                    $router->add('/my_orders', function () {
                        if (!isset($_SESSION['user'])) {
                            include_once 'views/pages/Login.php';
                            return;
                        }
                        include 'views/pages/orders.php';
                    });
                    $router->add('/order/:id', function ($id) {
                        if (!isset($_SESSION['user'])) {
                            include_once 'views/pages/Login.php';
                            return;
                        }
                        include 'views/pages/OrderDetails.php';
                    });
                } else {
                    $_product_repository = new ProductRepository();
                    $products = $_product_repository->findLast();
                    include_once 'views/pages/products.php';
                }
                ?>

            </div>


        </div>
        <?php
        include_once 'views/components/footer.php';
        ?>
    </main>
</body>

</html>

<?php
include_once '../vendor/autoload.php';

use E5\Order\Order;
use E5\Order\OrderRepository;
use E5\OrderedProduct\OrderedProduct;
use E5\OrderedProduct\OrderedProductRepository;
use E5\Product\Product;
use E5\Product\ProductRepository;
use E5\Shared\Router;

use E5\User\AuthenticateUser;
use E5\Session\SessionCreator;
use E5\User\User;
use E5\User\UserRepository;

session_start();

$router = new Router($_GET['controller']);


$router->add('/login', function () {
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $authenticate_user = new AuthenticateUser($_POST['email'], $_POST['password']);
        $user = $authenticate_user();
        if ($user) {
            $session_creator = new SessionCreator($user);
            $_SESSION['session_id'] = $session_creator()['id'];
            $_SESSION['user'] = (array) $user;
            header('location:/tienda_e5/');
        } else {
            header('location:/tienda_e5/login');
        }
    }
});


$router->add('/signup', function () {
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $_image_name = '';
        if (isset($_FILES['image']) && $_FILES['image']['size'] > 0) {
            $file_extension = explode('/', $_FILES["image"]["type"])[1];
            if (strpos('jpeg,jpg,png,webp', $file_extension) !== false) {
                $tmp_name = $_FILES["image"]["tmp_name"];
                $_image_name =  preg_replace('/[0-9:\\\*?"<>\/|\-ÁÀÂÄáàäâªÉÈÊËéèëêÍÌÏÎíìïîÓÒÖÔóòöôÚÙÛÜúùüûÑñÇç ]/', '',  $_POST['names']) . time();
                $_image_name = basename("$_image_name.$file_extension");
                move_uploaded_file($tmp_name, "../images_users/$_image_name");
            }
        }
        $user_repository = new UserRepository();
        $user = new User(
            null,
            $_POST['names'],
            $_POST['surnames'],
            $_POST['email'],
            $_POST['password'],
            $_POST['address'],
            $_POST['mobile'],
            $_image_name,
            1
        );
        $user->id = $user_repository->save($user)['id'];

        if ($user->id) {
            $session_creator = new SessionCreator($user);
            $_SESSION['session_id'] = $session_creator()['id'];
            $_SESSION['user'] = (array)$user;
        }
    }
    header('location:/tienda_e5/');
});
$router->add('/edit_profile', function () {
    if (!isset($_SESSION['session_id'])) return;
    if (isset($_POST['email'])) {
        $user_repository = new UserRepository();

        $_image_name = '';
        if (isset($_FILES['image']) && $_FILES['image']['size'] > 0) {
            $file_extension = explode('/', $_FILES["image"]["type"])[1];
            if (strpos('jpeg,jpg,png,webp', $file_extension) !== false) {
                $tmp_name = $_FILES["image"]["tmp_name"];
                $_image_name =preg_replace('/[0-9:\\\*?"<>\/|\-ÁÀÂÄáàäâªÉÈÊËéèëêÍÌÏÎíìïîÓÒÖÔóòöôÚÙÛÜúùüûÑñÇç ]/', '',  $_POST['names']) . time();
                $_image_name = basename("$_image_name.$file_extension");
                move_uploaded_file($tmp_name, "../images_users/$_image_name");
            }
        } else {
            $_image_name =  $user_repository->findById($_SESSION['user']['id'])['image'];
        }
        $user = new User(
            $_SESSION['user']['id'],
            $_POST['names'],
            $_POST['surnames'],
            $_POST['email'],
            $_POST['password'],
            $_POST['address'],
            $_POST['mobile'],
            $_image_name,
            1
        );
        $user = $user_repository->edit($user);
        if ($user) {
            $_SESSION['user'] = $user;
        }
    }
    header('location:/tienda_e5/profile');
});

$router->add('/edit_product/:id', function ($id) {
    if (!isset($_SESSION['session_id'])) return;
    if (
        isset($_POST['name']) &&
        isset($_POST['price']) &&
        isset($_POST['state']) &&
        isset($_POST['description']) &&
        isset($_POST['stock']) &&
        isset($_POST['category_id'])
    ) {
        $product_repository = new ProductRepository();
        if (isset($_FILES['image']) && $_FILES['image']['size'] > 0) {
            $file_extension = explode('/', $_FILES["image"]["type"])[1];
            if (strpos('jpeg,jpg,png,webp', $file_extension) !== false) {
                $tmp_name = $_FILES["image"]["tmp_name"];
                $_image_name = preg_replace('/[0-9:\\\*?"<>\/|\-ÁÀÂÄáàäâªÉÈÊËéèëêÍÌÏÎíìïîÓÒÖÔóòöôÚÙÛÜúùüûÑñÇç ]/', '', $_POST['name']) . time();
                $_image_name = basename("$_image_name.$file_extension");
                move_uploaded_file($tmp_name, "../images_products/$_image_name");
            }
        } else {
            $_image_name = $product_repository->findById($id)['image'];
        }

        $product = new Product(
            $id,
            $_POST['name'],
            $_POST['price'],
            $_POST['state'],
            $_POST['description'],
            $_POST['stock'],
            $_SESSION['user']['id'],
            $_POST['category_id'],
            $_image_name,
            1
        );

        $product_repository->edit($product);
        header('location:/tienda_e5/my_products');
    }
});
$router->add('/add_product', function () {
    if (!isset($_SESSION['session_id'])) return;
    if (
        isset($_POST['name']) &&
        isset($_POST['price']) &&
        isset($_POST['state']) &&
        isset($_POST['description']) &&
        isset($_POST['stock']) &&
        isset($_POST['category_id'])
    ) {
        $_image_name = '';
        if (isset($_FILES['image']) && $_FILES['image']['size'] > 0) {
            $file_extension = explode('/', $_FILES["image"]["type"])[1];
            if (strpos('jpeg,jpg,png,webp', $file_extension) !== false) {
                $tmp_name = $_FILES["image"]["tmp_name"];
                $_image_name = preg_replace('/[0-9:\\\*?"<>\/|\-ÁÀÂÄáàäâªÉÈÊËéèëêÍÌÏÎíìïîÓÒÖÔóòöôÚÙÛÜúùüûÑñÇç ]/', '',  $_POST['name']) . time();
                $_image_name = basename("$_image_name.$file_extension");
                move_uploaded_file($tmp_name, "../images_products/$_image_name");
            }
        }

        $product_repository = new ProductRepository();
        $product = new Product(
            null,
            $_POST['name'],
            $_POST['price'],
            $_POST['state'],
            $_POST['description'],
            $_POST['stock'],
            $_SESSION['user']['id'],
            $_POST['category_id'],
            $_image_name,
            1
        );

        $product_repository->save($product);
        header('location:/tienda_e5/my_products');
    }
});
$router->add('/delete_product/:id', function ($id) {
    if (!isset($_SESSION['session_id'])) return;
    $pr = new ProductRepository();
    $product = $pr->findById($id);
    if ($_SESSION['user']['id'] != $product['user_id']) return;

    $pr->delete($id);
    header('location:/tienda_e5/my_products');
});


$router->add('/add_cart/:id', function ($id) {

    if (isset($_POST['quantity'])) {
        $_SESSION['cart'][$id] = $_POST['quantity'];
        $stock_cart = 0;
        $total = 0;
        $_pr = new ProductRepository();
        foreach ($_SESSION['cart'] as $prod_id => $stock) {
            $stock_cart += $stock;
            $product = $_pr->findById($prod_id);
            $total += $product['price'] * $stock;
        }


        if (isset($_POST['redirect'])) {
            print(json_encode(['stock' => $stock_cart, 'total' => $total]));
            return;
        }

        header('location:' . $_SERVER['HTTP_REFERER']);
    }
});
$router->add('/quit_cart/:id', function ($id) {
    unset($_SESSION['cart'][$id]);
    header('location:/tienda_e5/cart');
});

$router->add('/singout', function () {
    session_destroy();
    header('location:/tienda_e5');
});

$router->add('/new_order', function () {
    if (!isset($_SESSION['session_id'])) return;
    if (count($_SESSION['cart']) != 0) {
        $_or = new OrderRepository();
        $subtotal = 0;
        $_pr = new ProductRepository();
        $_opr = new OrderedProductRepository();
        foreach ($_SESSION['cart'] as $prod_id => $stock) {
            $product = $_pr->findById($prod_id);
            $subtotal += $product['price'] * $stock;
        }

        $order = new Order(null, $_SESSION['user']['id'], date('Y-m-d h:i:s'), 0.0, $subtotal, $subtotal, 'not_payed', 1);
        $order = $_or->save($order);

        foreach ($_SESSION['cart'] as $prod_id => $stock) {
            $_opr->save(new OrderedProduct(null, $prod_id, $order['id'], $stock, 1));
        }
        $_SESSION['cart'] = [];
    }
    header('location:/tienda_e5/my_orders');
});

$router->add('/delete_order/:id', function ($id) {
    if (!isset($_SESSION['session_id'])) return;

    $_or = new OrderRepository();
    $_or->delete($id);

    header('location:/tienda_e5/my_orders');
});

$router->add('/sale', function () {
    if (!isset($_SESSION['session_id'])) return;
    if (count($_SESSION['cart']) != 0) {
        $_or = new OrderRepository();
        $subtotal = 0;
        $_pr = new ProductRepository();
        $_opr = new OrderedProductRepository();
        foreach ($_SESSION['cart'] as $prod_id => $stock) {
            $product = $_pr->findById($prod_id);
            $subtotal += $product['price'] * $stock;
        }

        $order = new Order(null, $_SESSION['user']['id'], date('Y-m-d h:i:s'), 0, $subtotal, $subtotal, 'not_payed', 1);
        $order = $_or->save($order);

        foreach ($_SESSION['cart'] as $prod_id => $stock) {
            $_opr->save(new OrderedProduct(null, $prod_id, $order['id'], $stock, 1));
        }
        $_SESSION['cart'] = [];
        header('location:/tienda_e5/pay_details/' . $order['id']);
    }
});
$router->add('/pay/:order_id', function ($order_id) {
    if (!isset($_SESSION['session_id'])) return;
    $_or = new OrderRepository();
    $order = $_or->findById($order_id);
    $order['state'] = 'paid_out';
    $order = $_or->edit($order);
    header('location:/tienda_e5/my_orders');
});





//

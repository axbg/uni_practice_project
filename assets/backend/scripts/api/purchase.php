<?php

session_start();
require_once "../PDOconnection.php";
require_once "../class/Product.php";
require_once "../class/Cart.php";
require_once "../class/Order.php";

if ($_SESSION['id'] && $_SESSION['token'] && $_SESSION['email']) {

    $cart = new Cart($_SESSION['id']);
    $order = new Order($_SESSION['id']);

    $products = $cart->queryUserCartDuplicates($con);

    foreach ($products as $product) {
        $order->insertOrder($con, $product->getProductId());
        $cart->deleteOne($con, $product->getProductId());
    }

    header("HTTP/1.1 200 OK");
    return;

} else {
    header("HTTP/1.1 400 Bad Request");
    return;
}

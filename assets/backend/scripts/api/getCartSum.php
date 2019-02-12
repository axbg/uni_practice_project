<?php

session_start();

if ($_SESSION['email']) {

    require_once "../PDOconnection.php";
    require_once "../class/Cart.php";
    require_once "../class/Product.php";

    $cart = new Cart($_SESSION['id']);

    $products = $cart->queryUserCartDuplicates($con);

    $sum = 0;

    foreach ($products as $product) {
        $sum += $product->getPrice();
    }

    header("HTTP/1.1 200 OK");
    $message['total'] = $sum;
    echo JSON_ENCODE($message);
    return;

} else {
    header("HTTP/1.1 403 Forbidden");
    return;
}

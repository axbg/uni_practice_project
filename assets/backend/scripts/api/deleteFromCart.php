<?php

session_start();
require_once "../PDOconnection.php";
require_once "../class/Product.php";
require_once "../class/Cart.php";

if (isset($_SESSION['token'])) {

    $currentCart = new Cart($_SESSION['id']);

    $currentCart->delete($con, $_POST['productId']);

    header("HTTP/1.1 200 OK");
    return;

} else {
    header("HTTP/1.1 403 Forbidden");
    $error['message'] = "Forbidden";
    echo JSON_ENCODE($error);
    return;
}

<?php

    session_start();
    require_once("../PDOconnection.php");
    require_once("../class/Product.php");
    require_once("../class/Cart.php");

    if(isset($_SESSION['token'])){

        $currentCart = new Cart($_SESSION['id']);

        $cartProducts = $currentCart->queryUserCart($con);

        $quantities = $currentCart->queryUserQuantities($con);

        $response[0] = $cartProducts;
        $response[1] = $quantities;

        header("HTTP/1.1 200 OK");
        echo JSON_ENCODE($response);
        return;

    } else {
        header("HTTP/1.1 403 Forbidden");
        $error['message'] = "Forbidden";
        echo JSON_ENCODE($error);
        return;
    }

?>
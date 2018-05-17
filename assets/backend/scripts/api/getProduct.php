<?php

    session_start();
    require_once("../PDOconnection.php");
    require_once("../class/Product.php");

    $productId = $_GET['productId'];

    $product = Product::getProduct($con,$productId);

    if($product){
        header("HTTP/1.1 200 OK");
        echo JSON_ENCODE($product);
        return;
    } else {
        header("HTTP/1.1 404 Not Found");
        return;
    }

    ?>
<?php

    session_start();
    require_once("../PDOconnection.php");
    require_once("../class/Product.php");

    if(isset($_SESSION['token'])){

        $products = Product::getAllProducts($con);

        header("HTTP/1.1 200 OK");
        echo JSON_ENCODE($products);
        return;

    } else {
        header("HTTP/1.1 403 Forbidden");
        $error['message'] = "Forbidden";
        echo JSON_ENCODE($error);
        return;
    }

?>
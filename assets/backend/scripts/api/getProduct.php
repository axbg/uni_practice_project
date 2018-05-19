<?php

    session_start();
    require_once("../PDOconnection.php");
    require_once("../class/Product.php");
    require_once("../class/Brand.php");

    $productId = $_GET['productId'];

    $product = Product::getProduct($con,$productId);

    $brand = Brand::queryIdToName($con,$product->getBrandId());

    if($product){
        header("HTTP/1.1 200 OK");
        $content['product'] = $product;
        $content['brand'] = $brand;
        echo JSON_ENCODE($content);
        return;
    } else {
        header("HTTP/1.1 404 Not Found");
        return;
    }

    ?>
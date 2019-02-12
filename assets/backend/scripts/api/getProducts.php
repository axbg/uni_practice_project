<?php

session_start();
require_once "../PDOconnection.php";
require_once "../class/Product.php";

$products = Product::getAllProducts($con);

header("HTTP/1.1 200 OK");
echo JSON_ENCODE($products);
return;

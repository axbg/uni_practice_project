<?php

require_once "../PDOconnection.php";
require_once "../class/Product.php";

$products = Product::searchProduct($con, $_GET['name']);

header("HTTP/1.1 200 OK");
echo JSON_ENCODE($products);
return;

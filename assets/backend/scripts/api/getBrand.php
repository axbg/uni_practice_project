<?php

require_once "../PDOconnection.php";
require_once "../class/Product.php";

$brand = Product::getBrand($con, $_GET['brandId']);

header("HTTP/1.1 200 OK");
echo JSON_ENCODE($brand);
return;

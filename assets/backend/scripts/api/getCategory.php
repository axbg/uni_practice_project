<?php

require_once "../PDOconnection.php";
require_once "../class/Product.php";

$category = Product::getCategory($con, $_GET['categoryId']);

header("HTTP/1.1 200 OK");
echo JSON_ENCODE($category);
return;

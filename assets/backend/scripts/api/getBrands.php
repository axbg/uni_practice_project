<?php

    require_once("../PDOconnection.php");
    require_once("../class/Brand.php");

    $brands = Brand::queryAllBrands($con);

    header("HTTP/1.1 200 OK");
    echo JSON_ENCODE($brands);
    return;

?>
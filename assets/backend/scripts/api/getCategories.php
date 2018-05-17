<?php

    require_once("../PDOconnection.php");
    require_once("../class/Category.php");

    $categories = Category::queryAllCategories($con);

    header("HTTP/1.1 200 OK");
    echo JSON_ENCODE($categories);
    return;

    ?>
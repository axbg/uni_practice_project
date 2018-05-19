<?php

    session_start();
    require_once("../PDOconnection.php");
    require_once("../class/Brand.php");
    require_once("../class/Category.php");
    require_once("../config.php");

    if($_SESSION['isAdmin']){

        $categories = Category::queryCategoriesNames($con);
        $brands = Brand::queryBrandsNames($con);

        header("HTTP/1.1 200 OK");
        $content['categories'] = $categories;
        $content['brands'] = $brands;
        echo JSON_ENCODE($content);
        return;

    } else {
        header("HTTP/1.1 403 Forbidden");
        return;
    }

?>
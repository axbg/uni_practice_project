<?php

session_start();
require_once "../PDOconnection.php";
require_once "../class/Product.php";
require_once "../class/Brand.php";
require_once "../class/Category.php";

if ($_SESSION['isAdmin']) {

    /*echo var_dump($_POST);
    return;
     */
    if (isset($_POST['name']) && isset($_POST['description']) && isset($_FILES['image']['name'])
        && isset($_POST['brandName']) && isset($_POST['categoryName']) && isset($_POST['stock'])
        && isset($_POST['price'])) {

        if ($_FILES['image']['type'] == 'image/png') {

            $imgURI = IMAGES . "products/" . $_POST['name'] . ".png";

            move_uploaded_file($_FILES['image']['tmp_name'], $imgURI);

            $imgURI = "assets/img/products/" . $_POST['name'] . ".png";

            $categoryId = Category::queryNameToId($con, $_POST['categoryName']);
            $brandId = Brand::queryNameToId($con, $_POST['brandName']);

            $newProduct = new Product(0, $_POST['name'], $_POST['description'], $_POST['stock'],
                $_POST['price'], $imgURI, $categoryId, $brandId);

            $newProduct->save($con);

        } else {
            header("HTTP.1.1 406 Not Acceptable");
            $error['message'] = "Only .png accepted";
            echo JSON_ENCODE($error);
            return;
        }

    } else {
        header("HTTP/1.1 400 Bad Request");
        return;
    }

} else {

    header("HTTP/1.1 403 Forbidden");
    return;
}

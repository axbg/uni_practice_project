<?php

session_start();
require_once "../PDOconnection.php";
require_once "../class/Category.php";

if ($_SESSION['isAdmin']) {

    if (isset($_POST['name']) && isset($_POST['description']) && isset($_FILES['image']['name'])) {

        if ($_FILES['image']['type'] == 'image/png') {

            $imgURI = IMAGES . "categories\\" . $_POST['name'] . ".png";

            move_uploaded_file($_FILES['image']['tmp_name'], $imgURI);

            $imgURI = "assets/img/categories/" . $_POST['name'] . ".png";

            $newCategory = new Category(0, $_POST['name'], $_POST['description'], $imgURI);

            $newCategory->save($con);

            header("HTTP.1.1 201 Created");
            return;

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

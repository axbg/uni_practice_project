<?php

    session_start();
    require_once("../PDOconnection.php");
    require_once("../class/Product.php");
    require_once("../class/Cart.php");

    if(isset($_SESSION['token']) && isset($_POST['productId'])){

        $currentCart = new Cart($_SESSION['id']);

        try {
            $currentCart->insert($con, $_POST['productId']);
        }
        catch(Exception $ex) {
            header("HTTP/1.1 400 Bad Request");
            $error['message'] = $ex->getMessage();
            echo JSON_ENCODE($error);
            return;
        }

        echo $_SESSION['id'];
        header("HTTP/1.1 200 OK");
        return;

    } else {
        header("HTTP/1.1 403 Forbidden");
        $error['message'] = "Forbidden";
        echo JSON_ENCODE($error);
        return;
    }

?>
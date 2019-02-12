<?php

session_start();
if ($_SESSION['isAdmin']) {

    require_once "../PDOconnection.php";
    require_once "../class/Order.php";

    if (isset($_POST['date']) && isset($_POST['user'])) {

        $order = new Order(0);

        $order->edit($_POST['user'], $_POST['date']);

        $order->confirmOrder($con);

        header("HTTP/1.1 200 OK");
        return;

    } else {
        header("HTTP/1.1 400 Bad Request");
        return;
    }

} else {

    header("HTTP/1.1 403 Forbidden");
    return;
}

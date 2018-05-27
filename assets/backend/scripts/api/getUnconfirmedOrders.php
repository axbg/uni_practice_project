<?php

    session_start();
    if($_SESSION['isAdmin']){

        require_once("../PDOconnection.php");
        require_once ("../class/Order.php");

        $orders = Order::getUnconfirmedOrders($con);

        header("HTTP/1.1 200 OK");
        echo JSON_ENCODE($orders);
        return;

    } else{
        header("HTTP/1.1 403 Forbidden");
        return;
    }


?>
<?php

    session_start();
    require_once("../PDOconnection.php");
    require_once("../class/User.php");

    if($_SESSION['email']){

        $user = new User;

        $user->populate($con,$_SESSION['email'],$_SESSION['token']);

        try {
            $user->edit($con,$_POST['firstName'],$_POST['lastName'],$_POST['email'],$_POST['phone'],$_POST['address']);
            header("HTTP/1.1 200 OK");
            return;
        }
        catch(Exception $e){
            header("HTTP/1.1 400 Bad Request");
            echo JSON_ENCODE($e->getMessage());
            return;
        }

    } else {
        header("HTTP/1.1 403 Forbidden");
        return;
    }


?>
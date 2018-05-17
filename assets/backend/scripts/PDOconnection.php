<?php

    require_once("dbconfig.php");

    try {
        $con = new pdo('mysql:host=' . HOST . ';dbname=' . DATABASE .
            ';charset=utf8;', USER, PASSWORD);
    }
    catch(Exception $ex){
        header("HTTP/1.1 500 Server Error");
        echo 'Server Error. Please try again';
        return;
    }

?>
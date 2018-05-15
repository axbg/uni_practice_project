<?php

    require_once("dbconfig.php");

    if(!isset($_SESSION['email'])){

        if(isset($_POST['password']) && isset($_POST['email'])){
            $password = md5($_POST['password']);
            $email = $_POST['email'];

            try {
                $con = new pdo('mysql:host=' . HOST . ';dbname=' . DATABASE .
                    ';charset=utf8;', USER, PASSWORD);
            }
            catch(Exception $ex){
                header("HTTP/1.1 500 Server Error");
                echo 'Server Error. Please try again';
                return;
            }

            $search_user = $con->prepare("SELECT * FROM users WHERE password=:password AND email=:email");
            $search_user->bindParam(":password",$password);
            $search_user->bindParam(":email",$email);
            if($search_user->execute()){

                if($search_user->RowCount()){

                    $result = $search_user->fetch(PDO::FETCH_ASSOC);

                    session_start();
                    $_SESSION['name'] = $result['firstName'] . ' ' . $result['lastName'];
                    $_SESSION['email'] = $result['email'];
                    $_SESSION['isAdmin'] = $result['isAdmin'];

                    header("HTTP/1.1 200 OK");
                    $error['message'] = 'You were logged in';
                    echo JSON_ENCODE($error);
                    return;

                } else {
                    header("HTTP/1.1 404 Not Found");
                    $error['message'] = 'Password and email don\'t match';
                    echo JSON_ENCODE($error);
                    return;
                }

            } else{
                header("HTTP/1.1 500 Server Error");
                $error['message'] = "Database error";
                echo JSON_ENCODE($error);
                return;
            }

        } else{
            header("HTTP/1.1 400 Bad Request");
            $error['message'] = 'Bad Request. Email or password missing';
            echo JSON_ENCODE($error);
            return;
        }

    } else {
        header("HTTP/1.1 202 Accepted");
        $error['message'] = 'Already logged in';
        echo JSON_ENCODE($error);
        return;
    }

?>
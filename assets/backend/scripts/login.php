<?php
//transform into oop

require_once("PDOconnection.php");
require_once("class/User.php");

session_start();


if(!isset($_SESSION['email'])){

    if(isset($_POST['password']) && isset($_POST['email'])){
        $password = md5($_POST['password']);
        $email = $_POST['email'];

        $currentUser = new User();

        $currentUser->populate($con,$email,$currentUser->getCredentials($con,$email,$password));

        if($currentUser->getUserId()){

                $_SESSION['name'] = $currentUser->getFirstName() . ' ' . $currentUser->getLastName();
                $_SESSION['email'] = $currentUser->getEmail();
                $_SESSION['id'] = $currentUser->getUserId();
                $_SESSION['token'] = $currentUser->getToken();
                $_SESSION['isAdmin'] = $currentUser->getisAdmin();

                header("HTTP/1.1 200 OK");
                $error['message'] = $currentUser->getToken();
                echo JSON_ENCODE($error);
                return;

            } else {
                header("HTTP/1.1 404 Not Found");
                $error['message'] = $currentUser->getUserId();
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
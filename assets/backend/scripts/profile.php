<?php
session_start();

require_once "class/User.php";

if (isset($_SESSION['token'])) {

    require_once "PDOconnection.php";
    $currentUser = new User();

    try {
        $currentUser->populate($con, $_SESSION['email'], $_SESSION['token']);
    } catch (Exception $ex) {
        header("HTTP/1.1 400 Bad Request");
        $error['meesage'] = "User was not found";
        echo JSON_ENCODE($error);
        return;
    }

    $data['firstName'] = $currentUser->getFirstName();
    $data['lastName'] = $currentUser->getLastName();
    $data['email'] = $currentUser->getEmail();
    $data['address'] = $currentUser->getAddress();
    $data['phone'] = $currentUser->getPhone();

    header("HTTP/1.1 200 OK");
    echo JSON_ENCODE($data);
    return;

} else {
    header("HTTP/1.1 403 Forbidden");
    return;
}

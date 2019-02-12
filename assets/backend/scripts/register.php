<?php

require_once "PDOconnection.php";
require_once "class/User.php";

$validData = 1;
$errors = array();

if (isset($_POST['firstName'])) {
    $firstName = $_POST['firstName'];
} else {
    $validData = 0;
    $errors['message'] = "First Name field is empty";
}

if (isset($_POST['lastName'])) {
    $lastName = $_POST['lastName'];
} else {
    $validData = 0;
    $errors['message'] = "last Name field is empty";
}

if (isset($_POST['phone'])) {
    $phone = $_POST['phone'];
} else {
    $validData = 0;
    $errors['message'] = "Phone field is empty";
}

if (isset($_POST['email'])) {
    $email = $_POST['email'];
} else {
    $validData = 0;
    $errors['message'] = "Email field is empty";
}

if (isset($_POST['password'])) {
    $password = $_POST['password'];
} else {
    $validData = 0;
    $errors['message'] = "Password field is empty";
}

if (isset($_POST['address'])) {
    $address = $_POST['address'];
} else {
    $validData = 0;
    $errors['message'] = "Address field is empty";
}

if ($validData) {

    $newUser = new User();

    $newUser->add($firstName, $lastName, $password, $email, $phone, $address);

    try {
        $newUser->saveNew($con);
        header("HTTP/1.1 201 Created");
        $errors['message'] = "Registered!";
        echo JSON_ENCODE($errors);
        return;
    } catch (Exception $ex) {
        header("HTTP/1.1 400 Bad Request");
        $errors['message'] = $ex->getMessage();
        echo JSON_ENCODE($errors);
        return;
    }

} else {
    header("HTTP/1.1 400 Bad Request");
    echo JSON_ENCODE($errors);
    return;
}

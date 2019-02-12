<?php

session_start();

if (isset($_SESSION['email'])) {
    header("HTTP/1.1 200 OK");
    return;
} else {
    header("HTTP/1.1 203 Non-Authoritative Information");
    return;
}

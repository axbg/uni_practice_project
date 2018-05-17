<?php

    session_start();
    $_SESSION = [];
    session_destroy();

    header("HTTP/1.1 200 OK");
    echo "You were logout";
    return;

?>
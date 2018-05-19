<?php

    session_start();
    require_once("../PDOconnection.php");
    require_once("../class/Brand.php");
    require_once("../config.php");

    if($_SESSION['isAdmin']){

        if(isset($_POST['name']) && isset($_POST['originCountry']) && isset($_FILES['image']['name'])){

            if($_FILES['image']['type'] == 'image/png'){

                $imgURI = IMAGES . "brands/" . $_POST['name'] . ".png";

                move_uploaded_file($_FILES['image']['tmp_name'],$imgURI);

                $imgURI = "assets/img/brands/" . $_POST['name'] . ".png";

                $newBrand = new Brand(0, $_POST['name'],$_POST['originCountry'],$imgURI);

                $newBrand->save($con);

            } else {
                header("HTTP.1.1 406 Not Acceptable");
                $error['message'] = "Only .png accepted";
                echo JSON_ENCODE($error);
                return;
            }

        } else{
            header("HTTP/1.1 400 Bad Request");
            return;
        }

    } else {
        header("HTTP/1.1 403 Forbidden");
        return;
    }

?>
<?php
    $server = "localhost";
    $user = "root";
    $dbName = "socio";
    $pass = "";
    $link = mysqli_connect($server, $user, $pass, $dbName);
    if(!$link) {
        die("Error connecting database");
    }
?>
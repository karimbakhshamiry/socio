<?php
    include('controllers/core_functions.php');
    echo sha1($_SESSION['user']['username'].'jelly-fish');
    echo sha1($_SESSION['user']['username']);
    // echo $_SESSION['user']['username'];
?>
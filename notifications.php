<?php
    include_once('controllers/core_functions.php');
    if (!isLoggedIn()) {
        header('location: login.php');
    };

    $notificationData = getNotificationData()
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <meta http-equiv="refresh" content="1"> -->
    <link rel="stylesheet" href="./assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="./assets/css/style.css">
    <title>Notifications</title>
</head>
<body>
    <nav class="nav">
        <div class="container nav__container">
            <a class="nav_link fa fa-home" href="index.php"></a>
            <a class="nav_link fa fa-user" href="profile.php"></a>
            <a class="nav_link fa fa-bell selected" href="notifications.php"></a>
            <a class="nav_link fa fa-gear" href="setting.php"></a>
            <a class="nav_link" href="logout.php">
                <svg class="logout" xmlns="http://www.w3.org/2000/svg" fill="red" viewBox="0 0 512 512"><path d="M160 416H96c-17.67 0-32-14.33-32-32V128c0-17.67 14.33-32 32-32h64c17.67 0 32-14.33 32-32S177.7 32 160 32H96C42.98 32 0 74.98 0 128v256c0 53.02 42.98 96 96 96h64c17.67 0 32-14.33 32-32S177.7 416 160 416zM502.6 233.4l-128-128c-12.51-12.51-32.76-12.49-45.25 0c-12.5 12.5-12.5 32.75 0 45.25L402.8 224H192C174.3 224 160 238.3 160 256s14.31 32 32 32h210.8l-73.38 73.38c-12.5 12.5-12.5 32.75 0 45.25s32.75 12.5 45.25 0l128-128C515.1 266.1 515.1 245.9 502.6 233.4z"/></svg>
            </a>
        </div>
    </nav>

    <main class="main">
        <div class="container main__container">
            <h2>Notificaitons</h2>
            <div class="notifications">
                <?php
                    foreach($notificationData as $data) {
                        echo "
                            <div class='notification'>
                                <img src='./storage/profile/".$data['profilePicture']."' alt='".$data['userFullName']."' class='user_img'>
                                <div class='notification__details'>
                                    <h4 class='notification__title'>".$data['userFullName']." added a new post</h4>
                                    <p>".$data['description']."</p>
                                </div>
                            </div>
                        ";
                    }
                ?>
            </div>
        </div>
    </main>
    <script src="./assets/js/index.js"></script>
</body>
</html>
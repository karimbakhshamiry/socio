<?php
    include_once('controllers/core_functions.php');
    if (!isLoggedIn()) {
        header('location: login.php');
    };

    // some logic that pushes the my posts data from database
    // this variable represents fake data that we pretend it came from the database
    $sql = "SELECT * FROM posts WHERE username='".$_SESSION['user']['username']."'  ORDER BY id DESC";
    $result = $GLOBALS['mysql_connection']->query($sql);
    $posts_data = $result->fetch_all(MYSQLI_ASSOC);
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
    <title>Profile</title>
</head>
<body>
    <nav class="nav">
        <div class="container nav__container">
            <a class="nav_link fa fa-home" href="index.php"></a>
            <a class="nav_link fa fa-user selected" href="profile.php"></a>
            <a class="nav_link fa fa-bell" href="notifications.php"></a>
            <a class="nav_link fa fa-gear" href="setting.php"></a>
            <a class="nav_link" href="logout.php">
                <svg class="logout" xmlns="http://www.w3.org/2000/svg" fill="red" viewBox="0 0 512 512"><path d="M160 416H96c-17.67 0-32-14.33-32-32V128c0-17.67 14.33-32 32-32h64c17.67 0 32-14.33 32-32S177.7 32 160 32H96C42.98 32 0 74.98 0 128v256c0 53.02 42.98 96 96 96h64c17.67 0 32-14.33 32-32S177.7 416 160 416zM502.6 233.4l-128-128c-12.51-12.51-32.76-12.49-45.25 0c-12.5 12.5-12.5 32.75 0 45.25L402.8 224H192C174.3 224 160 238.3 160 256s14.31 32 32 32h210.8l-73.38 73.38c-12.5 12.5-12.5 32.75 0 45.25s32.75 12.5 45.25 0l128-128C515.1 266.1 515.1 245.9 502.6 233.4z"/></svg>
            </a>
        </div>
    </nav>
    <main class="main"> 
        <div class="profile_container">
            <img src="./storage/cover/<?php 
                    $cover = $_SESSION['user']['coverPhoto'] ? $_SESSION['user']['coverPhoto'] : 'default_cover.png'; 
                    echo $cover;
                
                ?>" alt="tiger cover" class="cover_photo">
            <div class="profile__details">
                <img src="./storage/profile/<?php 
                    $profile = $_SESSION['user']['profilePicture'] ? $_SESSION['user']['profilePicture']: 'default_avatar.png';
                    echo $profile;
                
                ?>" alt="" class="profile_picture">

                <div>
                    <span>@<?php echo $_SESSION['user']['name']." ".$_SESSION['user']['name']?></span>
                    <span class="fa fa-user"> 100 Friend(s)</span>
                    <span class="fa fa-calendar"> <?php echo count($posts_data) ?> Post(s)</span>
                </div>
            </div>
        </div>
        <div class="container main__container">
            <h2 class="title">My posts</h2>
            <div class="posts">
                <?php
                    foreach ($posts_data as $post) {
                        if ($post['image'] != null) {

                            echo "
                                <div class='post'>
                                    <div class='post__image_container'>
                                    <img class='post__image' src='./storage/post/". $post['image']."' alt='cover'>
                                </div>
                                    <p class='post__description'>".$post['description']."</p>
                                </div>
                            ";
                        } else {
                            echo "
                                <div class='post'>
                                    <div class='post__image_container'>
                                </div>
                                <p class='post__description'>".$post['description']."</p>
                                </div>
                            ";
                        }
                    }
                ?>
            </div>
        </div>
    </main>
    <script src="./assets/js/posts.js"></script>
    <script src="./assets/js/index.js"></script>
</body>
</html>
<?php
    include('controllers/core_functions.php');
    if (!isLoggedIn()) {
        header('location: login.php');
    };

    // HANDLING ANY NEW POST SUBMISSION
    if ($_POST['new_image_description']) {
        $description = $_POST['new_image_description'];
        $image = $_FILES['new_image']; 
        $username = $_SESSION['user']['username'];
        addPost($description, $image, $username);
    }

    // GETTNG POSTS OF THIS SPECIFIC USER
    $sql = "SELECT * FROM posts ORDER BY id DESC";
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
    <title>Socio</title>
</head>
<body>
    <!-- navigation goes here -->
    <nav class="nav">
        <div class="container nav__container">
            <a class="nav_link fa fa-home selected" href="index.php"></a>
            <a class="nav_link fa fa-user" href="profile.php"></a>
            <a class="nav_link fa fa-bell" href="notifications.php"></a>
            <a class="nav_link fa fa-gear" href="setting.php"></a>
            <a class="nav_link" href="logout.php">
                <svg class="logout" xmlns="http://www.w3.org/2000/svg" fill="red" viewBox="0 0 512 512"><path d="M160 416H96c-17.67 0-32-14.33-32-32V128c0-17.67 14.33-32 32-32h64c17.67 0 32-14.33 32-32S177.7 32 160 32H96C42.98 32 0 74.98 0 128v256c0 53.02 42.98 96 96 96h64c17.67 0 32-14.33 32-32S177.7 416 160 416zM502.6 233.4l-128-128c-12.51-12.51-32.76-12.49-45.25 0c-12.5 12.5-12.5 32.75 0 45.25L402.8 224H192C174.3 224 160 238.3 160 256s14.31 32 32 32h210.8l-73.38 73.38c-12.5 12.5-12.5 32.75 0 45.25s32.75 12.5 45.25 0l128-128C515.1 266.1 515.1 245.9 502.6 233.4z"/></svg>
            </a>
        </div>
    </nav>

    <main class="main"> 
        <div class="container main__container">
            <div class="post_form_container">
                <form action="" method="POST" enctype="multipart/form-data" class="post_form">
                    <label for="new_image">Add a picture
                        <input type="file" name="new_image" id="new_image">
                    </label>

                    <label for="new_image_description">
                        <textarea placeholder="what is in your mind?" name="new_image_description" id="new_image_description" cols="30" rows="10" required></textarea>
                    </label>
                    <button type="submit">Post</button>
                </form>
            </div>

            <h2>Latest activities</h2>
            
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
<?php
    $message = '';
    if (isset($_POST['email'])) {
        $email = $_POST["email"];
        // send a reset link to $email
        // header('location: login.php');
        $message = "A reset link has been sent to you email";

    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="./assets/css/style.css">
    <title>Forgot my password</title>
</head>
<body>
    <main class="main">
        <div class="container main__container">
            <div class="login_form_container">
                <form class="login_form" action="" method="POST" autocomplete="off">
                    <input type="email" name="email" id="email" placeholder="email" required>
                    <button type="submit">Send</button>
                    <div>
                        <p class="red"><?php echo $message?></p>
                        <p>Already have an account? Login <a href="login.php">here</a></p>
                        <p>Don't have an account? Sign up <a href="register.php">here</a></p>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <script src="./assets/js/index.js"></script>
</body>
</html>
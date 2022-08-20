<?php
    include('controllers/core_functions.php');
    if (isLoggedIn()) {
        header('location: index.php');
    }
    
    if (isset($_POST['username'])) {
        $newUser = [
            'name' => $_POST['name'],
            'lastname' => $_POST['lastname'],
            'username' => $_POST['username'],
            'password' => $_POST['password']
        ];

        if (strlen($newUser['password']) < 8) {
            $message = 'Password must be at least 8 characters!';
        } else if (!strlen($newUser['name']) > 0 && !strlen($newUser['lastname']) > 0 && !strlen($newUser['username']) > 0 ) {
            $message = 'name, lastname and username fields must not be empty!';
        }else if (strlen($newUser['name']) > 30 && strlen($newUser['lastname']) > 30 && strlen($newUser['password']) > 100 ) {
            $message = 'name and lastname must not be more than 30 characters, and passwords must not be more than 100 characters!';
        } else if (userExists($newUser['username'])) {
            $message = $newUser['username'].' has already been taken. Try a new username.';
        } else {
            addUser($newUser['name'], $newUser['lastname'], $newUser['username'], sha1($newUser['password']));
        }


    }
    

    // store the information in database and redirect the user to login page
    // header('location: login.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="./assets/css/style.css">
    <title>Sign up</title>
</head>
<body>
    <main class="main">
        <div class="container main__container">
            <div class="login_form_container">
                <form class="login_form" action="#" method="POST" autocomplete="off">
                    <input type="text" name="name" id="name" placeholder="name" maxlength="30" required>
                    <input type="text" name="lastname" id="lastname" placeholder="last name" maxlength="30" required>
                    <input type="email" name="username" id="username" placeholder="username (email)" maxlength="60" required>
                    <input type="password" name="password" id="password" placeholder="password" maxlength="100" required>
                    <button type="submit">Sign up</button>
                    <div>
                        <p class="red"><?php echo $message?></p>
                        <p>Already have an account? Login <a href="login.php">here</a></p>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <script src="./assets/js/index.js"></script>
</body>
</html>
<?php
    include('db_connection.php');
    session_start();
    $GLOBALS['mysql_connection'] = $link;


    function isLoggedIn() {
        if (isset($_SESSION['authenticated'])) {
            return true;
        } else {
            return false;
        }
    }

    function login($username, $password) {
        $sql = "SELECT * FROM users WHERE username='".$username."' AND password='".$password."'";
        $result = $GLOBALS['mysql_connection']->query($sql);
        $userDetails = $result->fetch_assoc();
        if ($userDetails) {
            $user = [
                'username' => $username,
                'name' => $userDetails['name'],
                'lastname' => $userDetails['lastName'],
                'coverPhoto' => $userDetails['coverPhoto'],
                'profilePicture' => $userDetails['profilePicture']
            ];

            $_SESSION['authenticated'] = true;
            $_SESSION['user'] = $user;

            return true;
        } else {
            return false;
        }
    }

    function userExists($username) {
        $sql = "SELECT * FROM users WHERE username='".$username."'";
        $result = $GLOBALS['mysql_connection']->query($sql);
        $userDetails = $result->fetch_assoc();
        if ($userDetails != null) {
            return true;
        } else {
            return false;
        }
    }

    function addUser($name, $lastName, $username, $password) {
        $sql = "INSERT INTO users (name, lastName, username, password) value ('$name', '$lastName', '$username', '$password')";
        echo $sql;  
        $GLOBALS['mysql_connection']->query($sql);
        header('location: login.php');
    }


    function addPost($description, $image, $username) {
        if ($image['size'] == 0) {
            $userFullName = $_SESSION['user']['name'].' '.$_SESSION['user']['lastname'];
            $sql = "INSERT INTO posts (description, username, userFullName) value ('$description', '$username', '$userFullName')";
            $GLOBALS['mysql_connection']->query($sql);
        } else {
            $imageTmpName = $image['tmp_name'];
            $imageNameParts = explode('.', $image['name']);
            $extension = end($imageNameParts);
            $imageName = returnUniqueName($username, $image['name']);
            $userFullName = $_SESSION['user']['name'].' '.$_SESSION['user']['lastname'];
            move_uploaded_file($imageTmpName, './storage/post/'.$imageName.'.'.$extension);
            $sql = "INSERT INTO posts (description, image, username, userFullName) value ('$description', '$imageName.".$extension."', '$username', '$userFullName')";
            $GLOBALS['mysql_connection']->query($sql);

        }
        header('location: index.php');
    }

    function returnUniqueName($username, $filename) {
        return sha1($username.$filename);
    }

    function changeCoverPhoto($username ,$image) {
        $imageTmpName = $image['tmp_name'];
        $imageType = $image['type'];
        if ($imageType == 'image/jpeg' || $imageType == 'image/png') {
            $imageNameParts = explode('.', $image['name']);
            $extension = end($imageNameParts);
            $imageName = returnUniqueName($username, $image['name']);
            move_uploaded_file($imageTmpName, './storage/cover/'.$imageName.'.'.$extension);

            $sql = "UPDATE users SET coverPhoto='".$imageName.".".$extension."' WHERE username='$username'";
            $GLOBALS['mysql_connection']->query($sql);
            header('location: profile.php');
            $_SESSION['user']['coverPhoto'] = $imageName.".".$extension;
            return;
        }

        return 'image type must be either jpg or png';

    }

    function changeProfilePicture($username ,$image) {
        $imageTmpName = $image['tmp_name'];
        $imageType = $image['type'];
        if ($imageType == 'image/jpeg' || $imageType == 'image/png') {
            $imageNameParts = explode('.', $image['name']);
            $extension = end($imageNameParts);
            $imageName = returnUniqueName($username, $image['name']).'.'.$extension;
            move_uploaded_file($imageTmpName, './storage/profile/'.$imageName);

            $sql = "UPDATE users SET profilePicture='$imageName' WHERE username='$username'";
            $GLOBALS['mysql_connection']->query($sql);
            header('location: profile.php');
            $_SESSION['user']['profilePicture'] = $imageName;
            header('location: profile.php');
            return;
        }

        return 'image type must be either jpg or png';

    }

    function clearProfile($username) {
        $sql = "SELECT profilePicture FROM users WHERE username='$username'";
        $result = $GLOBALS['mysql_connection']->query($sql);
        $filename = $result->fetch_assoc()['profilePicture'];

        unlink('./storage/profile/'.$filename);
        $_SESSION['user']['profilePicture'] = null;

        $sql = "UPDATE users SET  profilePicture=NULL WHERE username='$username'";
        $GLOBALS['mysql_connection']->query($sql);
        header('location: profile.php');
    }

    function clearCover($username) {
        $sql = "SELECT coverPhoto FROM users WHERE username='$username'";
        $result = $GLOBALS['mysql_connection']->query($sql);
        $filename = $result->fetch_assoc()['coverPhoto'];

        unlink('./storage/cover/'.$filename);
        $_SESSION['user']['coverPhoto'] = null;

        $sql = "UPDATE users SET  coverPhoto=NULL WHERE username='$username'";
        $GLOBALS['mysql_connection']->query($sql);
        header('location: profile.php');
    }

    function getNotificationData() {
        $sql = "SELECT u.profilePicture, p.* FROM users u JOIN posts p ON u.username=p.username ORDER BY id DESC";
        $result = $GLOBALS['mysql_connection']->query($sql);
        $notificationData = $result->fetch_all(MYSQLI_ASSOC);
        return $notificationData;
    }
?>
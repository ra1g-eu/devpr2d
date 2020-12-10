<?php
require "session.php";
try {
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
        if ($username == "") {
            echo "<h2><span class='badge badge-danger my-3'>Username field is required! <i class='fas fa-close'></i></span></h2>";
        } else if ($password == "") {
            echo "<h2><span class='badge badge-danger my-3'>Password field is required! <i class='fas fa-close'></i></span></h2>";
        } else {
            $id = $app->Login($username, $password); // check user login
            if ($id > 0) {
                $_SESSION['userid'] = $id; // Set Session
                echo "<h2><span class='badge badge-success my-3'>Successfully signed in! Redirecting...<i class='fas fa-sync fa-spin'></i></span></h2>";
            } else {
                echo "fail";
           }
        }
} catch (PDOException $error) {
    echo "<br>" . $error->getMessage();
}


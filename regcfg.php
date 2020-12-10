<?php
require "session.php";
try {
    if($app->isUsername($_POST['usernamereg']) && $app->isEmail($_POST['emailreg'])) {
        echo "allfail";
    } else if ($app->isUsername($_POST['usernamereg'])) {
        echo "usernamefail";
    } else if ($app->isEmail($_POST['emailreg'])) {
        echo "emailfail";
    } else {
        $id = $app->Register($_POST['usernamereg'], $_POST['passwordreg'], $_POST['emailreg']);
        $_SESSION['userid'] = $id;
        echo "<h2><span class='badge badge-success my-3'>Account created! Redirecting...<i class='fas fa-sync fa-spin'></i></span></h2>";
    }
} catch (PDOException $error) {
    echo "<br>" . $error->getMessage();
}

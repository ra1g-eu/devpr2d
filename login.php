<?php
include_once("session.php");
require "incl/config.php";
$login_error_message = '';
if (!empty($_POST['btnLogin'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    if ($username == "") {
        $login_error_message = 'Username field is required!';
    } else if ($password == "") {
        $login_error_message = 'Password field is required!';
    } else {
        $id = $app->Login($username, $password); // check user login
        if ($id > 0) {
            $_SESSION['userid'] = $id; // Set Session
            header("Location: myprofile.php");
        } else {
            $login_error_message = 'Invalid login details!';
        }
    }
}
if (!empty($_SESSION["userid"])) {
    header("Location: myprofile.php");
}
include_once("header.php"); ?>
<?php include_once("menu.php");
if (isset($_SESSION['userid']) && ($user->role) == 'banned'){
    header("Location: banned.php");
}
?>
<div class="container py-2">
    <div class="jumbotron elegant-color text-white">
        <h1 class="display-5">Login form</h1>
        <?php
        if ($login_error_message != "") {
            echo '<div class="alert alert-dismissible alert-danger">
  <strong>Error: </strong> <a href="#" class="alert-link">' . $login_error_message . '</div>';
        }
        ?>
        <form action="login.php" method="post">
            <div class="form-group">
                <label>Username</label>
                <input type="text" class="form-control" name="username" id="name" placeholder="Enter username"
                       required="required" pattern="[\s\S]*\S[\s\S]*" minlength="3" maxlength="20"/>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Enter password"
                       required="required" pattern="[\s\S]*\S[\s\S]*" maxlength="254"/>
            </div>

            <input type="submit" class="btn btn-success" value="Login" name="btnLogin"/>
        </form>
    </div>
</div>
<?php include_once("footer.php"); ?>
</body>
</html>

<?php include_once("session.php");
require "incl/config.php";
$register_error_message = '';
if (!empty($_POST['btnRegister'])) {
    if ($app->isEmail($_POST['email'])) {
        $register_error_message = 'Email is already in use!';
    } else if ($app->isUsername($_POST['username'])) {
        $register_error_message = 'Username is already in use!';
    } else {
        $id = $app->Register($_POST['username'], $_POST['password'], $_POST['email']);
        // set session and redirect user to the profile page
        $_SESSION['userid'] = $id;
        header("Location: myprofile.php");
    }
}
if (!empty($_SESSION["userid"])) {
    header("Location: myprofile.php");
}
include_once("header.php");?>
<?php include_once("menu.php"); ?>
<div class="container">
    <div class="jumbotron elegant-color text-white">
        <h1 class="display-5">Registration form</h1>
        <?php
        if ($register_error_message != "") {
            echo '<div class="alert alert-dismissible alert-danger">
  <strong>Error: </strong> <a href="#" class="alert-link">' . $register_error_message . '</div>';
        }
        ?>
        <form action="register.php" method="post">
            <div class="form-group">
                <label>Username</label>
                <input type="text" class="form-control" name="username" id="username"
                       placeholder="Enter username (0-20)" required="required" pattern="[\s\S]*\S[\s\S]*" minlength="3"
                       maxlength="20"/>
                <p class="lead"><span id="status" class="badge bg-info text-white text-center text-capitalize"></span></p>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="Enter email (0-150)"
                       required="required" pattern="[\s\S]*\S[\s\S]*" maxlength="150"/>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" name="password" id="password"
                       placeholder="Enter password (0-254)" required="required" pattern="[\s\S]*\S[\s\S]*"
                       maxlength="254"/>
            </div>

            <input type="submit" class="btn btn-success" value="Register" name="btnRegister"/>
        </form>
    </div>
</div>
<?php include_once("footer.php"); ?>
</body>
</html>

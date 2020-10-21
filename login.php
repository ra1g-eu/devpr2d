<!doctype html>
<html>
<head>
    <?php include_once ("header.php"); ?>

</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <?php include_once ("menu.php"); ?>
    <?php
    //session_start();
    include_once ("classes/DB.php");
    use classes\DB;
    $app = new DB("localhost","root","","devpeeporun", 3306);
    $login_error_message = '';
    if (!empty($_POST['btnLogin'])) {

        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
        $isloggedin = false;


        if ($username == "") {
            $login_error_message = 'Username field is required!';
        } else if ($password == "") {
            $login_error_message = 'Password field is required!';
        } else {
            $id = $app->Login($username, $password); // check user login
            if($id > 0)
            {
                $_SESSION['id'] = $id; // Set Session
                $_SESSION['logout'] = false;
                header("Location: myprofile.php"); // Redirect user to the profile.php
            }
            else
            {
                $login_error_message = 'Invalid login details!';
            }
        }
    }
    if(!empty($_SESSION["id"])){
        header("Location: myprofile.php");
    }
    ?>
</nav>
<div class="container">
    <div class="jumbotron">
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
                <input type="text" class="form-control" name="username" id="name" placeholder="Enter username" required="required" pattern="[\s\S]*\S[\s\S]*" minlength="3" maxlength="20"/>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Enter password" required="required" pattern="[\s\S]*\S[\s\S]*" maxlength="254"/>
            </div>

            <input type="submit" class="btn btn-success" value="Login" name="btnLogin"/>
        </form>
    </div>
</div>


</body>
</html>

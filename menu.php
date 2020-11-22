<?php
include_once("session.php");
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
?>
<nav class="nmb-1 navbar navbar-expand-lg navbar-dark unique-color lighten-5">
    <a class="navbar-brand" href="index.php">
        <?php if (empty($_SESSION["userid"])) {
            echo 'RA1GDev';
        } else {
            echo 'Hello <span class="badge badge-success">';
            echo $user->username;
            echo '</span>';
        }
        ?>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01"
            aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarColor01">
        <ul class="navbar-nav mr-auto">
            <?php foreach ($menuItems as $key => $menuItem): ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?= $menuItem['file_path']; ?>"><i
                                class="<?= $menuItem['icon']; ?>"></i> <?= $menuItem['meno']; ?></a>
                </li>
            <?php endforeach ?>
        </ul>
        <form class="form-inline my-2 my-lg-0">
            <?php if (isset($_SESSION['userid']) && ($user->role) == 'admin') { ?>
                <a class="nav-link btn btn-light darken-3" href="adminpanel/">Admin Panel</a>
            <?php }
            if (empty($_SESSION["userid"])) { ?>
                <button type="button" class="nav-link btn btn-secondary" id="SIORbtn">Sign In or
                    Register</button>
            <?php } else { ?>
                <a class="nav-link btn btn-light darken-3" href="myprofile.php">My profile </a>
                <a class="nav-link btn btn-pink" href="incl/logout.php">Logout</a>
            <?php } ?>
        </form>
    </div>
</nav>
<div class="modal fade" id="modalLRForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog cascading-modal" role="document">
        <!--Content-->
        <div class="modal-content">

            <!--Modal cascading tabs-->
            <div class="modal-c-tabs">

                <!-- Nav tabs -->
                <ul class="nav nav-tabs md-tabs tabs-2 elegant-color-dark" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#panel7" role="tab"><i
                                    class="fas fa-user mr-1"></i>
                            Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#panel8" role="tab"><i
                                    class="fas fa-user-plus mr-1"></i>
                            Register</a>
                    </li>
                </ul>

                <!-- Tab panels -->
                <div class="tab-content">

                    <!--Panel 7-->
                    <div class="tab-pane fade in show active" id="panel7" role="tabpanel">
                        <form action="menu.php" method="post">
                        <!--Body-->
                        <div class="modal-body mb-1">
                            <div id="result">
                            <?php
                            if ($login_error_message != "") {
                                echo '<div class="alert alert-dismissible alert-danger">
                                        <strong>Error: </strong>' . $login_error_message . '</div>';
                            }
                            ?>
                            </div>
                            <div class="md-form form-sm mb-5">
                                <i class="fas fa-user prefix"></i>
                                <input type="text" class="form-control form-control-sm validate" name="username" id="name" placeholder="Enter username"
                                       required="required" pattern="[\s\S]*\S[\s\S]*" minlength="3" maxlength="20">
                                <label data-error="wrong" data-success="right" for="modalLRInput10">Username</label>
                            </div>

                            <div class="md-form form-sm mb-4">
                                <i class="fas fa-lock prefix"></i>
                                <input type="password" class="form-control form-control-sm validate" name="password" id="password" placeholder="Enter password" required="required" pattern="[\s\S]*\S[\s\S]*" maxlength="254">
                                <label data-error="wrong" data-success="right" for="modalLRInput11">Your
                                    password</label>
                            </div>
                            <div class="text-center mt-2">
                                <input type="submit" class="btn btn-info" value="Log In" name="btnLogin"/>
                            </div>
                        </div>
                        <!--Footer-->
                        <div class="modal-footer">
                            <div class="options text-center text-md-right mt-1">
                                <p>Forgot <a href="#" class="blue-text">Password?</a></p>
                            </div>
                            <button type="button" class="btn btn-outline-info waves-effect ml-auto"
                                    data-dismiss="modal">Close
                            </button>
                        </div>
                        </form>
                    </div>
                    <!--/.Panel 7-->

                    <!--Panel 8-->
                    <div class="tab-pane fade" id="panel8" role="tabpanel">
                        <form action="menu.php" method="post">
                        <!--Body-->
                        <div class="modal-body">
                            <div id="result">
                                <?php
                                if ($register_error_message != "") {
                                    echo '<div class="alert alert-dismissible alert-danger">
  <strong>Error: </strong> <a href="#" class="alert-link">' . $register_error_message . '</div>';
                                }
                                ?></div>
                            <div class="md-form form-sm mb-5">
                                <i class="fas fa-user prefix"></i>
                                <label>Username</label>
                                <input type="text" class="form-control" name="username" id="username"
                                       placeholder="Enter username (0-20)" required="required" pattern="[\s\S]*\S[\s\S]*" minlength="3"
                                       maxlength="20"/>
                                <p class="lead"><span id="status" class="badge bg-info text-white text-center text-capitalize"></span></p>
                            </div>

                            <div class="md-form form-sm mb-5">
                                <i class="fas fa-envelope prefix"></i>
                                <label>Email</label>
                                <input type="email" class="form-control" name="email" id="email" placeholder="Enter email (0-150)"
                                       required="required" pattern="[\s\S]*\S[\s\S]*" maxlength="150"/>
                            </div>

                            <div class="md-form form-sm mb-4">
                                <i class="fas fa-lock prefix"></i>
                                <label>Password</label>
                                <input type="password" class="form-control" name="password" id="password"
                                       placeholder="Enter password (0-254)" required="required" pattern="[\s\S]*\S[\s\S]*"
                                       maxlength="254"/>
                            </div>

                            <div class="text-center form-sm mt-2">
                                <input type="submit" class="btn btn-info" value="Register" name="btnRegister"> <i class="fas fa-sign-in ml-1"></i></input>
                            </div>

                        </div>
                        <!--Footer-->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-info waves-effect ml-auto"
                                    data-dismiss="modal">Close
                            </button>
                        </div>
                        </form>
                    </div>
                    <!--/.Panel 8-->
                </div>

            </div>
        </div>
        <!--/.Content-->
    </div>
</div>
<script>
    $(document).ready(function(){
        $("#SIORbtn").click(function(){
            $("#modalLRForm").modal();
        });
    });
</script>
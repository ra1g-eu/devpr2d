<?php
include_once("session.php");
?>
<style>
    .nav-pills>li>a:hover,
    .nav-pills>li>a:focus,
    .nav-pills>li>a:focus {
        background-color: black;
    }
    .nav-pills > li > a.active {
        background-color: black!important;
    }
</style>
<nav class="navbar navbar-expand-lg sticky-top scrolling-navbar navbar-dark unique-color lighten-5">
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
        <ul class="nav nav-pills mr-auto">
            <?php foreach ($menuItems as $key => $menuItem):
                if (strpos($_SERVER['PHP_SELF'], $menuItem['file_path'])) $code = 'show active'; else $code = ''; //vyznac aktualne vybrane menu
                ?>
                <li class="nav-item">
                    <a class="nav-link text-white <?php echo $code; ?>" href="<?= $menuItem['file_path']; ?>"><i
                                class="<?= $menuItem['icon']; ?>"></i> <?= $menuItem['meno']; ?></a>
                </li>
            <?php endforeach ?>
        </ul>
        <?php if (empty($_SESSION["userid"]) && isset($_COOKIE['devra1gCookieConsent'])) { ?>
            <form class="form-inline my-2 my-lg-0 reglogform">
                <button type="button" class="nav-link btn btn-secondary rounded waves-effect"
                        id="SIORbtn">
                    <i class="fas fa-sign-in-alt mr-2"></i>Sign In or Register
                </button>
            </form>
        <?php } else;?>
        <?php if (isset($_SESSION['userid']) && ($user->role) == 'admin') { ?>
            <a class="nav-link btn btn-light darken-3" href="adminpanel/">Admin Panel</a>
        <?php } if (!empty($_SESSION["userid"])) { ?>
            <a class="nav-link btn btn-light darken-3" href="myprofile.php">My profile </a>
            <a class="nav-link btn btn-pink" href="incl/logout.php">Logout</a>
        <?php } ?>
    </div>
</nav>
<div class="modal fade" id="modalLRForm" tabindex="-1" role="dialog" aria-labelledby="modalLRForm" aria-hidden="true">
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
                            Sign In</a>
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
                        <form method="post" id="signInForm" name="signInForm" enctype="multipart/form-data">
                            <!--Body-->
                            <div class="modal-body mb-1">
                                <h2 class="text-center"><span id="signingin" class="badge badge-info my-3 hide text-wrap"></span></h2>
                                <div id="signresult" class="text-center text-wrap"></div>
                                <div class="md-form form-sm mb-5">
                                    <i class="fas fa-user prefix"></i>
                                    <input type="text" class="form-control form-control-sm validate my-3"
                                           name="username" id="name" placeholder="Enter username"
                                           required="required" pattern="[\s\S]*\S[\s\S]*" minlength="3" maxlength="20">
                                    <label class="active" for="name">Username</label>
                                </div>

                                <div class="md-form form-sm mb-4">
                                    <i class="fas fa-lock prefix"></i>
                                    <label class="active" for="password">Your
                                        password</label>
                                    <input type="password" class="form-control form-control-sm validate" name="password"
                                           id="password" placeholder="Enter password" required="required"
                                           pattern="[\s\S]*\S[\s\S]*" maxlength="254">

                                </div>
                                <div class="text-center mt-2">
                                    <button type="submit" class="btn btn-info" name="btnLogin" id="btnLogin">Sign In</button>
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
                        <form id="registerForm" name="registerForm" method="post">
                            <!--Body-->
                            <div class="modal-body">
                                <h2 class="text-center"><span id="registering" class="badge badge-info my-3 hide"></span></h2>
                                <div id="registerresult" class="text-center"></div>
                                <div class="md-form form-sm mb-5">
                                    <i class="fas fa-user prefix"></i>
                                    <label class="active">Username</label>
                                    <input type="text" class="form-control" name="usernamereg" id="usernamereg"
                                           placeholder="Enter username (0-20)" required="required"
                                           pattern="[\s\S]*\S[\s\S]*" minlength="3"
                                           maxlength="20"/>
                                    <p class="lead" id="status"></p>
                                </div>

                                <div class="md-form form-sm mb-5">
                                    <i class="fas fa-envelope prefix"></i>
                                    <label class="active">Email</label>
                                    <input type="email" class="form-control" name="emailreg" id="emailreg"
                                           placeholder="Enter email (0-150)"
                                           required="required" pattern="[\s\S]*\S[\s\S]*" maxlength="150"/>
                                </div>

                                <div class="md-form form-sm mb-4">
                                    <i class="fas fa-lock prefix"></i>
                                    <label class="active">Password</label>
                                    <input type="password" class="form-control" name="passwordreg" id="passwordreg"
                                           placeholder="Enter password (0-254)" required="required"
                                           pattern="[\s\S]*\S[\s\S]*"
                                           maxlength="254"/>
                                </div>

                                <div class="text-center form-sm mt-2">
                                    <input type="submit" class="btn btn-info" value="Register" id="btnRegister" name="btnRegister"/><i
                                            class="fas fa-sign-in ml-1"></i>
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
<div class="modal fade bottom cookiemodal" id="cookiemodal" tabindex="-1" role="dialog"
     aria-labelledby="cookiemodal" aria-hidden="false" data-backdrop="static">
    <div class="modal-dialog modal-frame modal-bottom" role="document">
        <!--Content-->
        <div class="modal-content unique-color-dark text-white">
            <!--Body-->
            <div class="modal-body ">
                <div class="row d-flex justify-content-center align-items-center">

                    <p class="pt-3 pr-2 lead">This site uses cookies to enhance your experience.</p>

                    <button type="button" class="btn btn-outline-success acceptcookies" data-dismiss="modal">I agree
                    </button>
                    <a role="button" class="btn btn-outline-warning waves-effect" data-dismiss="modal">No, thanks</a>
                </div>
            </div>
        </div>
        <!--/.Content-->
    </div>
</div>
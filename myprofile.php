<?php include_once("session.php");
require "incl/config.php";
if (empty($_SESSION["userid"])) {
    header("Location: index.php");
}
include_once("header.php");
?>
<body>
<?php include_once("menu.php");
?>
<div class="container">
    <div class="jumbotron">
        <h1 class="display-5">My profile</h1>

        <p><h4>Your username</h4>
        <div class="alert alert-dismissible alert-success">
            <strong><?php echo $user->username ?></strong>
        </div>
        </p>
        <p><h5>Your email:</h5>
        <div class="alert alert-dismissible alert-success">
            <strong><?php echo $user->email ?></strong>
        </div>
        </p>

        <p><h5>Your role:</h5>
        <div class="alert alert-dismissible alert-success">
            <strong><?php echo $user->role ?></strong>
        </div>
        </p>

    </div>
</div>
<?php include_once("footer.php"); ?>
</body>
</html>

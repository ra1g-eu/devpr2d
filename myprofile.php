<!doctype html>
<html>
<head>

    <?php
    include_once("header.php");
    if(empty($_SESSION["id"])){
        header("Location: index.php");
    }
    ?>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <?php include_once("menu.php"); ?>
</nav>
<div class="container">
<div class="jumbotron">
    <h1 class="display-5">My profile</h1>

    <p><h4>Your username</h4>
    <div class="alert alert-dismissible alert-success">
        <strong><?php echo $user->username ?></strong>
    </div> </p>
    <p><h5>Your email:</h5>
        <div class="alert alert-dismissible alert-success">
            <strong><?php echo $user->email ?></strong>
        </div></p>

    <p><h5>Your role:</h5>
        <div class="alert alert-dismissible alert-success">
            <strong><?php echo $user->role ?></strong>
        </div></p>

</div>
</div>
<?php include_once("footer.php"); ?>
</body>
</html>

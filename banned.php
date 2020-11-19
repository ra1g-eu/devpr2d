<?php
include_once("session.php");
include_once("header.php");
if (!isset($_SESSION['userid']) || ($user->role) != 'banned'){
    header("Location: index.php");
} else if (isset($_SESSION['userid']) || ($user->role) == 'banned') {
?>
<div class="container py-2">

    <div class="jumbotron elegant-color text-white"">
        <h1 class="display-5">You have been banned!</h1>
        <p class="lead">What does this mean for you?</p>
        <p>You won't be able to access the whole page while logged in.</p>
        <p>To find out more, send an email to the administrators.</p>
        <p><a class="btn btn-outline-danger" href="incl/logout.php">Logout  <i class="fa fa-sign-out"></i></a></p>
    </div>
</div>
</body>
</html>
<?php } ?>
<?php
include_once("../session.php");
if (empty($_SESSION['userid']) || ($user->role) == 'basic' || ($user->role == 'banned')) {
    header("Location: ../");
}
require "../incl/config.php";
require "../incl/adminconfig.php";
$conn = new PDO($dsn, $username, $password, $options);
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    try {
        if (isset($_GET['editrole'])) {
            $idusr = $_GET['editrole'];
            $usr = getUsersById($idusr,$conn);
        }
            ?>
                <div class="modal-header">
                    <h5 class="modal-title">User ID: <?php echo $idusr; ?></h5>
                    <button type="button" class="close btn btn-danger" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">X</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php
                    foreach($usr as $key => $details) {
                        ?>
                        <p>User name: <?= $details['username']; ?></p>
                        <p>User role:
                        <?php if ($details['role'] === 'basic') { echo '<span class="badge bg-info">';}
                        else if ($details['role'] === 'admin') { echo '<span class="badge bg-success">';}
                        else if ($details['role'] === 'banned') { echo '<span class="badge bg-danger">';}
                        ?><?= $details['role'] ?></span> </p>
                        <hr class="my-4">
                        <h5>Available actions:</h5>
                        <?php if($user->username !== $details['username']){ ?>
                        <?php if ($details['role'] === 'admin' || $details['role'] === 'banned') { ?>
                        <a href="userspage.php?makebasic=<?php echo $idusr; ?>" class="btn btn-info">Make Basic</a>
                        <?php } if ($details['role'] === 'basic') {?>
                        <a href="userspage.php?makeadmin=<?php echo $idusr; ?>" class="btn btn-success">Make Admin</a>
                        <a href="userspage.php?banuser=<?php echo $idusr; ?>" class="btn btn-danger" onClick='return confirmSubmit()'>BAN User</a>
                        <?php } }
                    }
                    ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                </div>
        <?php  }  catch (PDOException $error) {
        $failure = "<br>" . $error->getMessage();
    }
}
?>
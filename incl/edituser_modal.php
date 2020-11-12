<?php
include_once("../session.php");
require "config.php";
require "adminconfig.php";
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
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php
                    foreach($usr as $key => $details) {
                        ?>
                        <p>User name: <?= $details['username']; ?></p>
                        <p>User role:
                        <?php if ($details['role'] === 'basic') { echo '<span class="badge badge-primary">';}
                        else if ($details['role'] === 'admin') { echo '<span class="badge-success">';}
                        else if ($details['role'] === 'banned') { echo '<span class="badge-danger">';}
                        ?><?= $details['role'] ?></span> </p>
                        <hr class="my-4">
                        <h5>Available actions:</h5>
                        <?php if($user->username !== $details['username']){ ?>
                        <?php if ($details['role'] === 'admin' || $details['role'] === 'banned') { ?>
                        <a href="adminpanel.php?makebasic=<?php echo $idusr; ?>" class="btn btn-primary">Make Basic</a>
                        <?php } if ($details['role'] === 'basic') {?>
                        <a href="adminpanel.php?makeadmin=<?php echo $idusr; ?>" class="btn btn-success">Make Admin</a>
                        <a href="adminpanel.php?banuser=<?php echo $idusr; ?>" class="btn btn-danger" onClick='return confirmSubmit()'>BAN User</a>
                        <?php } }
                    }
                    ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button>
                </div>
        <?php  }  catch (PDOException $error) {
        $failure = "<br>" . $error->getMessage();
    }
}
?>
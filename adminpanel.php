<?php include_once("session.php");
if (empty($_SESSION['userid']) || ($user->role) == 'basic') {
    header("Location: index.php");
}
include_once("header.php");
require "incl/config.php";
require "incl/adminconfig.php";
$conn = new PDO($dsn, $username, $password, $options);
$rs = getUsers($conn);
$resultsmenu = getMenu($conn);
$failure = "";
$success = "";
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    try {
        if (isset($_GET['banuser'])) {
            $id = $_GET['banuser'];
            $statement = $conn->prepare("UPDATE users SET role='banned' WHERE userid=:userid");
            $statement->bindValue(':userid', $id);
            $statement->execute();
            var_dump($statement->debugDumpParams());
            $success = "User successfully banned!";
            echo('<meta http-equiv="refresh" content="2;url=adminpanel.php">');
        }
        if (isset($_GET['makeadmin'])) {
            $id = $_GET['makeadmin'];
            $statement = $conn->prepare("UPDATE users SET role='admin' WHERE userid=:userid");
            $statement->bindValue(':userid', $id);
            $statement->execute();
            var_dump($statement->debugDumpParams());
            $success = "User successfully made admin!";
            echo('<meta http-equiv="refresh" content="2;url=adminpanel.php">');
        }
        if (isset($_GET['makebasic'])) {
            $id = $_GET['makebasic'];
            $statement = $conn->prepare("UPDATE users SET role='basic' WHERE userid=:userid");
            $statement->bindValue(':userid', $id);
            $statement->execute();
            var_dump($statement->debugDumpParams());
            $success = "User successfully normalized!";
            echo('<meta http-equiv="refresh" content="2;url=adminpanel.php">');
        }
    } catch (PDOException $error) {
        $failure = "<br>" . $error->getMessage();
    }
}
?>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <?php include_once("menu.php");
    ?>
</nav>
<div class="container">

    <div class="jumbotron">
        <h1 class="display-5">Administration panel</h1>
        <hr class="my-4">
        <?php include_once("incl/modal.php"); ?>
        <h2>Users table</h2>
        <table class="table table-success" id="rolechangetable" style="border: 2px #0d0d0d solid">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Username</th>
                <th scope="col">Role</th>
                <th scope="col">Action 1</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($rs as $resultuser): ?>
                <tr class="table-light">
                    <td><?php echo $resultuser['userid']; ?></td>
                    <td><?= $resultuser['username']; ?></td>
                    <td>
                        <?php if ($resultuser['role'] === 'basic') {
                            echo 'basic';
                        } ?>
                        <?php if ($resultuser['role'] === 'admin') {
                            echo 'admin';
                        } ?>
                        <?php if ($resultuser['role'] === 'banned') {
                            echo 'banned';
                        } ?>
                    </td>
                    <td>
                        <a class="btn btn-info modaledituser btn-block"
                           href="incl/edituser_modal.php?editrole=<?php echo $resultuser['userid']; ?>">EDIT <i class="fa fa-pencil"></i></a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <hr class="my-4">
        <h2>Menu table</h2>
        <table class="table table-info" id="menuedittable" style="border: 2px #0d0d0d solid">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">File path</th>
                <th scope="col"><a href="https://fontawesome.com/v4.7.0/icons/">Icon code</a></th>
                <th scope="col">Menu order</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($resultsmenu as $key => $resultm) { ?>
                <tr class="table-light">
                    <td><?= $resultm['idmenu']; ?></td>
                    <td><?= $resultm['meno']; ?></td>
                    <td><?= $resultm['file_path']; ?></td>
                    <td><?= $resultm['icon']; ?></td>
                    <td><?= $resultm['menuorder']; ?></td>
                    <td>
                        <button type="submit" class="btn btn-danger btn-sm" name="deletemenu" style="float: right;"
                                onClick='return confirmSubmit()'>BAN <i class="fa fa-close"></i></button>
                        <button type="submit" class="btn btn-success btn-sm" name="updatemenu"
                                onClick='return confirmSubmit()' style="float: right;">UPDATE <i
                                    class="fa fa-check"></i></button>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<script>
    $( document ).ready(function() {
        $(".modaledituser").on('click',function(e){ //trigger when link clicked
            e.preventDefault();
            $('#userBox').modal('show'); //force modal to show
            $('.modal-content').load( $(this).attr('href')); //load content from link's href
        });
    });
</script>
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="userBox" aria-hidden="true" id="userBox">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

        </div>
    </div>
</div>

<?php

include_once("footer.php"); ?>
</body>
</html>

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
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        if (isset($_POST['savemenub'])) {
            $idmenu = $_POST['menuid'];
            $menuname = $_POST['menuname'];
            $menufilepath = $_POST['menufilepath'];
            $menuicon = $_POST['menuicon'];
            $menuorder = $_POST['menuorder'];
            $statement = $conn->prepare("UPDATE menu SET meno=:meno, file_path=:file_path, icon=:icon, menuorder=:menuorder WHERE idmenu=:idmenu");
            $statement->bindParam(':idmenu', $idmenu, PDO::PARAM_INT);
            $statement->bindValue(':meno', $menuname);
            $statement->bindValue(':file_path', $menufilepath);
            $statement->bindValue(':icon', $menuicon);
            $statement->bindValue(':menuorder', $menuorder);
            $statement->execute();
            //var_dump($statement->debugDumpParams());
            $success = "Menu successfully updated!";
            echo('<meta http-equiv="refresh" content="2;url=adminpanel.php">');
        }
        if (isset($_POST['addnewmenu'])) {
            $new_menu = array(
                "meno" => $_POST['menunameA'],
                "file_path" => $_POST['menufilepathA'],
                "icon" => $_POST['menuiconA'],
                "menuorder" => $_POST['menuorderA']
            );
            $sql = sprintf(
                "INSERT INTO %s (%s) values (%s)",
                "menu",
                implode(", ", array_keys($new_menu)),
                ":" . implode(", :", array_keys($new_menu))
            );
            $statement = $conn->prepare($sql);
            $statement->execute($new_menu);
            $success = "Menu successfully added!";
            echo('<meta http-equiv="refresh" content="2;url=adminpanel.php">');
        }
        if (isset($_POST['deletemenub'])) {
            $idmenu = $_POST['menuid'];
            $statement = $conn->prepare("DELETE FROM menu WHERE idmenu=:idmenu");
            $statement->bindParam(':idmenu', $idmenu, PDO::PARAM_INT);
            $statement->execute();
            $success = "Menu successfully deleted!";
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
                <th scope="col">Action</th>
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
                           href="incl/edituser_modal.php?editrole=<?php echo $resultuser['userid']; ?>">EDIT <i
                                    class="fa fa-edit"></i></a>
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
                <th scope="col">Action</th>
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
                        <a class="btn btn-info menuedituser btn-block"
                           href="incl/editmenu_modal.php?editmenu=<?php echo $resultm['idmenu']; ?>">EDIT <i
                                    class="fa fa-edit"></i></a>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
        <hr class="my-lg-5">
        <div class="card text-white bg-info mb-3" style="max-width: fit-content;">
            <div class="card-header"><h3 class="card-title">Add new menu</h3></div>
            <div class="card-body">
                <form action="adminpanel.php" method="post" name="addmenuform">
                    <div class="form-group">
                        <label class="col-form-label " for="inputLarge">Menu name</label>
                        <input class="form-control " type="text" placeholder="Menu name" id="menuInput" name="menunameA" value="">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="inputLarge">Menu file path</label>
                        <input class="form-control" type="text" placeholder="Menu file path" id="menuInput" name="menufilepathA" value="">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="inputLarge">Menu icon <a class="badge badge-dark"
                                                                                    href="https://fontawesome.com/v4.7.0/icons/">(Click
                                here to see icon codes)</a></label>
                        <input class="form-control" type="text" placeholder="Menu icon (Example: fa fa-refresh)"
                               id="menuInput" name="menuiconA" value="">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="inputLarge">Menu order</label>
                        <input class="form-control" type="text" placeholder="Menu order" id="menuInput" name="menuorderA" value="">
                    </div>
                    <button type="submit" name="addnewmenu" class="btn btn-success btn-block">Add new <i
                                class="fa fa-pencil"></i></button>
                    <button type="reset" class="btn btn-primary btn-block">Reset <i class="fa fa-refresh"></i></button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $(".modaledituser").on('click', function (e) { //trigger when link clicked
            e.preventDefault();
            $('#userBox').modal('show'); //force modal to show
            $('.modal-content').load($(this).attr('href')); //load content from link's href
        });
    });
</script>
<script>
    $(document).ready(function () {
        $(".menuedituser").on('click', function (e) { //trigger when link clicked
            e.preventDefault();
            $('#menuBox').modal('show'); //force modal to show
            $('.modal-content').load($(this).attr('href')); //load content from link's href
        });
    });
</script>
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="menuBox" aria-hidden="true" id="menuBox">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

        </div>
    </div>
</div>
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

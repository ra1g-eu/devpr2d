<?php
include_once("adminheader.php");
require "../incl/config.php";
require "../incl/adminconfig.php";
$conn = new PDO($dsn, $username, $password, $options);
$rs = getUsers($conn);
$failure = "";
$success = "";
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    try {
        if (isset($_GET['banuser'])) {
            $id = $_GET['banuser'];
            $statement = $conn->prepare("UPDATE users SET role='banned' WHERE userid=:userid");
            $statement->bindValue(':userid', $id);
            $statement->execute();
            //var_dump($statement->debugDumpParams());
            $success = "User successfully banned! Refresh in 2 seconds.";
            echo('<meta http-equiv="refresh" content="2;url=userspage.php">');
        }
        if (isset($_GET['makeadmin'])) {
            $id = $_GET['makeadmin'];
            $statement = $conn->prepare("UPDATE users SET role='admin' WHERE userid=:userid");
            $statement->bindValue(':userid', $id);
            $statement->execute();
            $success = "User successfully made admin! Refresh in 2 seconds.";
            echo('<meta http-equiv="refresh" content="2;url=userspage.php">');
        }
        if (isset($_GET['makebasic'])) {
            $id = $_GET['makebasic'];
            $statement = $conn->prepare("UPDATE users SET role='basic' WHERE userid=:userid");
            $statement->bindValue(':userid', $id);
            $statement->execute();
            $success = "User successfully normalized! Refresh in 2 seconds.";
            echo('<meta http-equiv="refresh" content="2;url=userspage.php">');
        }
    } catch (PDOException $error) {
        $failure = "<br>" . $error->getMessage();
    }
}
?>
<div class="app-wrapper">
    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">
            <div class="row g-3 mb-4 align-items-center justify-content-between">
                <div class="col-auto">
                    <!-- ALERTY PRE USPECH ALEBO FAIL START -->
                    <?php if($success != ""){ ?>
                        <div class="alert alert-dismissible alert-success">
                            <button type="button" class="btn-close" data-dismiss="alert"></button>
                            <strong><?php echo $success; ?></strong>
                        </div>
                    <?php } else if($failure !=""){?>
                        <div class="alert alert-dismissible alert-danger">
                            <button type="button" class="btn-close" data-dismiss="alert"></button>
                            <strong><?php echo $failure; ?></strong>
                        </div>
                    <?php } else {} ?>
                    <!-- ALERTY PRE USPECH ALEBO FAIL KONIEC -->
                    <h1 class="app-page-title mb-0">Registered users</h1>
                </div>
            </div><!--//row-->
            <div class="tab-content" id="orders-table-tab-content">
                <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
                    <div class="app-card app-card-orders-table shadow-sm mb-5">
                        <div class="app-card-body">
                            <div class="table-responsive">
                                <table class="table table-secondary app-table-hover mb-0 text-left"
                                       id="rolechangetable">
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
                                        <tr>
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
                                                <a class="btn btn-warning modaledituser btn-block"
                                                   href="edituser_modal.php?editrole=<?php echo $resultuser['userid']; ?>">EDIT
                                                    <i
                                                            class="fa fa-edit"></i></a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div><!--//table-responsive-->

                        </div><!--//app-card-body-->
                    </div><!--//app-card-->
                </div><!--//tab-pane-->
            </div>

        </div><!--//app-wrapper-->
        <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="userBox" aria-hidden="true"
             id="userBox">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">

                </div>
            </div>
        </div>
        <?php include_once("adminfooter.php"); ?>


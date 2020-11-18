<?php
include_once("adminheader.php");
require "../incl/config.php";
require "../incl/adminconfig.php";
$conn = new PDO($dsn, $username, $password, $options);
$resultsmenu = getMenu($conn);
$failure = "";
$success = "";
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
            echo('<meta http-equiv="refresh" content="2;url=menupage.php">');
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
            $success = "Menu successfully created!";
            echo('<meta http-equiv="refresh" content="2;url=menupage.php">');
        }
        if (isset($_POST['deletemenub'])) {
            $idmenu = $_POST['menuid'];
            $statement = $conn->prepare("DELETE FROM menu WHERE idmenu=:idmenu");
            $statement->bindParam(':idmenu', $idmenu, PDO::PARAM_INT);
            $statement->execute();
            $success = "Menu successfully deleted!";
            echo('<meta http-equiv="refresh" content="2;url=menupage.php">');
        }
    } catch (PDOException $error) {
        $failure = "<br>" . $error->getMessage();
    }
}
include_once("modal.php");
?>
<div class="app-wrapper">
    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">
            <div class="row g-3 mb-4 align-items-center justify-content-between">
                <div class="col-auto">
                    <h1 class="app-page-title mb-0">Active menus</h1>
                </div>
            </div><!--//row-->
            <div class="tab-content" id="orders-table-tab-content">
                <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
                    <div class="app-card app-card-orders-table shadow-sm mb-5">
                        <div class="app-card-body">
                            <div class="table-responsive">
                                    <table class="table table-secondary app-table-hover mb-0 text-left" id="menuedittable" >
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
                                            <tr>
                                                <td><?= $resultm['idmenu']; ?></td>
                                                <td><?= $resultm['meno']; ?></td>
                                                <td><?= $resultm['file_path']; ?></td>
                                                <td><?= $resultm['icon']; ?></td>
                                                <td><?= $resultm['menuorder']; ?></td>
                                                <td>
                                                    <a class="btn btn-warning modalmenuedit btn-block"
                                                       href="editmenu_modal.php?editmenu=<?php echo $resultm['idmenu']; ?>">EDIT <i
                                                            class="fa fa-edit"></i></a>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                            </div><!--//table-responsive-->

                        </div><!--//app-card-body-->
                    </div><!--//app-card-->
                </div><!--//tab-pane-->
            </div>
            <button type="button" class="btn-lg btn-block btn-success" data-toggle="modal" data-target="#menuAddBox">
                Create new menu  <i class="fa fa-check-square-o"></i>
            </button>
        </div><!--//app-wrapper-->
        <div class="modal fade" id="menuBox" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">

                </div>
            </div>
        </div>

        <div class="modal fade" id="menuAddBox" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content bg-info text-white">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add new menu</h5>
                            <button type="button" class="close badge bg-danger" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">X</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="menupage.php" method="post" name="addmenuform">
                                <div class="form-group">
                                    <label class="col-form-label " for="inputLarge">Menu name</label>
                                    <input class="form-control " type="text" placeholder="Menu name" id="menuInput" name="menunameA" value="">
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label" for="inputLarge">Menu file path</label>
                                    <input class="form-control" type="text" placeholder="Menu file path" id="menuInput" name="menufilepathA" value="">
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label" for="inputLarge">Menu icon <a class="badge bg-danger"
                                                                                                href="https://fontawesome.com/v4.7.0/icons/">(Click
                                            here to see icon codes)</a></label>
                                    <input class="form-control" type="text" placeholder="Menu icon (Example: fa fa-refresh)"
                                           id="menuInput" name="menuiconA" value="">
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label" for="inputLarge">Menu order</label>
                                    <input class="form-control" type="text" placeholder="Menu order" id="menuInput" name="menuorderA" value="">
                                </div>
                                <div class="modal-body">
                                <button type="submit" name="addnewmenu" class="btn btn-success btn-block">Add new <i
                                            class="fa fa-pencil"></i></button>
                                <button type="reset" class="btn btn-light btn-block">Reset <i class="fa fa-refresh"></i></button>
                                </div>
                            </form>
                        </div>
                </div>
            </div>
        </div>

        <?php include_once("adminfooter.php"); ?>


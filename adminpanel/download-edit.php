<?php
include_once("adminheader.php");
require "../incl/config.php";
require "../incl/adminconfig.php";
$conn = new PDO($dsn, $username, $password, $options);
$oldreleases = getOldReleases($conn);
$latestreleases = getLatestReleases($conn);
$failure = "";
$success = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        if (isset($_POST['updaterelease'])) {
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
            $success = "Menu successfully updated! Refresh in 2 seconds.";
            echo('<meta http-equiv="refresh" content="2;url=menupage.php">');
        }
        if (isset($_POST['savenewrelease'])) {
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
            $success = "Menu successfully created! Refresh in 2 seconds.";
            echo('<meta http-equiv="refresh" content="2;url=menupage.php">');
        }
        if (isset($_POST['deleterelease'])) {
            $idmenu = $_POST['menuid'];
            $statement = $conn->prepare("DELETE FROM menu WHERE idmenu=:idmenu");
            $statement->bindParam(':idmenu', $idmenu, PDO::PARAM_INT);
            $statement->execute();
            $success = "Menu successfully deleted! Refresh in 2 seconds.";
            echo('<meta http-equiv="refresh" content="2;url=menupage.php">');
        }
    } catch (PDOException $error) {
        $failure = "<br>" . $error->getMessage();
    }
}
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
try {
    if(isset($_GET['makeold'])){
        $idrel = $_GET['makeold'];
        $statement = $conn->prepare("UPDATE releases SET islatest='no' WHERE idrelease=:idrelease");
        $statement->bindParam(':idrelease', $idrel, PDO::PARAM_INT);
        $statement->execute();
        //var_dump($statement->debugDumpParams());
        $success = "Release is no longer the latest! Refresh in 2 seconds.";
        echo('<meta http-equiv="refresh" content="2;url=download-edit.php">');
    }
    if(isset($_GET['makelatest'])){
        $idrel = $_GET['makelatest'];
        $statement = $conn->prepare("UPDATE releases SET islatest='yes' WHERE idrelease=:idrelease");
        $statement->bindParam(':idrelease', $idrel, PDO::PARAM_INT);
        $statement->execute();
        //var_dump($statement->debugDumpParams());
        $success = "Release is now the latest one! Refresh in 2 seconds.";
        echo('<meta http-equiv="refresh" content="2;url=download-edit.php">');

    }
} catch (PDOException $error) {
    $failure = "<br>" . $error->getMessage();
}
}
?>
<div class="app-wrapper">
    <div class="alert alert-dismissible alert-info text-danger text-center text-uppercase" style="font-size: 25px">
        <button type="button" class="btn-close" data-dismiss="alert"></button>
        <strong>Always check if there is only one latest release of a given application!</strong>
    </div>
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
                    <h1 class="app-page-title mb-0">Latest releases</h1>
                </div>
            </div><!--//row-->
            <div class="tab-content" id="orders-table-tab-content">
                <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
                    <div class="app-card app-card-orders-table shadow-sm mb-5">
                        <div class="app-card-body">
                            <div class="table-responsive">
                                <table class="table table-secondary app-table-hover mb-0 text-left" id="latestreleases" >
                                    <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">File path</th>
                                        <th scope="col">Version</th>
                                        <th scope="col">Is latest?</th>
                                        <th scope="col">Upload Date</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($latestreleases as $key => $latestR) { ?>
                                        <tr>
                                            <td><?= $latestR['idrelease']; ?></td>
                                            <td><?= $latestR['name']; ?></td>
                                            <td><?= $latestR['file_path']; ?></td>
                                            <td><?= $latestR['version']; ?></td>
                                            <td><?= $latestR['islatest']; ?></td>
                                            <td><?= $latestR['dateuploaded']; ?></td>
                                            <td>
                                                <a class="btn btn-warning modaldownloadedit btn"
                                                   href="downloadedit_modal.php?editdl=<?php echo $latestR['idrelease']; ?>">EDIT <i
                                                        class="fa fa-edit"></i></a>
                                                <a class="btn btn-danger btn"
                                                   href="download-edit.php?makeold=<?php echo $latestR['idrelease']; ?>">Make Old <i
                                                        class="fa fa-archive"></i></a>
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
            <hr class="my-5">
            <div class="row g-3 mb-4 align-items-center justify-content-between">
                <div class="col-auto">
                    <h1 class="app-page-title mb-0">Previous releases</h1>
                </div>
            </div><!--//row-->
            <div class="tab-content" id="orders-table-tab-content">
                <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
                    <div class="app-card app-card-orders-table shadow-sm mb-5">
                        <div class="app-card-body">
                            <div class="table-responsive">
                                <table class="table table-secondary app-table-hover mb-0 text-left" id="allreleases" >
                                    <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">File path</th>
                                        <th scope="col">Version</th>
                                        <th scope="col">Is latest?</th>
                                        <th scope="col">Upload Date</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($oldreleases as $key => $oldR) { ?>
                                        <tr>
                                            <td><?= $oldR['idrelease']; ?></td>
                                            <td><?= $oldR['name']; ?></td>
                                            <td><?= $oldR['file_path']; ?></td>
                                            <td><?= $oldR['version']; ?></td>
                                            <td><?= $oldR['islatest']; ?></td>
                                            <td><?= $oldR['dateuploaded']; ?></td>
                                            <td>
                                                <a class="btn btn-warning modaldownloadedit"
                                                   href="editmenu_modal.php?editmenu=<?php echo $oldR['idrelease']; ?>">EDIT <i
                                                        class="fa fa-edit"></i></a>
                                                <a class="btn btn-success"
                                                   href="download-edit.php?makelatest=<?php echo $oldR['idrelease']; ?>">Make Latest <i
                                                        class="fa fa-thumbs-up"></i></a>
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
            <button type="button" class="btn-lg btn-block btn-success text-white" data-toggle="modal" data-target="#newReleaseBox">Upload a new release  <i class="fa fa-check-square-o"></i>
            </button>
        </div><!--//app-wrapper-->
        <div class="modal fade" id="menuBox" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">

                </div>
            </div>
        </div>

        <div class="modal fade" id="newReleaseBox" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content bg-info text-white">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Upload a new release</h5>
                        <button type="button" class="close badge bg-danger" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">X</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="download-edit.php" method="post" name="newdownloadform">
                            <div class="form-group">
                                <label class="col-form-label " for="inputLarge">Release name (PeepoRun2D, RA1G Launcher, TBA)</label>
                                <input class="form-control " type="text" placeholder="Program name" id="downlInput" name="downlnameA" value="">
                            </div>
                            <div class="form-group">
                                <label class="col-form-label" for="inputLarge">File path</label>
                                <input class="form-control" type="text" placeholder="File path" id="menuInput" name="downlfilepathA" value="">
                            </div>
                            <div class="form-group">
                                <label class="col-form-label" for="inputLarge">Version</label>
                                <input class="form-control" type="text" placeholder="Release version"
                                       id="menuInput" name="downlverA" value="">
                            </div>
                            <form class="form-group">
                                <label class="col-form-label" for="inputLarge">Is this the latest release?</label>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="downlLatestRadio" id="downlLatestYes" value="Yes">
                                        This is the newest and latest release
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="downlLatestRadio" id="downlLatestNo" value="No" checked="">
                                        This is an old release.
                                    </label>
                                </div>
                            </form>
                            <div class="form-group">
                                <label class="col-form-label" for="inputLarge">Upload date</label>
                                <input class="form-control" type="text" placeholder="Write the upload date"
                                       id="menuInput" name="downldateA" value="">
                            </div>
                            <div class="modal-body">
                                <button type="submit" name="savenewrelease" class="btn btn-success btn-block">Upload new release <i
                                        class="fa fa-pencil"></i></button>
                                <button type="reset" class="btn btn-light btn-block">Reset <i class="fa fa-refresh"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <?php include_once("adminfooter.php"); ?>


<?php
include_once("adminheader.php");
require "../incl/config.php";
require "../incl/adminconfig.php";
$conn = new PDO($dsn, $username, $password, $options);
$resultsres = getResourcesRa1g($conn);
$failure = "";
$success = "";
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    try {
        if (isset($_GET['deleteimage'])) {
            $idfile = $_GET['deleteimage'];
            $sql1 = "SELECT * FROM resourcespage WHERE id = :idfile";
            $statement = $conn->prepare($sql1);
            $statement->bindParam(':idfile', $idfile);
            $statement->execute();
            $filetodel = $statement->fetch(PDO::FETCH_ASSOC);
            $i = $filetodel['res_filepath'];
            $unlink = unlink('../../resources/'.trim($i));
            if($unlink){
                $sql = "DELETE FROM resourcespage WHERE id = :idfile";
                $statement = $conn->prepare($sql);
                $statement->bindParam(':idfile', $idfile);
                $statement->execute();
                $success = "File successfully deleted! Refresh in 2 seconds.";
                echo('<meta http-equiv="refresh" content="2;url=resourcespage.php">');
            } else { $failure = "File not deleted!";}
        }
        if (isset($_GET['disableimage'])) {
            $idres = $_GET['disableimage'];
            $statement = $conn->prepare("UPDATE resourcespage SET res_disabled:='yes' WHERE id=:idres");
            $statement->bindParam(':idres', $idres, PDO::PARAM_INT);
            $statement->execute();
            $success = "File disabled! Refresh in 2 seconds.";
            echo('<meta http-equiv="refresh" content="2;url=resourcespage.php">');
        }
        if (isset($_GET['enableimage'])) {
            $idres = $_GET['enableimage'];
            $statement = $conn->prepare("UPDATE resourcespage SET res_disabled:='no' WHERE id=:idres");
            $statement->bindParam(':idres', $idres, PDO::PARAM_INT);
            $statement->execute();
            $success = "File enabled! Refresh in 2 seconds.";
            echo('<meta http-equiv="refresh" content="2;url=resourcespage.php">');
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
                    <h1 class="app-page-title mb-0">All files on RESOURCES.ra1g</h1>
                </div>
            </div><!--//row-->
            <div class="tab-content" id="orders-table-tab-content">
                <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
                    <div class="app-card app-card-orders-table shadow-lg mb-5">
                        <div class="app-card-body">
                            <div class="table-responsive-lg">
                                <table class="table table-dark table-striped text-left" id="resourcestable" >
                                    <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">File name</th>
                                        <th scope="col">File desc</th>
                                        <th scope="col">File path</th>
                                        <th scope="col">Category</th>
                                        <th scope="col">Date added</th>
                                        <th scope="col">User</th>
                                        <th scope="col">File size</th>
                                        <th scope="col">Image Dimensions</th>
                                        <th scope="col">Disabled?</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($resultsres as $key => $resultr) { ?>
                                        <tr class="font-weight-bolder text-warning">
                                            <td><?= $resultr['id']; ?></td>
                                            <td><?= $resultr['res_name']; ?></td>
                                            <td><?= $resultr['res_filepath']; ?></td>
                                            <td><?= $resultr['res_desc']; ?></td>
                                            <td><?= $resultr['res_cat']; ?></td>
                                            <td><?= $resultr['res_dateadded']; ?></td>
                                            <td><?= $resultr['res_user']; ?></td>
                                            <td><?= $resultr['res_filesize']; ?></td>
                                            <td><?= $resultr['res_imgdimensions']; ?></td>
                                            <td class="font-weight-bolder font-italic text-info text-uppercase"><?= $resultr['res_disabled']; ?></td>
                                            <td>
                                                <a class="btn btn-danger btn" onclick="return confirmSubmit()"
                                                   href="?deleteimage=<?php echo $resultr['id']; ?>">DELETE <i
                                                        class="fa fa-close"></i></a>
                                                <?php if($resultr['res_disabled'] == 'no'){ ?>
                                                <a class="btn btn-warning btn" onclick="return confirmSubmit()"
                                                   href="?disableimage=<?php echo $resultr['id']; ?>">DISABLE <i
                                                        class="fa fa-info-circle"></i></a>
                                                <?php } else {?>
                                                    <a class="btn btn-info btn" onclick="return confirmSubmit()"
                                                       href="?enableimage=<?php echo $resultr['id']; ?>">ENABLE <i
                                                                class="fa fa-check"></i></a>
                                                <?php } ?>
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
            <a role="button" href="https://resources.ra1g.eu" class="btn-lg btn-block btn-success text-white text-center">
                Go back to resources.ra1g.eu  <i class="fa fa-check-square-o"></i>
            </a>
        </div><!--//app-wrapper-->
    </div>
</div>

<?php include_once("adminfooter.php"); ?>


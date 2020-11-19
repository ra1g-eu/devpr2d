<?php
include_once("adminheader.php");
require "../incl/config.php";
require "../incl/imageconfig.php";
$connection = new PDO($dsn, $username, $password, $options);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        if (isset($_REQUEST['btnUploadImg'])) {
            $desc = $_REQUEST['imgtext'];
            $img = $_FILES['imgfile']['name'];
            $type = $_FILES['imgfile']['type'];
            $size = $_FILES['imgfile']['size'];
            $temp = $_FILES['imgfile']['tmp_name'];
            $path = "../imgs/" . $img;
            if ($type == "image/jpg" || $type == "image/png" || $type == "image/jpeg") {
                if (!file_exists($path)) {
                    if ($size < 512000) {
                        move_uploaded_file($temp, "../imgs/" . $img);
                        $sql = 'INSERT INTO imagegallery (name, file_path) VALUES (:fname, :ffile_path)';
                        $statement = $connection->prepare($sql);
                        $statement->bindParam(':fname', $desc);
                        $statement->bindParam(':ffile_path', $img);
                        $statement->execute();
                        $success = "File uploaded successfully! Refresh in 2 seconds.";
                        echo('<meta http-equiv="refresh" content="2;url=../adminpanel/image-edit.php">');
                    } else {
                        $failure = "File too big!";
                    }
                } else {
                    $failure = "File already exists! Use other name.";
                }
            } else {
                $failure = "Only JPG, PNG, JPEG allowed!";
            }
        }
        if (isset($_POST['btnDeleteImg'])) {
            $id = $_POST['idname'];
            $sql2 = "SELECT * FROM imagegallery WHERE idimage = :idimage";
            $statement = $connection->prepare($sql2);
            $statement->bindParam(':idimage', $id);
            $statement->execute();
            $imgtodel = $statement->fetch(PDO::FETCH_ASSOC);
            $i = $imgtodel['file_path'];
            $unlink = unlink('../imgs/'.trim($i));
            if($unlink){
                $sql = "DELETE FROM imagegallery WHERE idimage = :idimage";
                $statement = $connection->prepare($sql);
                $statement->bindParam(':idimage', $id);
                $statement->execute();
                $success = "Image successfully deleted! Refresh in 2 seconds.";
                echo('<meta http-equiv="refresh" content="2;url=../adminpanel/image-edit.php">');
            } else { $failure = "Image not deleted!";}
        }
    } catch (PDOException $error) {
        $failure = "<br>" . $error->getMessage();
    }
}
if (isset($_SESSION['userid']) && ($user->role) == 'admin') {
?>
    <div class="app-wrapper">

        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">
                <h1 class="app-page-title">Image Editor ->
                    <?php if ($updating) {
                        echo 'Updating file';
                    } else {
                        echo 'Upload New';
                    } ?>
                </h1>
                <!-- ALERTY PRE USPECH ALEBO FAIL START -->
                <?php if ($success != "") { ?>
                    <div class="alert alert-dismissible alert-success">
                        <button type="button" class="btn-close" data-dismiss="alert"></button>
                        <strong><?php echo $success; ?></strong>
                    </div>
                <?php } else if ($failure != "") { ?>
                    <div class="alert alert-dismissible alert-danger">
                        <button type="button" class="btn-close" data-dismiss="alert"></button>
                        <strong><?php echo $failure; ?></strong>
                    </div>
                <?php } else {
                } ?>
                <!-- ALERTY PRE USPECH ALEBO FAIL KONIEC -->
                <hr class="mb-4">
                <form action="image-edit.php" method="post" name="uploadimage" enctype="multipart/form-data">
                    <!-- FORM CLASS START -->
                    <div class="row g-4 settings-section">
                        <div class="col-12 col-md-4">
                            <h3 class="section-title">ID</h3>
                            <div class="section-intro">ID of a given image in the database. It is added
                                automatically.
                            </div>
                        </div>
                        <div class="col-12 col-md-8">
                            <div class="app-card app-card-settings shadow-sm p-4">
                                <div class="app-card-body">
                                    <div class="mb-3">
                                        <div class="card-body">
                                            <input type="text" class="form-control" name="idname" id="idnamef"
                                                   placeholder="ID" value="<?php if (!empty($imgloaded['idimage'])) {
                                                echo $imgloaded['idimage'];
                                            } else {
                                                echo 'ID';
                                            } ?>" readonly=""/>
                                        </div>
                                    </div>
                                </div><!--//app-card-body-->
                            </div><!--//app-card-->
                        </div>
                    </div><!--//row-->
                    <!-- FORM CLASS END -->
                    <hr class="my-4">
                    <!-- FORM CLASS START -->
                    <div class="row g-4 settings-section">
                        <div class="col-12 col-md-4">
                            <h3 class="section-title">Image description</h3>
                            <div class="section-intro">
                                A short description of the image.
                            </div>
                        </div>
                        <div class="col-12 col-md-8">
                            <div class="app-card app-card-settings shadow-sm p-4">
                                <div class="app-card-body">
                                    <div class="mb-3">
                                        <div class="card-body">
                                            <input type="text" class="form-control" name="imgtext" id="imgtextf"
                                                   placeholder="Enter text"
                                                   value="<?php if (!empty($imgloaded['name'])) {
                                                       echo $imgloaded['name'];
                                                   } ?>" required="required" pattern="[\s\S]*\S[\s\S]*" minlength="2"
                                                   maxlength="40"/>
                                        </div>
                                    </div>
                                </div><!--//app-card-body-->
                            </div><!--//app-card-->
                        </div>
                    </div><!--//row-->
                    <!-- FORM CLASS END -->
                    <hr class="my-4">
                    <!-- FORM CLASS START -->
                    <div class="row g-4 settings-section">
                        <div class="col-12 col-md-4">
                            <h3 class="section-title">Image file</h3>
                            <div class="section-intro">
                                Upload an image. Allowed types: <strong>.JPG .PNG</strong>
                                <p>Maximum size: <strong>512KB</strong></p>
                                <p>Upload path: <strong>/imgs/file.png</strong></p>
                            </div>
                        </div>
                        <div class="col-12 col-md-8">
                            <div class="app-card app-card-settings shadow-sm p-4">
                                <div class="app-card-body">
                                    <div class="mb-3">
                                        <div class="card-body">
                                            <label for="exampleInputFile">File input</label>
                                            <input type="file" class="form-control-file" id="imgfilef" name="imgfile"
                                                   accept=".png, .jpeg, .jpg">
                                        </div>
                                    </div>
                                </div><!--//app-card-body-->
                            </div><!--//app-card-->
                        </div>
                    </div><!--//row-->
                    <!-- FORM CLASS END -->
                    <hr class="my-4">
                    <?php if ($updating) { ?>
                        <button type="submit" class="btn-lg btn-info btn-block" name="btnUpdateImg">Update
                            image <i class="fa fa-pencil"></i></button>
                        <button type="submit" name="btnDeleteImg" onClick='return confirmSubmit()'
                                class="btn-lg btn-danger btn-block">Delete image <i class="fa fa-close"></i></button>
                    <?php } else { ?>
                        <button type="submit" class="btn-lg btn-success btn-block" name="btnUploadImg">Upload
                            new image <i class="fa fa-check-square-o"></i></button>
                    <?php } ?>
                    <a href="../images.php" class="btn-lg btn-secondary btn-block text-center">Go back <i
                                class="fa fa-sign-out"></i></a>
                </form>
                <hr class="my-4">
            </div><!--//container-fluid-->
        </div><!--//app-content-->
    </div><!--//app-wrapper-->
    <?php include_once("adminfooter.php");
} else {
    echo('<meta http-equiv="refresh" content="2;url=../">');
}
?>

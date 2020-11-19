<?php
include_once("session.php");
include_once("header.php");
require "incl/config.php";
$connection = new PDO($dsn, $username, $password, $options);
$success = "";
$failure = "";

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    try {
        if (isset($_GET['imagedelete'])) {
            $id = $_GET['imagedelete'];
            $sql2 = "SELECT * FROM imagegallery WHERE idimage = :idimage";
            $statement = $connection->prepare($sql2);
            $statement->bindParam(':idimage', $id);
            $statement->execute();
            $imgtodel = $statement->fetch(PDO::FETCH_ASSOC);
            $i = $imgtodel['file_path'];
            $unlink = unlink('imgs/'.trim($i));
            if($unlink){
                $sql = "DELETE FROM imagegallery WHERE idimage = :idimage";
                $statement = $connection->prepare($sql);
                $statement->bindParam(':idimage', $id);
                $statement->execute();
                $success = "Image successfully deleted! Refresh in 2 seconds.";
                echo('<meta http-equiv="refresh" content="2;url=images.php">');
            } else { $failure = "Image not deleted!";}
        }
    } catch (PDOException $error) {
        $failure = "<br>" . $error->getMessage();
    }
}
?>
<body>
<?php include_once("menu.php");
$imageitems = $app->getImageItems();
?>
<div class="container">
    <?php if (isset($_SESSION['userid']) && ($user->role) == 'admin') { ?>
        <a class="btn btn-primary btn-lg" style="float: right;" href="adminpanel/image-edit.php"><i
                    class="fa fa-page"></i>Add new</a>
    <?php } ?>
    <div class="jumbotron">
        <h1 class="display-5">Image Gallery</h1>
        <!-- ALERTY PRE USPECH ALEBO FAIL START -->
        <?php if ($success != "") { ?>
            <div class="alert alert-dismissible alert-success">
                <button type="button" class="btn" data-dismiss="alert">X</button>
                <strong><?php echo $success; ?></strong>
            </div>
        <?php } else if ($failure != "") { ?>
            <div class="alert alert-dismissible alert-danger">
                <button type="button" class="btn" data-dismiss="alert">X</button>
                <strong><?php echo $failure; ?></strong>
            </div>
        <?php } else {
        } ?>
        <!-- ALERTY PRE USPECH ALEBO FAIL KONIEC -->
        <script>
            $(document).ready(function () {
                $('.fancybox').fancybox();

            });
        </script>

        <div class="row">
            <?php foreach ($imageitems as $key => $imageitem) {
                ?>
                <div class="col-lg-4">
                    <div class="bs-component">
                        <div class="card border-secondary mb-3" style="max-width: 20rem;">
                            <div class="card-header"><?php echo $imageitem['name']; ?><?php if (isset($_SESSION['userid']) && ($user->role) == 'admin') { ?>
                                    <a href="adminpanel/image-edit.php?imageupdate=<?php echo $imageitem['idimage']; ?>" type="submit" class="btn btn-info btn-sm" style="float: right;"><i
                                                class="fa fa-pencil"></i></a>
                                    <a href="images.php?imagedelete=<?php echo $imageitem['idimage']; ?>"
                                       type="submit" onClick='return confirmSubmit()' class="btn btn-danger btn-sm"
                                       style="float: right;"><i class="fa fa-close"></i></a>
                                <?php } ?>
                            </div>
                            <a class="fancybox" href="imgs/<?php echo $imageitem['file_path']; ?>"
                               data-fancybox-group="gallery" title=""><img class="align-items-center" src="imgs/<?php echo $imageitem['file_path']; ?>"
                                                                           style="width:100%" alt=""/></a>
                        </div>
                    </div>
                </div>
            <?php } ?>


        </div>

    </div>
</div>
<?php include_once("footer.php"); ?>
</body>
</html>

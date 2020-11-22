<?php
include_once("session.php");
include_once("header.php");
require "incl/config.php";
?>
<?php include_once("menu.php");
$changelogitems = $app->getChangelogprItems();
$changelogRLitems = $app->getChangelogrlItems();
$changelogWEBitems = $app->getChangelogsiteItems();
$success = "";
$failure = "";
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['peeporundelete'])) {
        $connection = new PDO($dsn, $username, $password, $options);
        $id = $_GET['peeporundelete'];
        $sql = "DELETE FROM changelogpr WHERE id = :id";
        $statement = $connection->prepare($sql);
        $statement->bindValue(':id', $id);
        $statement->execute();
        $success = "PeepoRun2D changelog removed! Refresh in 2 seconds.";
        echo('<meta http-equiv="refresh" content="2;url=changelogs.php">');
    }
    if (isset($_GET['ra1glauncherdelete'])) {
        $connection = new PDO($dsn, $username, $password, $options);
        $id = $_GET['ra1glauncherdelete'];
        $sql = "DELETE FROM changelogrl WHERE id = :id";
        $statement = $connection->prepare($sql);
        $statement->bindValue(':id', $id);
        $statement->execute();
        $success = "Launcher changelog removed! Refresh in 2 seconds.";
        echo('<meta http-equiv="refresh" content="2;url=changelogs.php">');
    }
    if (isset($_GET['websitechangelogdelete'])) {
        $connection = new PDO($dsn, $username, $password, $options);
        $id = $_GET['websitechangelogdelete'];
        $sql = "DELETE FROM changelogwebsite WHERE id = :id";
        $statement = $connection->prepare($sql);
        $statement->bindValue(':id', $id);
        $statement->execute();
        $success = "Website changelog removed! Refresh in 2 seconds.";
        echo('<meta http-equiv="refresh" content="2;url=changelogs.php">');
    }
}
?>
<div class="jumbotron elegant-color text-white"">
    <h1 class="display-5">All available changelogs</h1>
<div class="my-5"></div>
<!-- ALERTY PRE USPECH ALEBO FAIL START -->
<?php if($success != ""){ ?>
    <div class="alert alert-dismissible alert-success">
        <button type="button" class="btn-close" data-dismiss="alert">X</button>
        <strong><?php echo $success; ?></strong>
    </div>
<?php } else if($failure !=""){?>
    <div class="alert alert-dismissible alert-danger">
        <button type="button" class="btn-close" data-dismiss="alert">X</button>
        <strong><?php echo $failure; ?></strong>
    </div>
<?php }?>
<!-- ALERTY PRE USPECH ALEBO FAIL KONIEC -->
<ul class="nav nav-tabs nav-fill md-tabs stylish-color-dark" id="changelogs" role="tablist">
    <li class="nav-item elegant-color-dark">
        <a class="nav-link active show" id="pr2dtab" data-toggle="tab" href="#peeporun2d" role="tab" aria-controls="peeporun2d"
           aria-selected="true">PeepoRun2D</a>
    </li>
    <li class="nav-item elegant-color-dark">
        <a class="nav-link" id="ra1gtab" data-toggle="tab" href="#ra1glauncher" role="tab" aria-controls="ra1glauncher"
           aria-selected="false">RA1G Launcher</a>
    </li>
    <li class="nav-item elegant-color-dark">
        <a class="nav-link" id="wwwtab" data-toggle="tab" href="#website" role="tab" aria-controls="website"
           aria-selected="false">Website</a>
    </li>
</ul>
<div class="tab-content pt-5" id="changelogstab">
    <div class="tab-pane fade active show" id="peeporun2d" role="tabpanel" aria-labelledby="peeporun2d">
        <h3 class="display-5">PeepoRun2D</h3>
        <?php if (isset($_SESSION['userid']) && ($user->role) == 'admin') { ?>
            <a class="btn btn-primary btn-lg" style="float: right;" href="adminpanel/cl-edit.php">Add new</a>
        <?php } ?>
        <div class="changelog">
            <div class="wrapper">
                <?php foreach ($changelogitems as $key => $changelogitem) {
                    ?>
                    <div class="changelog__item">
                        <div class="changelog__meta">
                            <?php if (isset($_SESSION['userid']) && ($user->role) == 'admin') { ?>

                                <a href="adminpanel/cl-edit.php?peeporun=<?php echo $changelogitem['id']; ?>" type="submit"
                                   name="btnUpdatePR" class="btn btn-info btn-sm" style="float: right;"><i
                                            class="fas fa-edit fa-2x"></i></a>
                                <a href="changelogs.php?peeporundelete=<?php echo $changelogitem['id']; ?>" type="submit"
                                   onClick='return confirmSubmit()' name="btnDeletePR" class="btn btn-danger btn-sm"
                                   style="float: right;"><i class="fas fa-window-close fa-2x"></i></a>

                            <?php } ?>
                            <h4 class="changelog__title" id="chversion"><span
                                        class="badge badge-info">v<?php echo $changelogitem['version']; ?></span></h4>
                            <h5 class="changelog__date" id="chdate"><span
                                        class="badge badge-dark"><?php echo $changelogitem['date']; ?></span></h5>
                        </div>
                        <div class="changelog__detail" id="chtext">
                            <?php echo $changelogitem['text']; ?>
                        </div>
                    </div>
                    <hr class="my-4">
                <?php } ?>
            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="ra1glauncher" role="tabpanel" aria-labelledby="ra1glauncher">
        <h3 class="display-5">RA1G Launcher</h3>
        <?php if (isset($_SESSION['userid']) && ($user->role) == 'admin') { ?>
            <a class="btn btn-primary btn-lg" style="float: right;" href="adminpanel/cl-edit.php">Add new</a>
        <?php } ?>
        <div class="changelog">
            <div class="wrapper">
                <?php foreach ($changelogRLitems as $key => $changelogRLitem) {
                    ?>
                    <div class="changelog__item">
                        <div class="changelog__meta">
                            <?php if (isset($_SESSION['userid']) && ($user->role) == 'admin') { ?>
                                <a href="adminpanel/cl-edit.php?ra1glauncher=<?php echo $changelogRLitem['id']; ?>"
                                   type="submit" class="btn btn-info btn-sm" style="float: right;"><i
                                            class="fas fa-edit fa-2x"></i></a>
                                <a href="changelogs.php?ra1glauncherdelete=<?php echo $changelogRLitem['id']; ?>"
                                   type="submit" onClick='return confirmSubmit()' class="btn btn-danger btn-sm" style="float: right;"><i
                                            class="fas fa-window-close fa-2x"></i></a>
                            <?php } ?>
                            <h4 class="changelog__title" id="chversion"><span
                                        class="badge badge-info">v<?php echo $changelogRLitem['version']; ?></span></h4>
                            <h5 class="changelog__date" id="chdate"><span
                                        class="badge badge-dark"><?php echo $changelogRLitem['date']; ?></span></h5>
                        </div>
                        <div class="changelog__detail">
                            <?php echo $changelogRLitem['text']; ?>
                        </div>
                    </div>
                    <hr class="my-4">
                <?php } ?>
            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="website" role="tabpanel" aria-labelledby="website">
        <h3 class="display-5">Website</h3>
        <?php if (isset($_SESSION['userid']) && ($user->role) == 'admin') { ?>
            <a class="btn btn-primary btn-lg" style="float: right;" href="adminpanel/cl-edit.php">Add new</a>
        <?php } ?>
        <div class="changelog">
            <div class="wrapper">
                <?php foreach ($changelogWEBitems as $key => $changelogWEBitem) {
                    ?>
                    <div class="changelog__item">
                        <div class="changelog__meta">
                            <?php if (isset($_SESSION['userid']) && ($user->role) == 'admin') { ?>
                                <a href="adminpanel/cl-edit.php?websitechangelog=<?php echo $changelogWEBitem['id']; ?>"
                                   type="submit"  class="btn btn-info btn-sm" style="float: right;"><i
                                            class="fas fa-edit fa-2x"></i></a>
                                <a href="changelogs.php?websitechangelogdelete=<?php echo $changelogWEBitem['id']; ?>"
                                   type="submit" onClick='return confirmSubmit()'
                                   class="btn btn-danger btn-sm" style="float: right;"><i class="fas fa-window-close fa-2x"></i></a>
                            <?php } ?>
                            <h4 class="changelog__title" id="chversion"><span
                                        class="badge badge-info">v<?php echo $changelogWEBitem['version']; ?></span></h4>
                            <h5 class="changelog__date" id="chdate"><span
                                        class="badge badge-dark"><?php echo $changelogWEBitem['date']; ?></span></h5>
                        </div>
                        <div class="changelog__detail">
                            <?php echo $changelogWEBitem['text']; ?>
                        </div>
                    </div>
                    <hr class="my-4">
                <?php } ?>
            </div>
        </div>
    </div>
</div>

</div>
<?php include_once("footer.php"); ?>
</body>
</html>

<?php
include_once("session.php");
$title = "changelogs";
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
<div class="container py-2">
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
<?php } else {} ?>
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
        <h3 class="display-5">PeepoRun2D
            <?php if (isset($_SESSION['userid']) && ($user->role) == 'admin') { ?>
                <a class="btn btn-primary btn" href="adminpanel/cl-edit.php">Add new</a>
            <?php } ?>
        </h3>
        <hr class="my-4 invisible">
        <div class="accordion module-accordion" id="module-accordion">
            <?php foreach ($changelogitems as $key => $changelogitem) {
            ?>
            <div class="module-item card elegant-color-dark text-white">
                <div class="module-header card-header" id="module-heading-1">
                    <h4 class="module-title mb-0">
                        <a class="card-toggle module-toggle" style="letter-spacing: 3px;" href="#pr<?php echo $link = preg_replace('/\D/', '', $changelogitem['version']); ?>" data-toggle="collapse" data-target="#pr<?php echo $link = preg_replace('/\D/', '', $changelogitem['version']); ?>" aria-expanded="true" aria-controls="pr<?php echo $link = preg_replace('/\D/', '', $changelogitem['version']); ?>">
                            <i class="module-toggle-icon fas fa-plus mr-2"></i>
                            v<?php echo  $changelogitem['version']; ?> <span class="badge font-small align-middle mx-2 bg-primary"><?php echo $changelogitem['date']; ?></span>
                        </a>
                        <?php if (isset($_SESSION['userid']) && ($user->role) == 'admin') { ?>
                            <a href="adminpanel/cl-edit.php?peeporun=<?php echo $changelogitem['id']; ?>"
                               class="btn btn-info btn-sm" style="float: right;"><i
                                        class="fas fa-edit"></i></a>
                            <a href="changelogs.php?peeporundelete=<?php echo $changelogitem['id']; ?>"
                               onClick='return confirmSubmit()' class="btn btn-danger btn-sm"
                               style="float: right;"><i class="fas fa-window-close"></i></a>
                        <?php } ?>
                    </h4>
                </div><!--//card-header-->
                <div id="pr<?php echo $link = preg_replace('/\D/', '', $changelogitem['version']); ?>" class="module-content collapse" aria-labelledby="module-heading-1" >
                    <div class="card-body p-0">
                        <div class="module-sub-item p-3">
                            <div class="row justify-content-between">
                                <ul>
                                    <?php echo $changelogitem['text']; ?>
                                </ul>
                            </div>
                        </div><!--//card-body-->
                    </div><!--//module-content-->
                </div><!--//module-accordion-->
            </div>
            <?php } ?>
        </div>
    </div>
    <div class="tab-pane fade" id="ra1glauncher" role="tabpanel" aria-labelledby="ra1glauncher">
        <h3 class="display-5">RA1G launcher
            <?php if (isset($_SESSION['userid']) && ($user->role) == 'admin') { ?>
                <a class="btn btn-primary btn" href="adminpanel/cl-edit.php">Add new</a>
            <?php } ?>
        </h3>
        <hr class="my-4 invisible">
        <div class="accordion module-accordion" id="module-accordion">
            <?php foreach ($changelogRLitems as $key => $changelogRLitem) {
                ?>
                <div class="module-item card elegant-color-dark text-white">
                    <div class="module-header card-header" id="module-heading-1">
                        <h4 class="module-title mb-0">
                            <a class="card-toggle module-toggle" style="letter-spacing: 3px;" href="#rl<?php echo $link = preg_replace('/\D/', '', $changelogRLitem['version']); ?>" data-toggle="collapse" data-target="#rl<?php echo $link = preg_replace('/\D/', '', $changelogRLitem['version']); ?>" aria-expanded="true" aria-controls="rl<?php echo $link = preg_replace('/\D/', '', $changelogRLitem['version']); ?>">
                                <i class="module-toggle-icon fas fa-plus mr-2"></i>
                                v<?php echo  $changelogRLitem['version']; ?> <span class="badge font-small align-middle mx-2 bg-primary"><?php echo $changelogRLitem['date']; ?></span>
                            </a>
                            <?php if (isset($_SESSION['userid']) && ($user->role) == 'admin') { ?>
                                <a href="adminpanel/cl-edit.php?ra1glauncher=<?php echo $changelogRLitem['id']; ?>"
                                   class="btn btn-info btn-sm" style="float: right;"><i
                                            class="fas fa-edit"></i></a>
                                <a href="changelogs.php?ra1glauncherdelete=<?php echo $changelogRLitem['id']; ?>"
                                   onClick='return confirmSubmit()' class="btn btn-danger btn-sm"
                                   style="float: right;"><i class="fas fa-window-close"></i></a>
                            <?php } ?>
                        </h4>
                    </div><!--//card-header-->
                    <div id="rl<?php echo $link = preg_replace('/\D/', '', $changelogRLitem['version']); ?>" class="module-content collapse" aria-labelledby="module-heading-1" >
                        <div class="card-body p-0">
                            <div class="module-sub-item p-3">
                                <div class="row justify-content-between">
                                    <ul>
                                        <?php echo $changelogRLitem['text']; ?>
                                    </ul>
                                </div>
                            </div><!--//card-body-->
                        </div><!--//module-content-->
                    </div><!--//module-accordion-->
                </div>
            <?php } ?>
        </div>
    </div>
    <div class="tab-pane fade" id="website" role="tabpanel" aria-labelledby="website">
        <h3 class="display-5">Website
            <?php if (isset($_SESSION['userid']) && ($user->role) == 'admin') { ?>
                <a class="btn btn-primary btn" href="adminpanel/cl-edit.php">Add new</a>
            <?php } ?>
        </h3>
        <hr class="my-4 invisible">
        <div class="accordion module-accordion" id="module-accordion">
            <?php foreach ($changelogWEBitems as $key => $changelogWEBitem) {
                ?>
                <div class="module-item card elegant-color-dark text-white">
                    <div class="module-header card-header" id="module-heading-1">
                        <h4 class="module-title mb-0">
                            <a class="card-toggle module-toggle" style="letter-spacing: 3px;" href="#web<?php echo $link = preg_replace('/\D/', '', $changelogWEBitem['version']); ?>" data-toggle="collapse" data-target="#web<?php echo $link = preg_replace('/\D/', '', $changelogWEBitem['version']); ?>" aria-expanded="true" aria-controls="web<?php echo $link = preg_replace('/\D/', '', $changelogWEBitem['version']); ?>">
                                <i class="module-toggle-icon fas fa-plus mr-2"></i>
                                v<?php echo  $changelogWEBitem['version']; ?> <span class="badge font-small align-middle mx-2 bg-primary"><?php echo $changelogWEBitem['date']; ?></span>
                            </a>
                            <?php if (isset($_SESSION['userid']) && ($user->role) == 'admin') { ?>
                                <a href="adminpanel/cl-edit.php?websitechangelog=<?php echo $changelogWEBitem['id']; ?>"
                                   class="btn btn-info btn-sm" style="float: right;"><i
                                            class="fas fa-edit"></i></a>
                                <a href="changelogs.php?websitechangelogdelete=<?php echo $changelogWEBitem['id']; ?>"
                                   onClick='return confirmSubmit()' class="btn btn-danger btn-sm"
                                   style="float: right;"><i class="fas fa-window-close"></i></a>
                            <?php } ?>
                        </h4>
                    </div><!--//card-header-->
                    <div id="web<?php echo $link = preg_replace('/\D/', '', $changelogWEBitem['version']); ?>" class="module-content collapse" aria-labelledby="module-heading-1" >
                        <div class="card-body p-0">
                            <div class="module-sub-item p-3">
                                <div class="row justify-content-between">
                                    <ul>
                                        <?php echo $changelogWEBitem['text']; ?>
                                    </ul>
                                </div>
                            </div><!--//card-body-->
                        </div><!--//module-content-->
                    </div><!--//module-accordion-->
                </div>
            <?php } ?>
        </div>
    </div>
</div>
</div>
</div>
<?php include_once("footer.php"); ?>
</body>
</html>

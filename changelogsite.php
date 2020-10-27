<!doctype html>
<html>
<head>

    <?php
    include_once ("header.php");
    require "config.php";
    ?>

</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <?php include_once ("menu.php");
    $changelogitems = $db->getChangelogsiteItems();
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $success = "";
        $failure = "";
        if (isset($_GET['websitechangelogdelete'])) {
            $connection = new PDO($dsn, $username, $password, $options);
            $id = $_GET['websitechangelogdelete'];
            $sql = "DELETE FROM changelogwebsite WHERE id = :id";
            $statement = $connection->prepare($sql);
            $statement->bindValue(':id', $id);
            $statement->execute();
            $success = "Changelog deleted!";
        }else {

        }
    }
    ?>
</nav>

<div class="jumbotron">
    <h1 class="display-5">Changelog Website</h1>
    <?php include_once ("modal.php"); ?>
    <?php if(isset($_SESSION['id']) && ($user->role) == 'admin'){ ?>
        <a class="btn btn-primary btn-lg" style="float: right;" href="changelogeditor.php"><i class="fa fa-page"></i>Add new</a>
    <?php } ?>
    <?php if(isset($_GET['notify']) && $_GET['notify']) {
        $message = "You've been logged out!";
        ?>
    <?php } ?>
    <div class="changelog">
        <div class="wrapper">
            <?php foreach($changelogitems as $key => $changelogitem){
                ?>
                <div class="changelog__item">
                    <div class="changelog__meta">
                        <?php if(isset($_SESSION['id']) && ($user->role) == 'admin'){ ?>
                            <a href="changelogeditor.php?websitechangelog=<?php echo $changelogitem['id']; ?>" type="submit" name="btnUpdateWEB" class="btn btn-info btn-sm" style="float: right;"><i class="fa fa-pencil"></i></a>
                            <a href="changelogpr.php?websitechangelogdelete=<?php echo $changelogitem['id']; ?>" type="submit" name="btnDeleteWEB" class="btn btn-danger btn-sm" style="float: right;"><i class="fa fa-close"></i></a>
                        <?php }?>
                        <h4 class="changelog__title"><?php echo $changelogitem['version']; ?></h4>
                        <small class="changelog__date"><?php echo $changelogitem['date']; ?></small>
                    </div>
                    <div class="changelog__detail">
                        <ul>
                            <?php echo $changelogitem['text']; ?>
                        </ul>
                    </div>
                </div>
                <hr class="my-4">
            <?php } ?>
        </div>
    </div>
</div>



</body>
</html>

<!doctype html>
<html>
<head>

    <?php
    include_once("header.php");
    require "incl/config.php";
    ?>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <?php include_once("menu.php");
    $changelogitems = $db->getChangelogprItems();
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $success = "";
        $failure = "";
        if (isset($_GET['peeporundelete'])) {
            $connection = new PDO($dsn, $username, $password, $options);
            $id = $_GET['peeporundelete'];
            $sql = "DELETE FROM changelogpr WHERE id = :id";
            $statement = $connection->prepare($sql);
            $statement->bindValue(':id', $id);
            $statement->execute();
            $success = "Changelog deleted!";
            header("refresh:2;url=changelogpr.php");
        }
    }
        ?>
</nav>
<div class="jumbotron">
    <h1 class="display-5">Changelog PeepoRun2D</h1>
    <?php include_once("incl/modal.php"); ?>
    <?php if(isset($_SESSION['id']) && ($user->role) == 'admin'){ ?>
        <a class="btn btn-primary btn-lg" style="float: right;" href="changelogeditor.php"><i class="fa fa-page"></i>Add new</a>
    <?php } ?>
    <div class="changelog">
        <div class="wrapper">
            <?php foreach($changelogitems as $key => $changelogitem){
                ?>
                <div class="changelog__item">
                    <div class="changelog__meta">
                        <?php if(isset($_SESSION['id']) && ($user->role) == 'admin'){ ?>

                            <a href="changelogeditor.php?peeporun=<?php echo $changelogitem['id']; ?>" type="submit" name="btnUpdatePR" class="btn btn-info btn-sm" style="float: right;"><i class="fa fa-pencil"></i></a>
                            <a href="changelogpr.php?peeporundelete=<?php echo $changelogitem['id']; ?>" type="submit" onClick='return confirmSubmit()' name="btnDeletePR" class="btn btn-danger btn-sm" style="float: right;"><i class="fa fa-close"></i></a>

                        <?php }?>
                        <h4 class="changelog__title" id="chversion"><span class="badge badge-info">v<?php echo $changelogitem['version']; ?></span></h4>
                        <h5 class="changelog__date" id="chdate"><span class="badge badge-dark"><?php echo $changelogitem['date']; ?></span></h5>
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
<?php include_once("footer.php"); ?>
</body>
</html>

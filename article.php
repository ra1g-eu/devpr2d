<!doctype html>
<html>
<head>

    <?php include_once("header.php");
    require "incl/config.php";
    require "incl/newsconfig.php";?>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <?php include_once("menu.php");
    ?>
</nav>
<div class="container">
    <?php if (isset($_SESSION['id']) && ($user->role) == 'admin') { ?>
        <a class="btn btn-primary btn-lg" style="float: right;" href="newseditor.php"><i class="fa fa-page"></i>Add new</a>
    <?php } ?>
    <div class="jumbotron">
        <?php        ?>
        <?php if (isset($_SESSION['id']) && ($user->role) == 'admin') { ?>
        <?php } ?>
        <?php
        $failure = "";
        $success = "";
        $connection = new PDO($dsn, $username, $password, $options); // function created in dbconnect, remember?

        $id_article = (int)$_GET['newsid'];

        if ( !empty($id_article) && $id_article > 0) {
            $article = getAnArticle( $id_article, $connection );
            $article = $article[0];
        }else{
            $article = false;
            $failure = "Wrong article";
            $success = "";
            header("refresh:2;url=index.php");
        }
        include_once("incl/modal.php");
        ?>

        <?php if ( $article && !empty($article) ) :?>
        <div class="jumbotron">
            <h1 class="display-5" id="newstitle"><?= stripslashes($article['news_title']); ?></h1>
            <h4 class="changelog__title" id="newsauthor"><span class="badge badge-info">Author: <?= stripslashes($article['news_author']); ?></span></h4>
            <h5 class="changelog__date" id="newsdate"><span class="badge badge-dark"><?= $article['news_published_on'];?></span></h5>
            <br class="lead mb-lg-1">
                <?= $article['news_full_content']; ?>
            </br>

            Category: <a href="#" class="text-success"><?=stripslashes($article['news_category']); ?></a>
            <?php if(isset($_SESSION['id']) && ($user->role) == 'admin'){ ?>
            <a href="newseditor.php?newseditid=<?php echo $article['news_id']; ?>" type="submit"  class="btn btn-info btn-sm"
               style="float: right;">Edit <i class="fa fa-pencil"></i></a>
            <a href="newseditor.php?newsiddel=<?php echo $article['news_id']; ?>" type="submit" onClick='return confirmSubmit()'
               class="btn btn-danger btn-sm" style="float: right;">Delete <i class="fa fa-close"></i></a>
            <?php } ?>
        </div>
        <?php else:?>

        <?php endif?>
        <?php ?>
    </div>
</div>
<div class="container">
    <div class="jumbotron">
        <h1 class="display-5">Comments</h1>
    </div>
</div>
<?php include_once("footer.php"); ?>
</body>
</html>

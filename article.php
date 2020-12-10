<?php
include_once("session.php");
$title = "article";
include_once("header.php");
require "incl/config.php";
require "incl/newsconfig.php"; ?>
<?php include_once("menu.php");
?>
<div class="container-fluid w-75">
    <?php if (isset($_SESSION['userid']) && ($user->role) == 'admin') { ?>
        <a class="btn btn-primary btn-lg" style="float: right;" href="adminpanel/news-edit.php">Add new</a>
    <?php } ?>
    <div class="jumbotron elegant-color text-white">
        <?php ?>
        <?php if (isset($_SESSION['userid']) && ($user->role) == 'admin') { ?>
        <?php } ?>
        <?php
        $failure = "";
        $success = "";
        $connection = new PDO($dsn, $username, $password, $options); // function created in dbconnect, remember?

        $id_article = (int)$_GET['newsid'];

        if (!empty($id_article) && $id_article > 0) {
            $article = getAnArticle($id_article, $connection);
            $article = $article[0];
        } else {
            $article = false;
            $failure = "Wrong article";
            $success = "";
            header("refresh:2;url=index.php");
        }
        ?>

        <?php if ($article && !empty($article)) : ?>
            <div class="jumbotron elegant-color text-white shadow-lg">
                <h1 class="display-5 text-center font-weight-bold" id="newstitle"><?= stripslashes($article['news_title']); ?></h1>
                <h4 class="changelog__title text-center" id="newsauthor"><span
                            class="badge unique-color"><?= stripslashes($article['news_author']); ?> | <?= $article['news_published_on']; ?></span></h4>
                <hr class="py-3 invisible">
                    <?= $article['news_full_content']; ?>
                <hr class="my-5 invisible">
                <hr class="unique-color">
                Category: <a href="newscat.php?nc=<?= stripslashes($article['news_category']); ?>"
                             class="text-success"><?= stripslashes($article['news_category']); ?></a>
                <?php if (isset($_SESSION['userid']) && ($user->role) == 'admin') { ?>
                    <a href="adminpanel/news-edit.php?newseditid=<?php echo $article['news_id']; ?>" type="submit"
                       class="btn btn-info btn-sm"
                       style="float: right;"><i class="fas fa-edit fa-2x"></i></a>
                    <a href="adminpanel/news-edit.php?newsiddel=<?php echo $article['news_id']; ?>" type="submit"
                       onClick='return confirmSubmit()'
                       class="btn btn-danger btn-sm" style="float: right;"><i class="fas fa-window-close fa-2x"></i></a>
                <?php } ?>
            </div>
        <?php else: ?>

        <?php endif ?>
        <?php ?>
    </div>
</div>
<div class="container">
    <div class="jumbotron elegant-color text-white"">
        <h1 class="display-5">Comments</h1>
    </div>
</div>
<?php include_once("footer.php"); ?>
</body>
</html>

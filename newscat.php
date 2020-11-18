<?php
include_once("session.php");
include_once("header.php");
require "incl/config.php";
require "incl/newsconfig.php"; ?>
<body>
<?php include_once("menu.php");
?>
<?php
$connection = new PDO($dsn, $username, $password, $options);
$ncisset = false;
if (isset($_GET['nc'])) {
    $catname = $_GET['nc'];
    $ncisset = true;
    $news = getNewsCategory($catname, $connection);
} else {
    $news = fetchNews($connection);
    $ncisset = false;
}
?>
<div class="container">
    <?php if (isset($_SESSION['userid']) && ($user->role) == 'admin') { ?>
        <a class="btn btn-primary btn-lg" style="float: right;" href="newseditor.php"><i class="fa fa-page"></i>Add new</a>
    <?php } ?>
    <div class="jumbotron">
        <h1 class="display-5">News <?php if ($ncisset) { ?>category: <span
                    class="badge-success"><?= $catname ?></span> <?php } ?></h1>
        <hr class="my-4">
        <?php //include_once("incl/modal.php"); ?>
        <div class="changelog">
            <div class="wrapper">
                <?php if ($news && !empty($news)) : ?>
                    <?php foreach ($news as $key => $article) : ?>
                        <div class="alert alert-secondary mb-lg-5">
                            <h3><a class=""
                                   href="article.php?newsid=<?= $article['news_id']; ?>"><?= stripslashes($article['news_title']); ?></a>
                            </h3>
                            <h6>
                                <span class="badge-light"><?= $article['news_published_on']; ?> - <?= stripslashes($article['news_author']); ?> - <a
                                            href="newscat.php?nc=<?= stripslashes($article['news_category']); ?>"
                                            class="text-success"><?= stripslashes($article['news_category']); ?></a></span>
                            </h6>
                            <br>
                            <p class="lead"><?= stripslashes($article['news_short_description']); ?></p>
                            <?php if (isset($_SESSION['userid']) && ($user->role) == 'admin') { ?>
                                <a href="newseditor.php?newseditid=<?= $article['news_id']; ?>" type="submit"
                                   class="btn btn-info btn-sm" style="float: right;">EDIT <i
                                            class="fa fa-pencil"></i></a>
                                <a href="newseditor.php?newsiddel=<?= $article['news_id']; ?>" type="submit"
                                   onClick='return confirmSubmit()' class="btn btn-danger btn-sm" style="float: right;">DELETE
                                    <i class="fa fa-close"></i></a>
                            <?php } ?>
                        </div>
                        <hr class="my-lg-5">
                    <?php endforeach ?>
                <?php endif ?>
            </div>
        </div>
    </div>
</div>
<?php include_once("footer.php"); ?>
</body>
</html>

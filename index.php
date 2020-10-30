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
      <?php if(isset($_SESSION['id']) && ($user->role) == 'admin'){ ?>
          <a class="btn btn-primary btn-lg" style="float: right;" href="newseditor.php"><i class="fa fa-page"></i>Add new</a>
      <?php } ?>
  <div class="jumbotron">
      <h1 class="display-5">All news</h1>
      <hr class="my-4">
      <?php //include_once("incl/modal.php"); ?>
      <div class="changelog">
          <div class="wrapper">
              <?php
              // get the database handler
              $connection = new PDO($dsn, $username, $password, $options); // function created in dbconnect, remember?
              // Fecth news
              $news = fetchNews($connection);
              ?>
              <?php if ( $news && !empty($news) ) :?>
                  <?php foreach ($news as $key => $article) :?>
              <div class="alert alert-secondary mb-lg-5">
                              <h3><a class="" href="article.php?newsid=<?= $article['news_id']; ?>"><?= stripslashes($article['news_title']); ?></a></h3>
                              <h6 ><span class="badge-primary"><?=$article['news_published_on']; ?> - <?= stripslashes($article['news_author']); ?> - Category: <a href="#" class="text-success"><?=stripslashes($article['news_category']); ?></a></span></h6>
                              <br>
                              <p class="lead"><?= stripslashes($article['news_short_description']); ?></p>
                  <?php if(isset($_SESSION['id']) && ($user->role) == 'admin'){ ?>
                      <a href="newseditor.php?newseditid=<?php echo $article['news_id']; ?>" type="submit" name="btnUpdatePR" class="btn btn-info btn-sm" style="float: right;">EDIT <i class="fa fa-pencil"></i></a>
                      <a href="newseditor.php?iddelete=<?php echo $article['news_id']; ?>" type="submit" onClick='return confirmSubmit()' name="btnDeletePR" class="btn btn-danger btn-sm" style="float: right;">DELETE <i class="fa fa-close"></i></a>
                  <?php } ?>
              </div>
                      <hr class="my-lg-5">
                  <?php endforeach?>
              <?php endif ?>
          </div>
      </div>
  </div>
</div>
  <?php include_once("footer.php"); ?>
  </body>
  </html>

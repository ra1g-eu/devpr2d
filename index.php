<?php include_once ("session.php"); ?>
<!doctype html>
<html>
  <head>

<?php include_once("header.php");
require "incl/config.php";
?>
  </head>
  <body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <?php include_once("menu.php");
      ?>
</nav>
  <div class="container">

  <div class="jumbotron">
      <h1 class="display-5">Welcome to ra1g's developer page!</h1>
      <hr class="my-4">
      <?php //include_once("incl/modal.php"); ?>
      <div class="changelog">
          <div class="wrapper">

          </div>
      </div>
  </div>
</div>
  <?php include_once("footer.php"); ?>
  </body>
  </html>

<!doctype html>
<html>
  <head>

<?php include_once ("header.php"); ?>
	    </head>
  <body>

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <?php include_once ("menu.php");
      ?>
</nav>
  <div class="jumbotron">
  <h1 class="display-5">Welcome to DEVPR2D</h1>
      <?php if(isset($_GET['notify']) && $_GET['notify']) {
        $message = "You've been logged out!";
      ?>
      <script>
          $(function() {
              $('#myModal').modal('show');
          });
      </script>
          <div class="modal fade" id="myModal" role="dialog">
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h4 class="modal-title"><?php echo $message ?></h4>
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      </div>
                  </div>
              </div>
          </div>

      <?php } ?>

</div>
  <?php include_once ("footer.php"); ?>
  </body>
  </html>

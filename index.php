<!doctype html>
<html>
  <head>

<?php
include_once ("header.php"); ?>
	    </head>
  <body>

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <?php include_once ("menu.php");
      $changelogitems = $db->getChangelogprItems();
      ?>
</nav>
  
  <div class="jumbotron">
  <h1 class="display-5">Changelog PeepoRun2D</h1>
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
  <div class="changelog">
      <div class="wrapper">
          <?php foreach($changelogitems as $key => $changelogitem){
          ?>
        <div class="changelog__item">
          <div class="changelog__meta">
              <?php if(isset($_SESSION['id']) && ($user->role) == 'admin'){ ?>
                  <button type="button" class="btn btn-info btn-sm" style="float: right;"><i class="fa fa-pencil"></i></button>
                  <button type="button" class="btn btn-danger btn-sm" style="float: right;"><i class="fa fa-close"></i></button>
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

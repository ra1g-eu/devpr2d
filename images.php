<!doctype html>
<html>
  <head>
<?php include_once("header.php"); ?>
	    </head>
  <body>

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <?php include_once("menu.php");
      $imageitems = $app->getImageItems();
      ?>
</nav>
<div class="container">
    <?php if(isset($_SESSION['id']) && ($user->role) == 'admin'){ ?>
        <a class="btn btn-primary btn-lg" style="float: right;" href="imageditor.php?image=<?php echo 'IMGADD'; ?>"><i class="fa fa-page"></i>Add new</a>
    <?php } ?>
<div class="jumbotron">
  <h1 class="display-5">Image Gallery</h1>
	  <script>
$(document).ready(function() {
$('.fancybox').fancybox();

});
</script>

<div class="row">
    <?php foreach($imageitems as $key => $imageitem){
    ?>
	<div class="col-lg-4">
        <div class="bs-component">
			<div class="card border-secondary mb-3" style="max-width: 20rem;">
			<div class="card-header"><?php echo $imageitem['name']; ?><?php if(isset($_SESSION['id']) && ($user->role) == 'admin'){ ?>
                    <a href="imageeditor.php?image=<?php echo $imageitem['idimage']; ?>" type="submit" name="btnUpdateIMG" class="btn btn-info btn-sm" style="float: right;"><i class="fa fa-pencil"></i></a>
                    <a href="imageeditor.php?imagedelete=<?php echo $imageitem['idimage']; ?>" type="submit" name="btnDeleteIMG" class="btn btn-danger btn-sm" style="float: right;"><i class="fa fa-close"></i></a>
                <?php }?>
            </div>
			<a class="fancybox" href="<?php echo $imageitem['file_path']; ?>" data-fancybox-group="gallery" title=""><img src="<?php echo $imageitem['file_path']; ?>"  style="width:100%" alt="" /></a>
			</div>
		</div>
    </div>
    <?php } ?>


</div>

</div>
</div>
  <?php include_once("footer.php"); ?>
  </body>
  </html>

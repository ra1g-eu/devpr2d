<!doctype html>
<html>
  <head>
<?php include_once ("header.php"); ?>
	    </head>
  <body>

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <?php include_once ("menu.php"); ?>
</nav>

<div class="container">
<div class="jumbotron">
  <h1 class="display-5">Image Gallery</h1>

	  <script>
$(document).ready(function() {
$('.fancybox').fancybox();

});
</script>

<div class="row">
	<div class="col-lg-4">
        <div class="bs-component">
			<div class="card border-secondary mb-3" style="max-width: 20rem;">
			<div class="card-header">RA1G Launcher <button type="button" class="btn btn-danger btn-sm" style="float: right;">X</button></div>
			<a class="fancybox" href="imgs/ra1gL1.png" data-fancybox-group="gallery" title=""><img src="imgs/ra1gL1.png"  style="width:100%" alt="" /></a>
			</div>
		</div>
    </div>
  
  	<div class="col-lg-4">
		<div class="bs-component">  
			<div class="card border-secondary mb-3" style="max-width: 20rem;">
			<div class="card-header">PR2D Main menu</div>
			<a class="fancybox" href="imgs/pr2d1.png" data-fancybox-group="gallery" title=""><img src="imgs/pr2d1.png"  style="width:100%" alt="" /></a>
			</div>
		</div>
    </div>
	  	<div class="col-lg-4">
		<div class="bs-component">  
			<div class="card border-secondary mb-3" style="max-width: 20rem;">
			<div class="card-header">PR2D Select level</div>
			<a class="fancybox" href="imgs/pr2d2.png" data-fancybox-group="gallery" title=""><img src="imgs/pr2d2.png"  style="width:100%" alt="" /></a>
			</div>
		</div>
    </div>
	  	<div class="col-lg-4">
		<div class="bs-component">  
			<div class="card border-secondary mb-3" style="max-width: 20rem;">
			<div class="card-header">PR2D How to play</div>
			<a class="fancybox" href="imgs/pr2d3.png" data-fancybox-group="gallery" title=""><img src="imgs/pr2d3.png"  style="width:100%" alt="" /></a>
			</div>
		</div>
    </div>

</div>

</div>
</div>
  </body>
  </html>

<?php $sitever = $app->selectNewestVersion(); ?>
<footer class="page-footer elegant-color-dark">
    <div class="container text-center text-md-center align-middle">
        <p><div class="footer-copyright text-center py-4">© 2020:<a href="http://www.ra1g.eu"> RA1G</a></p>
        <p><a href="#!">Cookies policy</a> <i class="fas fa-minus "></i> <a href="#!">Other projects</a> <i class="fas fa-minus "></i> <a href="#!">About me</a></p>
        <p class="small"><?php echo $sitever['version']; ?></p>
        </div>
</footer>
<hr class="my-2">
<?php $sitever = $app->selectNewestVersion(); ?>
<footer class="page-footer elegant-color-dark">
    <div class="container text-center text-md-center align-middle">
        <div class="align-middle">
            <div class="align-middle">
                <h5 class="font-weight-bold text-uppercase mt-3 mb-2">Links</h5>
                <a href="#!">Cookies policy</a> <i class="fas fa-minus "></i> <a href="#!">Other projects</a> <i
                        class="fas fa-minus "></i> <a href="#!">About me</a>
            </div>
        </div>
        <div class="footer-copyright text-center py-4">© 2020:
            <a href="http://www.ra1g.eu"> RA1G</a>
            <p><?php echo $sitever['version']; ?></p>
        </div>
</footer>
<hr class="my-2">
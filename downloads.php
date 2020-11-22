<?php
include_once("session.php");
include_once("header.php");
include_once("menu.php");
include_once("incl/adminconfig.php");
require "incl/config.php";

$conn = new PDO($dsn, $username, $password, $options);
$oldGamereleases = getOldGameReleases($conn);
$latestreleases = getLatestReleases($conn);

?>
<div class="container py-2">
    <?php if (isset($_SESSION['userid']) && ($user->role) == 'admin') { ?>
        <a class="btn btn-primary btn-lg" style="float: right;" href="adminpanel/download-edit.php">Download Editor</a>
    <?php } ?>
    <div class="jumbotron elegant-color text-white">
        <div class="py-0">
            <h1 class="display-5">Download center</h1>
            <hr class="my-4">
            <div class="row">
                <?php foreach ($latestreleases as $key => $latestrel) {
                    ?>
                    <div class="col-sm-6 mb-3 mb-md-0">
                        <div class="card text-white elegant-color-dark border-dark rounded mb-0">
                            <h5 class="card-header h5 elegant-color"><?php echo $latestrel['name']; ?> - latest release
                                version: <?php echo $latestrel['version']; ?></h5>
                            <div class="card-body">
                                <h5 class="card-title">Uploaded on: <?php echo $latestrel['dateuploaded']; ?></h5>
                                <a href="releases/<?php echo $latestrel['file_path']; ?>" class="btn btn-primary">Download <?php echo $latestrel['name']; ?>
                                    <i class="fas fa-file-archive"></i></a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <hr class="my-5">
            <button type="button" id="downloadButton" class="btn btn-outline-secondary btn-block text-lg-center py-2">See
                older
                releases
            </button>
        </div>
    </div>
</div>

<div class="modal fade" id="downloadBox" tabindex="-1" role="dialog" aria-labelledby="downloadmodal" aria-hidden="true">
    <div class="modal-dialog cascading-modal modal-lg" role="document">
        <!--Content-->
        <div class="modal-content">
            <!--older releases modal-->
            <!-- Nav tabs -->
            <ul class="nav nav-tabs md-tabs tabs-2 elegant-color-dark" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#gametab" role="tab"><i
                                class="fas fa-gamepad mr-1"></i>
                        Game</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tbatab" role="tab"><i
                                class="fas fa-question mr-1"></i>
                        TBA</a>
                </li>
            </ul>

            <!-- Tab panels -->
            <div class="tab-content">

                <!--Panel 7-->
                <div class="tab-pane fade in show active" id="gametab" role="tabpanel">
                    <!--Body-->
                    <div class="modal-body mb-1">
                                <?php foreach ($oldGamereleases as $key => $oldrel) {
                                    ?>
                                    <hr class="my-1">
                                    <div class="text-center">
                                        <div class="card text-white elegant-color-dark border-dark rounded mb-0">
                                            <h5 class="card-header h5 elegant-color"><?php echo $oldrel['name']; ?> - release
                                                version: <?php echo $oldrel['version']; ?></h5>
                                            <div class="card-body">
                                                <h5 class="card-title">Uploaded on: <?php echo $latestrel['dateuploaded']; ?></h5>
                                                <a href="releases/<?php echo $oldrel['file_path']; ?>" class="btn btn-primary">Download <?php echo $oldrel['name']; ?>
                                                    <i class="fas fa-file-archive"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                    </div>
                    <!--Footer-->
                    <div class="modal-footer">
                        <div class="options text-center text-md-right mt-1">
                            <p><a href="changelogs.php" class="blue-text">See changelog</a></p>
                        </div>
                        <button type="button" class="btn btn-outline-info waves-effect ml-auto"
                                data-dismiss="modal">Close
                        </button>
                    </div>
                </div>
                <div class="tab-pane fade in" id="tbatab" role="tabpanel">
                    <!--Body-->
                    <div class="modal-body mb-1">
                        <div class="changelog">
                            <div class="wrapper">
                                <div class="changelog__item">
                                    <div class="changelog__meta">
                                        <h4 class="changelog__title" id="chversion"><span
                                                    class="badge badge-info">TBA</span></h4>
                                        <h5 class="changelog__date" id="chdate"><span
                                                    class="badge badge-dark">TBA</span></h5>
                                    </div>
                                    <div class="changelog__detail" id="chtext">
                                        <a href="http://peeporun2d.ra1g.eu/Game.zip" class="btn btn-primary btn-sm">TBA
                                            <i class="fas fa-file-archive"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Footer-->
                    <div class="modal-footer">
                        <div class="options text-center text-md-right mt-1">
                            <p><a href="changelogs.php" class="blue-text">TBA</a></p>
                        </div>
                        <button type="button" class="btn btn-outline-info waves-effect ml-auto"
                                data-dismiss="modal">Close
                        </button>
                    </div>
                </div>
                <!--/.Panel 7-->

            </div>


        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $("#downloadButton").click(function () {
            $("#downloadBox").modal();
        });
    });
</script>

<?php include_once("footer.php"); ?>
</body>
</html>

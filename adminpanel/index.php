<?php
include_once("adminheader.php");
require "../incl/config.php";
require "../incl/adminconfig.php";
$conn = new PDO($dsn, $username, $password, $options);
$userscount = getUsersCount($conn);
$newscount = getArticleCount($conn);
$imagescount = getImagesCount($conn);
?>
<div class="app-wrapper">

    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">

            <h1 class="app-page-title">R1 AdminPanel overview</h1>

            <div class="app-card alert alert-dismissible shadow-sm mb-4 border-left-decoration" role="alert">
                <div class="inner">
                    <div class="app-card-body p-3 p-lg-4">
                        <h3 class="mb-3">Welcome, <span class="badge bg-success"><?php echo $user->username ?></span>
                        </h3>
                        <div class="row gx-5 gy-3">
                            <div class="col-12 col-lg-9">

                                <div>R1AP is a Work in Progress admin panel used on RA1G's developer page. Here you can edit menus on the main page, ban & give administrator privileges to a user
                                    and with many more functions on the way.
                                </div>
                            </div><!--//col-->
                            <div class="col-12 col-lg-3">
                                <a class="btn app-btn-primary" href="../">Go back to homepage</a>
                            </div><!--//col-->
                        </div><!--//row-->

                    </div><!--//app-card-body-->

                </div><!--//inner-->
            </div><!--//app-card-->

            <div class="row g-4 mb-4">
                <div class="col-6 col-lg-3">
                    <div class="app-card app-card-stat shadow-sm h-100">
                        <div class="app-card-body p-3 p-lg-4">
                            <h4 class="stats-type mb-1">Total users</h4>
                            <div class="stats-figure"><?php foreach ($userscount as $usersC => $uc) {
                                    echo $uc['usrcount'];
                                } ?></div>
                            <div class="stats-meta text-success">
                            </div>
                        </div><!--//app-card-body-->
                        <a class="app-card-link-mask" href="#"></a>
                    </div><!--//app-card-->
                </div><!--//col-->

                <div class="col-6 col-lg-3">
                    <div class="app-card app-card-stat shadow-sm h-100">
                        <div class="app-card-body p-3 p-lg-4">
                            <h4 class="stats-type mb-1">Total articles</h4>
                            <div class="stats-figure"><?php foreach ($newscount as $newsC => $nc) {
                                    echo $nc['newscount'];
                                } ?></div>
                            <div class="stats-meta text-success"></div>
                        </div><!--//app-card-body-->
                        <a class="app-card-link-mask" href="#"></a>
                    </div><!--//app-card-->
                </div><!--//col-->
                <div class="col-6 col-lg-3">
                    <div class="app-card app-card-stat shadow-sm h-100">
                        <div class="app-card-body p-3 p-lg-4">
                            <h4 class="stats-type mb-1">Total images</h4>
                            <div class="stats-figure"><?php foreach ($imagescount as $imgC => $ic) {
                                    echo $ic['imagescount'];
                                } ?></div>
                            <div class="stats-meta">
                            </div>
                        </div><!--//app-card-body-->
                        <a class="app-card-link-mask" href="#"></a>
                    </div><!--//app-card-->
                </div><!--//col-->

            </div><!--//row-->
        </div><!--//container-fluid-->
    </div><!--//app-content-->
</div><!--//app-wrapper-->
<?php include_once("adminfooter.php"); ?>


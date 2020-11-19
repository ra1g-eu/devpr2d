<?php include_once("../session.php");
if (empty($_SESSION['userid']) || ($user->role) == 'basic' || ($user->role == 'banned')) {
    header("Location: ../");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>R1AP Administration</title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="description" content="R1AP administration">
    <meta name="author" content="Xiaoying Riley at 3rd Wave Media & RA1G.eu">
    <!-- FontAwesome JS-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
    <!-- App CSS -->
    <link id="theme-style" rel="stylesheet" href="assets/css/portal.css">
    <link rel="apple-touch-icon" sizes="57x57" href="../ico/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="../ico/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="../ico/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="../ico/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="../ico/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="../ico/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="../ico/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="../ico/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="../ico/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="../ico/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../ico/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="../ico/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../ico/favicon-16x16.png">

</head>
<body class="app">
<header class="app-header fixed-top">
    <div class="app-header-inner">
        <div class="container-fluid py-2">
            <div class="app-header-content">
                <div class="row justify-content-between align-items-center">
                    <div class="col-auto">
                        <a id="sidepanel-toggler" class="sidepanel-toggler d-inline-block d-xl-none" href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" role="img"><title>Menu</title><path stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10" stroke-width="2" d="M4 7h22M4 15h22M4 23h22"></path></svg>
                        </a>
                        <div class="app-utility-item align-right">
                            <a href="../" class="btn btn-success text-center text-white">Homepage <i class="fa fa-home"></i></a>
                        </div>
                        <div class="app-utility-item align-right">
                            <a href="../myprofile.php" class="btn btn-success text-center text-white">Profile <i class="fa fa-id-card"></i></a>
                        </div>
                    </div><!--//col-->

                </div><!--//row-->
            </div><!--//app-header-content-->
        </div><!--//container-fluid-->
    </div><!--//app-header-inner-->
    <div id="app-sidepanel" class="app-sidepanel">
        <div id="sidepanel-drop" class="sidepanel-drop"></div>
        <div class="sidepanel-inner d-flex flex-column">
            <a href="#" id="sidepanel-close" class="sidepanel-close d-xl-none">&times;</a>
            <div class="app-branding">
                <a class="app-logo" href="../adminpanel/"><img class="logo-icon mr-2" src="assets/images/logo2.png" alt="logo"><span class="logo-text">R1AP</span></a>

            </div><!--//app-branding-->

            <nav id="app-nav-main" class="app-nav app-nav-main flex-grow-1">
                <ul class="app-menu list-unstyled accordion" id="menu-accordion">
                    <li class="nav-item">
                        <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                        <a class="nav-link" href="../adminpanel/">
						        <span class="nav-icon"><i class="fa fa-home"></i></span>
                            <span class="nav-link-text">Admin Index</span>
                        </a><!--//nav-link-->
                    </li><!--//nav-item-->
                    <li class="nav-item">
                        <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                        <a class="nav-link" href="../adminpanel/">
						        <span class="nav-icon"><i class="fa fa-list"></i></span>
                            <span class="nav-link-text">WIP</span>
                        </a><!--//nav-link-->
                    </li><!--//nav-item-->
                    <!-- MENU ITEM -->
                    <li class="nav-item">
                        <a class="nav-link" href="userspage.php">
						        <span class="nav-icon"><i class="fa fa-address-card"></i></span>
                            <span class="nav-link-text">Show users</span>
                        </a><!--//nav-link-->
                    </li><!--//nav-item-->
                    <!-- MENU ITEM END-->
                    <!-- MENU ITEM -->
                    <li class="nav-item">
                        <a class="nav-link" href="menupage.php">
                            <span class="nav-icon"><i class="fa fa-bars"></i></span>
                            <span class="nav-link-text">Show menu</span>
                        </a><!--//nav-link-->
                    </li><!--//nav-item-->
                    <!-- MENU ITEM END-->
                    <!-- MENU ITEM -->
                    <li class="nav-item">
                        <a class="nav-link" href="cl-edit.php">
                            <span class="nav-icon"><i class="fa fa-edit"></i></span>
                            <span class="nav-link-text">Changelog Editor</span>
                        </a><!--//nav-link-->
                    </li><!--//nav-item-->
                    <!-- MENU ITEM END-->
                    <!-- MENU ITEM -->
                    <li class="nav-item">
                        <a class="nav-link" href="image-edit.php">
                            <span class="nav-icon"><i class="fa fa-edit"></i></span>
                            <span class="nav-link-text">Image Editor</span>
                        </a><!--//nav-link-->
                    </li><!--//nav-item-->
                    <!-- MENU ITEM END-->
                    <!-- MENU ITEM -->
                    <li class="nav-item">
                        <a class="nav-link" href="news-edit.php">
                            <span class="nav-icon"><i class="fa fa-edit"></i></span>
                            <span class="nav-link-text">Article Editor</span>
                        </a><!--//nav-link-->
                    </li><!--//nav-item-->
                    <!-- MENU ITEM END-->
                    <li class="nav-item">
                        <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                        <a class="nav-link" href="information.php">
						        <span class="nav-icon"><i class="fa fa-info"></i>
						         </span>
                            <span class="nav-link-text">Information</span>
                        </a><!--//nav-link-->
                    </li><!--//nav-item-->
                </ul><!--//app-menu-->
            </nav><!--//app-nav-->
            <div class="app-sidepanel-footer">
                <nav class="app-nav app-nav-footer">
                    <ul class="app-menu footer-menu list-unstyled">
                        <li class="nav-item">
                            <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                            <a class="nav-link" href="https://themes.3rdwavemedia.com/bootstrap-templates/admin-dashboard/portal-free-bootstrap-admin-dashboard-template-for-developers/">
							        <span class="nav-icon">
							            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-download" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
	  <path fill-rule="evenodd" d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
	  <path fill-rule="evenodd" d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
	</svg>
							        </span>
                                <span class="nav-link-text">External link - Download</span>
                            </a><!--//nav-link-->
                        </li><!--//nav-item-->
                        <li class="nav-item">
                            <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                            <a class="nav-link" href="https://themes.3rdwavemedia.com/bootstrap-templates/admin-dashboard/portal-free-bootstrap-admin-dashboard-template-for-developers/">
							        <span class="nav-icon">
							            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-file-person" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
	  <path fill-rule="evenodd" d="M12 1H4a1 1 0 0 0-1 1v10.755S4 11 8 11s5 1.755 5 1.755V2a1 1 0 0 0-1-1zM4 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H4z"/>
	  <path fill-rule="evenodd" d="M8 10a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
	</svg>
							        </span>
                                <span class="nav-link-text">External link - License</span>
                            </a><!--//nav-link-->
                        </li><!--//nav-item-->
                        <li class="nav-item">
                            <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                            <a class="nav-link" href="../incl/logout.php">
							        <span class="nav-icon"></span>
                                <span class="nav-link-text btn bg-danger">Sign Out <i class="fa fa-sign-out"></i></span>
                            </a><!--//nav-link-->
                        </li><!--//nav-item-->
                    </ul><!--//footer-menu-->
                </nav>
            </div><!--//app-sidepanel-footer-->

        </div><!--//sidepanel-inner-->
    </div><!--//app-sidepanel-->
</header><!--//app-header-->

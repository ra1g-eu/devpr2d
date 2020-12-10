<?php
//ini_set('session.cookie_domain', '.ra1g.eu' );
session_start();
include_once("classes/DB.php");

use classes\DB;

$app = new DB("localhost", "root", "", "devpeeporun", 3306);
$menuItems = $app->getMenuItems();
if (!empty($_SESSION["userid"])) {
    $user = $app->UserDetails($_SESSION['userid']);
}
if (isset($_SESSION['userid']) && ($user->role) == 'banned') {
    header("Location: banned.php");
}


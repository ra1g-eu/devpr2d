<?php
session_start();
include_once("classes/DB.php");

use classes\DB;
$banned = false;
$app = new DB("localhost", "root", "", "devpeeporun", 3306);
$menuItems = $app->getMenuItems();
if (!empty($_SESSION["userid"])) {
    $user = $app->UserDetails($_SESSION['userid']);
} if (isset($_SESSION['userid']) && ($user->role) == 'banned') {
    header("Location: banned.php");
}

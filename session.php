<?php
session_start();
include_once("classes/DB.php");
use classes\DB;
$app = new DB("localhost", "root", "", "devpeeporun", 3306);
$menuItems = $app->getMenuItems();
if (!empty($_SESSION["id"])) {
    $user = $app->UserDetails($_SESSION['id']);
}
?>
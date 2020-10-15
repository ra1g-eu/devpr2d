<?php
include_once ("classes/DB.php");
use classes\DB;
$db = new DB("localhost","root","","devpeeporun", 3306);
$menuItems = $db->getMenuItems();
?>
<nav>
    <div class="logo"></div>
    <ul class="menu">
        <div class="menu__item toggle"><span></span></div>
        <?php foreach($menuItems as $key => $menuItem){
            ?>
        <li class="menu__item"><a href="<?php echo $menuItem['file_path']; ?>" class="link link--dark"><i class="<?php echo $menuItem['icon']; ?>"></i><?php echo $menuItem['meno']; ?></a></li>
                <?php } ?>
    </ul>
</nav>
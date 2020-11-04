<?php include_once ("session.php"); ?>
<a class="navbar-brand" href="index.php">
<?php if (empty($_SESSION["id"])) {
    echo "DEVPR2D";
    } else {
        echo 'Welcome <span class="badge badge-success">';
        echo $user->username;
        echo '</span>';
    }
?>
</a>
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01"
        aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="navbarColor01">
    <ul class="navbar-nav mr-auto">
        <?php foreach ($menuItems as $key => $menuItem): ?>
            <li class="nav-item">
                <a class="nav-link" href="<?= $menuItem['file_path']; ?>"><i class="<?= $menuItem['icon']; ?>"></i><?= $menuItem['meno']; ?></a>
            </li>
        <?php endforeach ?>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-list-ul"></i>Changelogs</a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="changelogpr.php">PeepoRun2D</a>
                <a class="dropdown-item" href="changelogrl.php">RA1G Launcher</a>
                <a class="dropdown-item" href="changelogsite.php">Website</a>
            </div>
        </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
        <?php if (empty($_SESSION["id"])) { ?>
            <a class="nav-link btn btn-outline-success" href="register.php">Register</a>
            <a class="nav-link btn btn-outline-secondary" href="login.php">Login</a>
        <?php } else { ?>
            <a class="nav-link btn btn-outline-success" href="myprofile.php">My profile </a>
            <a class="nav-link btn btn-outline-danger" href="incl/logout.php">Logout</a>
        <?php } ?>
    </form>
</div>
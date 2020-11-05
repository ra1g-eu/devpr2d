<?php include_once("session.php");
if (empty($_SESSION['id']) || ($user->role) == 'basic') {
    header("Location: index.php");
}
?>
<!doctype html>
<html>
<head>
    <?php include_once("header.php");
    require "incl/config.php";
    $limit = 5;
    $conn = new PDO($dsn, $username, $password, $options);
    $susers = $conn->prepare("SELECT id, username, role FROM users");
    $smenu = $conn->prepare("SELECT idmenu, meno, file_path, icon, menuorder FROM menu");
    $susers -> execute();
    $smenu -> execute();

    $total_results = $susers->rowCount();
    $total_pages = ceil($total_results/$limit);

    $total_results2 = $smenu->rowCount();
    $total_pages2 = ceil($total_results2/$limit);

    if (!isset($_GET['page'])) {
        $page1 = 1;
    } else {
        $page1 = $_GET['page'];
    }
    if(!isset($_GET['pagemenu'])){
        $page2 = 1;
    } else {
        $page2 = $_GET['pagemenu'];
    }
    $start1 = ($page1-1)*$limit;
    $start2 = ($page2-1)*$limit;
    $suserslimited = $conn->prepare("SELECT id, username, role FROM users ORDER BY id ASC LIMIT $start1, $limit");
    $smenulimited = $conn->prepare("SELECT idmenu, meno, file_path, icon, menuorder FROM menu ORDER BY menuorder ASC LIMIT $start2, $limit");
    $suserslimited ->execute();
    $smenulimited->execute();
    $suserslimited->setFetchMode(PDO::FETCH_OBJ);
    $smenulimited->setFetchMode(PDO::FETCH_OBJ);

    $resultsusers = $suserslimited -> fetchAll();
    $resultsmenu = $smenulimited -> fetchAll();

    ?>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <?php include_once("menu.php");
    ?>
</nav>
<div class="container">

    <div class="jumbotron">
        <h1 class="display-5">Administration panel</h1>
        <hr class="my-4">
        <?php //include_once("incl/modal.php"); ?>
        <p></p>
<h2>Users table</h2>
        <table class="table table-info" id="rolechangetable" style="border: 2px #0d0d0d solid">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Username</th>
                <th scope="col">Role</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($resultsusers as $resultu){?>
            <tr class="table-light">
                <td><?= $resultu->id;?></td>
                <td><?= $resultu->username;?></td>
                <td>
                    <select class="custom-select" name="userrole">
                        <option value="basic" <?php if($resultu->role === 'basic'){echo 'selected=""'; } ?>>basic</option>
                        <option value="admin" <?php if($resultu->role === 'admin'){echo 'selected=""'; } ?>>admin</option>
                        <option value="banned" <?php if($resultu->role === 'banned'){echo 'selected=""'; } ?>>banned</option>
                    </select>
                </td>
                <td>
                    <button type="submit" class="btn btn-danger btn-sm" name="banuser" style="float: right;" onClick='return confirmSubmit()'>BAN <i class="fa fa-close"></i></button>
                    <a href="adminpanel.php?updaterole=" type="submit" class="btn btn-success btn-sm" style="float: right;">UPDATE <i class="fa fa-check"></i></a>
                </td>
            </tr>
                <?php } ?>
            </tbody>
        </table>
        <div>
        <ul class="pagination">
            <li class="page-item"><a class="page-link" href="?page=1">First</a></li>

            <?php for($p1=1; $p1<=$total_pages; $p1++){?>

                <li class="page-item <?= $page1 == $p1 ? 'active' : ''; ?>"><a class="page-link" href="<?= '?page='.$p1; ?>"><?= $p1; ?></a></li>
            <?php }?>
            <li class="page-item"><a class="page-link" href="?page=<?= $total_pages; ?>">Last</a></li>
        </ul>
        </div>
        <hr class="my-4">
        <h2>Menu table</h2>
        <table class="table table-info" id="menuedittable" style="border: 2px #0d0d0d solid">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">File path</th>
                <th scope="col"><a href="https://fontawesome.com/v4.7.0/icons/">Icon code</a></th>
                <th scope="col">Menu order</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($resultsmenu as $resultm){?>
            <tr class="table-light">
                <td><?= $resultm->idmenu;?></td>
                <td>
                    <div class="form-group"><input type="text" class="form-control" placeholder="Name of menu" name="menuname" value="<?= $resultm->meno;?>"></div>
                </td>
                <td><div class="form-group"><input type="text" class="form-control" placeholder="Path to file" name="menupath" value="<?= $resultm->file_path;?>"></div></td>
                <td><div class="form-group"><input type="text" class="form-control" placeholder="Icon code" name="menuicon" value="<?= $resultm->icon;?>"></div></td>
                <td><div class="form-group"><input type="text" class="form-control" placeholder="Order of menu" name="menuorder" value="<?= $resultm->menuorder;?>"></div></td>
                <td>
                    <a href="newseditor.php?newseditid=" type="submit" class="btn btn-success btn-sm"
                       style="float: right;">UPDATE <i class="fa fa-check"></i></a>
                    <a href="newseditor.php?newsiddel=<?php echo $resultm->idmenu; ?>" type="submit" onClick='return confirmSubmit()'
                       class="btn btn-danger btn-sm" style="float: right;">DELETE <i class="fa fa-close"></i></a>
                </td>
            </tr>
            <?php } ?>
            </tbody>
        </table>
            <div>
                <ul class="pagination">
                    <li class="page-item"><a class="page-link" href="?pagemenu=1">First</a></li>

                    <?php for($p2=1; $p2<=$total_pages2; $p2++){?>

                        <li class="page-item <?= $page2 == $p2 ? 'active' : ''; ?>"><a class="page-link" href="<?= '?pagemenu='.$p2; ?>"><?= $p2; ?></a></li>
                    <?php }?>
                    <li class="page-item"><a class="page-link" href="?pagemenu=<?= $total_pages2; ?>">Last</a></li>
                </ul>
            </div>
        </div>
</div>
<?php include_once("footer.php"); ?>
</body>
</html>

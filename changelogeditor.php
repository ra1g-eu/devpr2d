<!doctype html>
<html xmlns="http://www.w3.org/1999/html">
<head>

    <?php
    include_once("header.php");
    require "incl/config.php";
    if(isset($_SESSION['id']) && ($user->role) == 'basic'){
        header("Location: index.php");
    }?>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <?php include_once("menu.php");
    require "incl/changelogconfig.php";

    if(isset($_SESSION['id']) && ($user->role) == 'admin'){
    ?>
</nav>

<div class="jumbotron">
    <h1 class="display-5">Changelog Editor -> <?php if($peeporun){echo 'PeepoRun2D';} else if($ra1glauncher){echo 'RA1G Launcher';} else if($websitechangelog){echo 'Website';} else {echo 'Add New';} ?></h1>
    <?php include_once("incl/modal.php"); ?>
    <?php
    $admin_error_message = "";
    if ($admin_error_message != "") {
        echo '<div class="alert alert-dismissible alert-info">
  <strong>Error: </strong> ' . $admin_error_message . '</div>';
    }
    ?>
    <form action="changelogeditor.php" method="post" name="addchangelog">
        <div class="card border-primary mb-3">
            <div class="card-header"><h4>ID</h4></div>
            <div class="card-body">
                <input type="text" class="form-control" name="idname" id="idnamef" placeholder="ID" value="<?php if(!empty($prch['id'])){ echo $prch['id'];} else { echo 'ID'; } ?>" readonly=""/>
            </div>
        </div>
        <div class="card border-primary mb-3">
            <div class="card-header"><h4>Version</h4></div>
            <div class="card-body">
                <input type="text" class="form-control" name="version" id="versionf" placeholder="Enter version number" value="<?php if(!empty($prch['version'])){ echo $prch['version']; }?>" required="required" pattern="[\s\S]*\S[\s\S]*" minlength="2" maxlength="20"/>
            </div>
        </div>
        <div class="card border-primary mb-3">
            <div class="card-header"><h4>Date</h4></div>
            <div class="card-body">
                <input type="text" class="form-control" name="date" id="datef" placeholder="Enter date" value="<?php if(!empty($prch['date'])){ echo $prch['date']; } ?>" required="required"/>
            </div>
        </div>
        <div class="card border-primary mb-3">
            <div class="card-header"><h4>Changelog text<a class="btn btn-info btn-sm" style="float: right;" href=""><i class="fa fa-page"></i>Add &ltli&gt tags</a></h4></div>
            <div class="card-body">
                <textarea class="form-control" name="changelogtext" id="changelogtextf" placeholder="Add new changelog text"><?php if(!empty($prch['text'])){ echo $prch['text']; }?></textarea>
            </div>
        </div>
        <div class="card border-primary mb-5">
            <div class="card-header"><h4>Choose category
                    <div class="form-check" style="float: right;">
                        <input class="form-check-input" type="checkbox" value=""  required="required">
                        <h5>Confirm that you understand which category is selected</h5>
                    </div></h4>
                </div>
            <div class="card-body">
                <select class="custom-select" name="category">
                    <?php if($updating){ ?>
                    <option value="PR"<?php if($peeporun) echo 'selected=""';  else { echo 'disabled=""'; } ?>>PeepoRun2D</option>
                    <option value="RL"<?php if($ra1glauncher) echo 'selected=""'; else { echo 'disabled=""'; }?>>RA1G Launcher</option>
                    <option value="WEB"<?php if($websitechangelog) echo 'selected=""';  else { echo 'disabled=""'; } ?>>Website</option>
                    <?php } if(!$updating){ ?>
                        <option value="PR">PeepoRun2D</option>
                        <option value="RL">RA1G Launcher</option>
                        <option value="WEB">Website</option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <?php if($updating){ ?>
            <button type="submit" class="btn btn-info btn-lg" name="btnUpdate">Update <i class="fa fa-pencil"></i></button>
            <button type="submit" name="btnDeleteCH" onClick='return confirmSubmit()' class="btn btn-danger btn-lg" >Delete <i class="fa fa-close"></i></button>
        <?php } else {?>
        <input type="submit" class="btn btn-success btn-lg" value="Add new" name="btnAddNew"/>
        <?php } ?>
    </form>
</div>
<?php include_once("footer.php"); ?>
</body>
</html>
<?php } ?>
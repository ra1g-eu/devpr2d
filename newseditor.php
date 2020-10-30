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
    require "incl/newsconfig.php";
    if(isset($_SESSION['id']) && ($user->role) == 'admin'){
    ?>
</nav>

<div class="jumbotron">
    <h1 class="display-5">News Editor</h1>
    <?php include_once("incl/modal.php"); ?>
    <?php
    $admin_error_message = "";
    if ($admin_error_message != "") {
        echo '<div class="alert alert-dismissible alert-info">
  <strong>Error: </strong> ' . $admin_error_message . '</div>';
    }
    ?>
    <form action="newseditor.php" method="post" name="editnews">
        <div class="card border-primary mb-3">
            <div class="card-header"><h4>ID</h4></div>
            <div class="card-body">
                <input type="text" class="form-control" name="newsid" id="newsidf" placeholder="ID" value="<?php if(!empty($newsedit['news_id'])){ echo $newsedit['news_id'];} else { echo 'ID'; } ?>" readonly=""/>
            </div>
        </div>
        <div class="card border-primary mb-3">
            <div class="card-header"><h4>Title</h4></div>
            <div class="card-body">
                <input type="text" class="form-control" name="title" id="titlef" placeholder="Enter news title (2-150 characters)" value="<?php if(!empty($newsedit['news_title'])){ echo $newsedit['news_title']; }?>" required="required" pattern="[\s\S]*\S[\s\S]*" minlength="2" maxlength="150"/>
            </div>
        </div>
        <div class="card border-primary mb-3">
            <div class="card-header"><h4>Author</h4></div>
            <div class="card-body">
                <input type="text" class="form-control" name="author" id="authorf" placeholder="<?php if(!$updating) { echo $user->username; } ?>" value="<?php if(!empty($newsedit['news_author'])){ echo $newsedit['news_author']; }?>" required="required" readonly=""/>
            </div>
        </div>
        <div class="card border-primary mb-3">
            <div class="card-header"><h4>Publish date</h4></div>
            <div class="card-body">
                <input type="text" class="form-control" name="publish" id="publishf" placeholder="Publishing date" value="<?php if(!empty($newsedit['news_published_on'])){ echo $newsedit['news_published_on']; }?>" required="required"/>
            </div>
        </div>
        <div class="card border-primary mb-3">
            <div class="card-header"><h4>Short news description</h4></div>
            <div class="card-body">
                <input type="text" class="form-control" name="shortdesc" id="shortdescf" placeholder="Short description of full news content" value="<?php if(!empty($newsedit['news_short_description'])){ echo $newsedit['news_short_description']; }?>" required="required"/>
            </div>
        </div>
        <div class="card border-primary mb-3">
            <div class="card-header"><h4>Full news content</h4></div>
            <div class="card-body">
                <textarea class="form-control" name="fulltext" id="fulltextf" placeholder="Full news content"><?php if(!empty($newsedit['news_full_content'])){ echo $newsedit['news_full_content']; }?></textarea>
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
                <select class="custom-select" name="newscat">
                        <option value="General News" <?php if($updating && $newsedit['news_category'] === 'General News') { echo 'selected=""'; } ?>>General News</option>
                        <option value="Site News"<?php if($updating && $newsedit['news_category'] === 'Site News') { echo 'selected=""'; } ?>>Site News</option>
                        <option value="Developer News"<?php if($updating && $newsedit['news_category'] === 'Developer News') { echo 'selected=""'; } ?>>Developer News</option>
                        <option value="Other News"<?php if($updating && $newsedit['news_category'] === 'Other News') { echo 'selected=""'; } ?>>Other News</option>
                </select>
            </div>
        </div>
        <?php if($updating){ ?>
            <button type="submit" class="btn btn-info btn-lg" name="btnUpdateNews">Update <i class="fa fa-pencil"></i></button>
            <button type="submit" name="btnDeleteNews" onClick='return confirmSubmit()' class="btn btn-danger btn-lg" >Delete <i class="fa fa-close"></i></button>
        <?php } else {?>
            <input type="submit" class="btn btn-success btn-lg" value="Add new" name="btnAddNewNews"/>
        <?php } ?>
    </form>
</div>
<?php include_once("footer.php"); ?>
</body>
</html>
<?php } ?>
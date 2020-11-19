<?php
include_once("adminheader.php");
require "../incl/config.php";
require "../incl/newsconfig.php";
if (isset($_SESSION['userid']) && ($user->role) == 'admin') {
    ?>
    <div class="app-wrapper">

        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">
                <h1 class="app-page-title">Article Editor <?php if (!empty($newsedit['news_id'])) { ?><h4><a
                                class="badge bg-info"
                                href="../article.php?newsid=<?= stripslashes($newsedit['news_id']); ?>">Go
                            back to article</a></h4><?php } ?></h1>
                <!-- ALERTY PRE USPECH ALEBO FAIL START -->
                <?php if ($success != "") { ?>
                    <div class="alert alert-dismissible alert-success">
                        <button type="button" class="btn-close" data-dismiss="alert"></button>
                        <strong><?php echo $success; ?></strong>
                    </div>
                <?php } else if ($failure != "") { ?>
                    <div class="alert alert-dismissible alert-danger">
                        <button type="button" class="btn-close" data-dismiss="alert"></button>
                        <strong><?php echo $failure; ?></strong>
                    </div>
                <?php } else {
                } ?>
                <!-- ALERTY PRE USPECH ALEBO FAIL KONIEC -->
                <hr class="mb-4">
                <form action="news-edit.php" method="post" name="addchangelog">
                    <!-- FORM CLASS START -->
                    <div class="row g-4 settings-section">
                        <div class="col-12 col-md-4">
                            <h3 class="section-title">ID</h3>
                            <div class="section-intro">ID of a given news article in the database. It is added
                                automatically.
                            </div>
                        </div>
                        <div class="col-12 col-md-8">
                            <div class="app-card app-card-settings shadow-sm p-4">
                                <div class="app-card-body">
                                    <div class="mb-3">
                                        <div class="card-body">
                                            <input type="text" class="form-control" name="newsid" id="newsidf"
                                                   placeholder="ID"
                                                   value="<?php if (!empty($newsedit['news_id'])) {
                                                       echo $newsedit['news_id'];
                                                   } else {
                                                       echo 'ID';
                                                   } ?>" readonly=""/>
                                        </div>
                                    </div>
                                </div><!--//app-card-body-->
                            </div><!--//app-card-->
                        </div>
                    </div><!--//row-->
                    <!-- FORM CLASS END -->
                    <hr class="my-4">
                    <!-- FORM CLASS START -->
                    <div class="row g-4 settings-section">
                        <div class="col-12 col-md-4">
                            <h3 class="section-title">Title</h3>
                            <div class="section-intro">
                                News article title. Must not too long, and should be descriptive. Maximum characters:
                                150.
                            </div>
                        </div>
                        <div class="col-12 col-md-8">
                            <div class="app-card app-card-settings shadow-sm p-4">
                                <div class="app-card-body">
                                    <div class="mb-3">
                                        <div class="card-body">
                                            <input type="text" class="form-control" name="title" id="titlef"
                                                   placeholder="Enter news title (2-150 characters)"
                                                   value="<?php if (!empty($newsedit['news_title'])) {
                                                       echo $newsedit['news_title'];
                                                   } ?>" required="required" pattern="[\s\S]*\S[\s\S]*" minlength="2"
                                                   maxlength="150"/>

                                        </div>
                                    </div>
                                </div><!--//app-card-body-->
                            </div><!--//app-card-->
                        </div>
                    </div><!--//row-->
                    <!-- FORM CLASS END -->
                    <hr class="my-4">
                    <!-- FORM CLASS START -->
                    <div class="row g-4 settings-section">
                        <div class="col-12 col-md-4">
                            <h3 class="section-title">Author</h3>
                            <div class="section-intro">
                                Author of a article. If you are adding a new one, your username is automatically added.
                                If editing an existing one, author can not be changed.
                            </div>
                        </div>
                        <div class="col-12 col-md-8">
                            <div class="app-card app-card-settings shadow-sm p-4">
                                <div class="app-card-body">
                                    <div class="mb-3">
                                        <div class="card-body">
                                            <input type="text" class="form-control" name="author" id="authorf"
                                                   placeholder="Author's name"
                                                   value="<?php if (!$updating) {
                                                       echo $user->username;
                                                   }
                                                   if (!empty($newsedit['news_author'])) {
                                                       echo $newsedit['news_author'];
                                                   } ?>" required="required" readonly=""/>
                                        </div>
                                    </div>
                                </div><!--//app-card-body-->
                            </div><!--//app-card-->
                        </div>
                    </div><!--//row-->
                    <!-- FORM CLASS END -->
                    <hr class="my-4">
                    <!-- FORM CLASS START -->
                    <div class="row g-4 settings-section">
                        <div class="col-12 col-md-4">
                            <h3 class="section-title">Published on</h3>
                            <div class="section-intro">
                                Enter a date on which the article was published. <p class="lead">Example:
                                    19.11.2020.</p>
                            </div>
                        </div>
                        <div class="col-12 col-md-8">
                            <div class="app-card app-card-settings shadow-sm p-4">
                                <div class="app-card-body">
                                    <div class="mb-3">
                                        <div class="card-body">
                                            <input type="text" class="form-control" name="publish" id="publishf"
                                                   placeholder="Publishing date"
                                                   value="<?php if (!empty($newsedit['news_published_on'])) {
                                                       echo $newsedit['news_published_on'];
                                                   } ?>" required="required"/>
                                        </div>
                                    </div>
                                </div><!--//app-card-body-->
                            </div><!--//app-card-->
                        </div>
                    </div><!--//row-->
                    <!-- FORM CLASS END -->
                    <hr class="my-4">
                    <!-- FORM CLASS START -->
                    <div class="row g-4 settings-section">
                        <div class="col-12 col-md-4">
                            <h3 class="section-title">Short news description</h3>
                            <div class="section-intro">
                                Write a short description of the news article.
                            </div>
                        </div>
                        <div class="col-12 col-md-8">
                            <div class="app-card app-card-settings shadow-sm p-4">
                                <div class="app-card-body">
                                    <div class="mb-3">
                                        <div class="card-body">
                                            <input type="text" class="form-control" name="shortdesc" id="shortdescf"
                                                   placeholder="Short description of full news content"
                                                   value="<?php if (!empty($newsedit['news_short_description'])) {
                                                       echo $newsedit['news_short_description'];
                                                   } ?>" required="required"/>
                                        </div>
                                    </div>
                                </div><!--//app-card-body-->
                            </div><!--//app-card-->
                        </div>
                    </div><!--//row-->
                    <!-- FORM CLASS END -->
                    <hr class="my-4">
                    <!-- FORM CLASS START -->
                    <div class="row g-4 settings-section">
                        <div class="col-12 col-md-4">
                            <h3 class="section-title">Full article</h3>
                            <div class="section-intro">
                                Write the full article here.
                            </div>
                        </div>
                        <div class="col-12 col-md-8">
                            <div class="app-card app-card-settings shadow-sm p-4">
                                <div class="app-card-body">
                                    <div class="mb-3">
                                        <div class="card-body">
                <textarea class="form-control" name="fulltext" id="fulltextf"
                          placeholder="Full news content"><?php if (!empty($newsedit['news_full_content'])) {
                        echo $newsedit['news_full_content'];
                    } ?></textarea>
                                        </div>
                                    </div>
                                </div><!--//app-card-body-->
                            </div><!--//app-card-->
                        </div>
                    </div><!--//row-->
                    <!-- FORM CLASS END -->
                    <hr class="my-4">
                    <!-- FORM CLASS START -->
                    <div class="row g-4 settings-section">
                        <div class="col-12 col-md-4">
                            <h3 class="section-title">Select a category</h3>
                            <div class="section-intro">
                                Choose where to add new article. Tick the checkbox to confirm your choice.
                            </div>
                        </div>
                        <div class="col-12 col-md-8">
                            <div class="app-card app-card-settings shadow-sm p-4">
                                <div class="app-card-body">
                                    <div class="mb-3">
                                        <div class="card-body">
                                            <select class="form-select" name="newscat">
                                                <option value="General News" <?php if ($updating && $newsedit['news_category'] === 'General News') {
                                                    echo 'selected=""';
                                                } ?>>General News
                                                </option>
                                                <option value="Site News"<?php if ($updating && $newsedit['news_category'] === 'Site News') {
                                                    echo 'selected=""';
                                                } ?>>Site News
                                                </option>
                                                <option value="Developer News"<?php if ($updating && $newsedit['news_category'] === 'Developer News') {
                                                    echo 'selected=""';
                                                } ?>>Developer News
                                                </option>
                                                <option value="Other News"<?php if ($updating && $newsedit['news_category'] === 'Other News') {
                                                    echo 'selected=""';
                                                } ?>>Other News
                                                </option>
                                            </select>
                                            <input class="form-check-input" type="checkbox" value="" required="required"
                                                   style="float: right;"/>Confirm that you understand which category is
                                            selected
                                        </div>
                                    </div>
                                </div><!--//app-card-body-->
                            </div><!--//app-card-->
                        </div>
                    </div><!--//row-->
                    <!-- FORM CLASS END -->
                    <hr class="my-4">
                    <?php if ($updating) { ?>
                        <button type="submit" class="btn-lg btn-info btn-block" name="btnUpdateNews">Update article <i
                                    class="fa fa-pencil"></i></button>
                        <button type="submit" name="btnDeleteNews" onClick='return confirmSubmit()'
                                class="btn-lg btn-danger btn-block">Delete article <i class="fa fa-close"></i>
                        </button>
                    <?php } else { ?>
                        <button type="submit" class="btn-lg btn-success btn-block" name="btnAddNewNews">Publish this article
                            <i class="fa fa-check-square-o"></i></button>
                    <?php } ?>
                    <a href="../newscat.php" class="btn-lg btn-secondary btn-block text-center">Go back <i
                                class="fa fa-sign-out"></i></a>
                </form>
                <hr class="my-4">
            </div><!--//container-fluid-->
        </div><!--//app-content-->
    </div><!--//app-wrapper-->
    <?php include_once("adminfooter.php");
} else {
    echo('<meta http-equiv="refresh" content="0;url=../">');
}
?>

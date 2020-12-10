<?php
include_once("adminheader.php");
require "../incl/config.php";
require "../incl/letecketestyconfig.php";
$conn = new PDO($dsn, $username, $password, $options);
$versioninfoLT = getPreviousVersionsLT($conn);
if (isset($_SESSION['userid']) && ($user->role) == 'admin') {
    ?>
    <div class="app-wrapper">
        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">
                <h1 class="app-page-title">Letecké Testy Editor -> <?php if ($updating) {
                        echo 'Update Aplikácia LT';
                    } else  {
                        echo 'Add new Aplikácia LT';
                    } ?> </h1>
                <!-- ALERTY PRE USPECH ALEBO FAIL START -->
                <?php if($success != ""){ ?>
                    <div class="alert alert-dismissible alert-success">
                        <button type="button" class="btn-close" data-dismiss="alert"></button>
                        <strong><?php echo $success; ?></strong>
                    </div>
                <?php } else if($failure !=""){?>
                    <div class="alert alert-dismissible alert-danger">
                        <button type="button" class="btn-close" data-dismiss="alert"></button>
                        <strong><?php echo $failure; ?></strong>
                    </div>
                <?php } else {} ?>
                <!-- ALERTY PRE USPECH ALEBO FAIL KONIEC -->
                <hr class="mb-4">
                <form action="letecketesty-cl-edit.php" method="post" name="addchangelog">
                    <!-- FORM CLASS START -->
                    <div class="row g-4 settings-section">
                        <div class="col-12 col-md-4">
                            <h3 class="section-title">ID</h3>
                            <div class="section-intro">ID of a given changelog in the database. It is added
                                automatically.
                            </div>
                        </div>
                        <div class="col-12 col-md-8">
                            <div class="app-card app-card-settings shadow-sm p-4">
                                <div class="app-card-body">
                                    <div class="mb-3">
                                        <div class="card-body">
                                            <input type="text" class="form-control" name="idname" id="idnamef"
                                                   placeholder="ID" value="<?php if (!empty($LTCH['id'])) {
                                                echo $LTCH['id'];
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
                            <h3 class="section-title">Version</h3>
                            <div class="section-intro">
                                Version of a given application.
                                <small>Syntax: Major.Minor.Hotfix-AlphaNumber. Example: 0.3.5-A2</small>
                                <strong>Previous versions:</strong>
                                <select class="form-select">
                                    <?php foreach ($versioninfoLT as $vilt => $viltdet){ ?>
                                        <option selected="" readonly=""><?php echo $viltdet['version']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-md-8">
                            <div class="app-card app-card-settings shadow-sm p-4">
                                <div class="app-card-body">
                                    <div class="mb-3">
                                        <div class="card-body">
                                            <input type="text" class="form-control" name="version" id="versionf" placeholder="Enter version number" value="<?php if(!empty($LTCH['version'])){ echo $LTCH['version']; }?>" required="required" pattern="[\s\S]*\S[\s\S]*" minlength="2" maxlength="20"/>
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
                            <h3 class="section-title">Date</h3>
                            <div class="section-intro">
                                Enter the date of release. <p class="lead">Format: DD.MM.YYYY (Example: 18.11.2020).</p>
                            </div>
                        </div>
                        <div class="col-12 col-md-8">
                            <div class="app-card app-card-settings shadow-sm p-4">
                                <div class="app-card-body">
                                    <div class="mb-3">
                                        <div class="card-body">
                                            <input type="text" class="form-control" name="date" id="datef" placeholder="Enter date" value="<?php if(!empty($LTCH['date'])){ echo $LTCH['date']; } ?>" required="required"/>
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
                            <h3 class="section-title">Changelog description</h3>
                            <div class="section-intro">
                                Enter a list of changes made since the last release. Add <strong>li</strong> tags for each new entry.
                            </div>
                        </div>
                        <div class="col-12 col-md-8">
                            <div class="app-card app-card-settings shadow-sm p-4">
                                <div class="app-card-body">
                                    <div class="mb-3">
                                        <div class="card-body">
                                            <textarea class="form-control" name="changelogtext" id="changelogtextf" placeholder="Add new changelog text"><?php if(!empty($LTCH['text'])){ echo $LTCH['text']; }?></textarea>
                                        </div>
                                    </div>
                                </div><!--//app-card-body-->
                            </div><!--//app-card-->
                        </div>
                    </div><!--//row-->
                    <!-- FORM CLASS END -->
                    <hr class="my-4">
                    <?php if($updating){ ?>
                        <button type="submit" class="btn-lg btn-info btn-block" name="btnUpdateLT">Update changelog <i class="fa fa-pencil"></i></button>
                        <button type="submit" name="btnDeleteLT" onClick='return confirmSubmit()' class="btn-lg btn-danger btn-block" >Delete changelog <i class="fa fa-close"></i></button>
                    <?php } else {?>
                        <button type="submit" class="btn-lg btn-success btn-block" name="btnAddNewLT">Create new changelog <i class="fa fa-check-square-o"></i></button>
                    <?php } ?>
                    <a href="../lt/releasenotes.php" class="btn-lg btn-secondary btn-block text-center">Go back <i class="fa fa-sign-out"></i></a>
                </form>
                <hr class="my-4">
            </div><!--//container-fluid-->
        </div><!--//app-content-->
    </div><!--//app-wrapper-->
    <?php include_once("adminfooter.php");
} else {
    echo('<meta http-equiv="refresh" content="0;url=../lt/index.php">');
}
?>

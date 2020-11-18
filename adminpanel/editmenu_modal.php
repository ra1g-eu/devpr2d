<?php
include_once("../session.php");
if (empty($_SESSION['userid']) || ($user->role) == 'basic' || ($user->role == 'banned')) {
    header("Location: ../");
}
require "../incl/config.php";
require "../incl/adminconfig.php";
$conn = new PDO($dsn, $username, $password, $options);
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    try {
        if (isset($_GET['editmenu'])) {
            $idmenu = $_GET['editmenu'];
            $menu = getMenuById($idmenu,$conn);
        }
        ?>
        <div class="modal-header">
            <h5 class="modal-title">Update menu with ID: <?php echo $idmenu; ?></h5>
            <button type="button" class="close btn btn-danger" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">X</span>
            </button>
        </div>
        <div class="modal-body">
            <form action="menupage.php" method="post" name="editmenuform">
            <?php
            foreach($menu as $key => $details) {
                ?>
                <div class="form-group">
                    <label class="col-form-label " for="inputLarge">Menu ID</label>
                    <input class="form-control " type="text" placeholder="Menu id" id="menuInput" name="menuid" value="<?= $details['idmenu'];?>" readonly="">
                </div>
                <div class="form-group">
                    <label class="col-form-label " for="inputLarge">Menu name</label>
                    <input class="form-control " type="text" placeholder="Menu name" id="menuInput" name="menuname" value="<?= $details['meno'];?>">
                </div>
                <div class="form-group">
                    <label class="col-form-label" for="inputLarge">Menu file path</label>
                    <input class="form-control" type="text" placeholder="Menu name" id="menuInput" name="menufilepath" value="<?= $details['file_path'];?>">
                </div>
                <div class="form-group">
                    <label class="col-form-label" for="inputLarge">Menu icon <a class="badge badge-info" href="https://fontawesome.com/v4.7.0/icons/">(Click here to see icon codes)</a></label>
                    <input class="form-control" type="text" placeholder="Menu name" id="menuInput" name="menuicon" value="<?= $details['icon']; ?>">
                </div>
                <div class="form-group">
                    <label class="col-form-label" for="inputLarge">Menu order</label>
                    <input class="form-control" type="text" placeholder="Menu name" id="menuInput" name="menuorder" value="<?= $details['menuorder']; ?>">
                </div>
                <hr class="my-4">
                <h5>Available actions:</h5>
                        <button type="submit" name="savemenub" class="btn btn-success">Save menu</button>
                        <button type="submit" name="deletemenub" onClick='return confirmSubmit()' class="btn btn-danger">Delete menu</button>
            <?php }
            ?>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        </div>
    <?php  }  catch (PDOException $error) {
        $failure = "<br>" . $error->getMessage();
    }
}
?>
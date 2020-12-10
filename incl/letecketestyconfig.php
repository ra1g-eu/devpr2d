<?php
include_once("config.php");
$updating = false;
$success = "";
$failure = "";
$connection = new PDO($dsn, $username, $password, $options);
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    try {
        //LOAD PEEPORUN CHANGELOG
        if (isset($_GET['leteckytest'])) {
            $id = $_GET['leteckytest'];
            $sql = "SELECT * FROM changeloglt WHERE id = :id";
            $statement = $connection->prepare($sql);
            $statement->bindValue(':id', $id);
            $statement->execute();
            $LTCH = $statement->fetch(PDO::FETCH_ASSOC);
            $updating = true;
        }
        if (isset($_GET['leteckytestdelete'])) {
            $connection = new PDO($dsn, $username, $password, $options);
            $id = $_GET['leteckytestdelete'];
            $sql = "DELETE FROM changeloglt WHERE id = :id";
            $statement = $connection->prepare($sql);
            $statement->bindValue(':id', $id);
            $statement->execute();
            $success = "Letecký Test changelog removed! Refresh in 2 seconds.";
            echo('<meta http-equiv="refresh" content="2;url=../lt/index.php">');
        }
    } catch (PDOException $error) {
        $failure = "<br>" . $error->getMessage();
    }
}
/** LOAD CHANGELOGS END **/

/** UPDATE && DELETE CHANGELOGS -------> FUNGUJE **/
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        if (isset($_POST['btnUpdateLT'])) {
            $id = $_POST['idname'];
            $version = $_POST['version'];
            $date = $_POST['date'];
            $text = $_POST['changelogtext'];
            $statement = $connection->prepare("UPDATE changeloglt SET date=:date, version=:version, text=:text WHERE id=:id");
            $statement->bindParam(':id', $id, PDO::PARAM_INT);
            $statement->bindValue(':date', $date);
            $statement->bindValue(':version', $version);
            $statement->bindValue(':text', $text);
            $statement->execute();
            $success = "Letecké Testy Changelog updated! Refresh in 2 seconds.";
            //var_dump($statement->debugDumpParams());
            echo('<meta http-equiv="refresh" content="2;url=../lt/releasenotes.php">');
        }
        /**   button btnDeleteCH   */
        if(isset($_POST['btnDeleteLT'])){
            $id = $_POST['idname'];
                $statement = $connection->prepare("DELETE FROM changeloglt WHERE id = :id");
                $statement->bindValue(':id', $id);
                $statement->execute();
                $success = "Letecké Testy Changelog removed! Refresh in 2 seconds.";
                echo('<meta http-equiv="refresh" content="2;url=../lt/releasenotes.php">');
        }
    } catch (PDOException $error) {
        $failure = "<br>" . $error->getMessage();
    }
}
/** UPDATE && DELETE CHANGELOGS END **/

/** ADD NEW CHANGELOGS ---------> FUNGUJE */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        if (isset($_POST['btnAddNewLT'])) {
            $new_changelog = array(
                "version" => $_POST['version'],
                "date" => $_POST['date'],
                "text" => $_POST['changelogtext']
            );
                $sql = sprintf(
                    "INSERT INTO %s (%s) values (%s)",
                    "changeloglt",
                    implode(", ", array_keys($new_changelog)),
                    ":" . implode(", :", array_keys($new_changelog))
                );
                $statement = $connection->prepare($sql);
                $statement->execute($new_changelog);
                $success = "Letecké Testy changelog added! Refresh in 2 seconds.";
                echo('<meta http-equiv="refresh" content="2;url=../lt/releasenotes.php">');
        }

    } catch (PDOException $error) {
        echo "<br>" . $error->getMessage();
    }
}
function getPreviousVersionsLT($connection){
    $sql = "SELECT version FROM changeloglt ORDER BY version DESC ";
    $stmt = $connection->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function getLTchangelog($connection){
    $sql = "SELECT * FROM changeloglt ORDER BY version DESC ";
    $stmt = $connection->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


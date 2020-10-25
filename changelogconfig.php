<?php
include_once ("config.php");
$updating = false;
$peeporun = false;
$ra1glauncher = false;
$websitechangelog = false;
$success = "";
$connection = new PDO($dsn, $username, $password, $options);
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    try {
        //LOAD PEEPORUN CHANGELOG
        if (isset($_GET['peeporun'])) {
            $id = $_GET['peeporun'];
            $sql = "SELECT * FROM changelogpr WHERE id = :id";
            $statement = $connection->prepare($sql);
            $statement->bindValue(':id', $id);
            $statement->execute();
            $prch = $statement->fetch(PDO::FETCH_ASSOC);
            $updating = true;
            $peeporun = true;
        }
//LOAD RA1GLAUNCHER CHANGELOG
        if (isset($_GET['ra1glauncher'])) {
            $ra1glauncher = true;
            $id = $_GET['ra1glauncher'];
            $sql = "SELECT * FROM changelogrl WHERE id = :id";
            $statement = $connection->prepare($sql);
            $statement->bindValue(':id', $id);
            $statement->execute();
            $prch = $statement->fetch(PDO::FETCH_ASSOC);
            $updating = true;

        }
//LOAD WEBSITE CHANGELOG
        if (isset($_GET['websitechangelog'])) {
            $websitechangelog = true;
            $id = $_GET['websitechangelog'];
            $sql = "SELECT * FROM changelogsite WHERE id = :id";
            $statement = $connection->prepare($sql);
            $statement->bindValue(':id', $id);
            $statement->execute();
            $prch = $statement->fetch(PDO::FETCH_ASSOC);
            $updating = true;
        }
        /** DELETE CHANGELOGS -------> FUNGUJE **/
        if (isset($_GET['deleteselected'])) {
            if ($peeporun = true) {
                $id = $_GET['deleteselected'];
                $sql = "DELETE FROM changelogpr WHERE id = :id";
                $statement = $connection->prepare($sql);
                $statement->bindValue(':id', $id);
                $statement->execute();
                $success = "Changelog deleted!";
                header("refresh:2;url=changelogpr.php");
                $peeporun = false;
            } else if ($ra1glauncher) {
                $id = $_GET['deleteselected'];
                $sql = "DELETE FROM changelogrl WHERE id = :id";
                $statement = $connection->prepare($sql);
                $statement->bindValue(':id', $id);
                $statement->execute();
                $success = "Changelog deleted!";
                header("refresh:2;url=changelogrl.php");
                $ra1glauncher = false;
            } else if ($websitechangelog) {
                $id = $_GET['deleteselected'];
                $sql = "DELETE FROM changelogsite WHERE id = :id";
                $statement = $connection->prepare($sql);
                $statement->bindValue(':id', $id);
                $statement->execute();
                $success = "Changelog deleted!";
                $websitechangelog = false;
                header("refresh:2;url=changelogsite.php");
            }
        }
        /** DELETE CHANGELOGS END **/
    } catch (PDOException $error) {
        echo "<br>" . $error->getMessage();
    }
}
/** ADD NEW CHANGELOGS ---------> FUNGUJE */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        if (isset($_POST['btnAddNew'])) {
            $new_changelog = array(
                "version" => $_POST['version'],
                "date" => $_POST['date'],
                "text" => $_POST['changelogtext']
            );
            $ctgry = $_POST['category'];
            if ($ctgry === 'PR') {
                $sql = sprintf(
                    "INSERT INTO %s (%s) values (%s)",
                    "changelogpr",
                    implode(", ", array_keys($new_changelog)),
                    ":" . implode(", :", array_keys($new_changelog))
                );
                $statement = $connection->prepare($sql);
                $statement->execute($new_changelog);
                $success = "Changelog added!";
                header("refresh:2;url=changelogpr.php");
            } else if ($ctgry === 'RL') {
                $sql = sprintf(
                    "INSERT INTO %s (%s) values (%s)",
                    "changelogrl",
                    implode(", ", array_keys($new_changelog)),
                    ":" . implode(", :", array_keys($new_changelog))
                );
                $statement = $connection->prepare($sql);
                $statement->execute($new_changelog);
                $success = "Changelog added!";
                header("refresh:2;url=changelogrl.php");
            } else if ($ctgry === 'WEB') {
                $sql = sprintf(
                    "INSERT INTO %s (%s) values (%s)",
                    "changelogsite",
                    implode(", ", array_keys($new_changelog)),
                    ":" . implode(", :", array_keys($new_changelog))
                );
                $statement = $connection->prepare($sql);
                $statement->execute($new_changelog);
                $success = "Changelog added!";
                header("refresh:2;url=changelogsite.php");
            }
        }

    } catch (PDOException $error) {
        echo "<br>" . $error->getMessage();
    }
}

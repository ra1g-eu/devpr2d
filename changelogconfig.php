<?php
include_once ("config.php");
$updating = false;
$peeporun = false;
$ra1glauncher = false;
$websitechangelog = false;
$success = "";
$failure = "";
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
            $id = $_GET['ra1glauncher'];
            $sql = "SELECT * FROM changelogrl WHERE id = :id";
            $statement = $connection->prepare($sql);
            $statement->bindValue(':id', $id);
            $statement->execute();
            $prch = $statement->fetch(PDO::FETCH_ASSOC);
            $updating = true;
            $ra1glauncher = true;
        }
//LOAD WEBSITE CHANGELOG
        if (isset($_GET['websitechangelog'])) {
            $id = $_GET['websitechangelog'];
            $sql = "SELECT * FROM changelogsite WHERE id = :id";
            $statement = $connection->prepare($sql);
            $statement->bindValue(':id', $id);
            $statement->execute();
            $prch = $statement->fetch(PDO::FETCH_ASSOC);
            $updating = true;
            $websitechangelog = true;
        }
        //delete
        if (isset($_GET['deleteselected'])) {
            if ($peeporun == true) {
                $id = $_GET['deleteselected'];
                $sql = "DELETE FROM changelogpr WHERE id = :id";
                $statement = $connection->prepare($sql);
                $statement->bindValue(':id', $id);
                $statement->execute();
                $success = "Changelog deleted!";
                header("refresh:2;url=changelogpr.php");
                $peeporun = false;
            } else if ($ra1glauncher == true) {
                $id = $_GET['deleteselected'];
                $sql = "DELETE FROM changelogrl WHERE id = :id";
                $statement = $connection->prepare($sql);
                $statement->bindValue(':id', $id);
                $statement->execute();
                $success = "Changelog deleted!";
                header("refresh:2;url=changelogrl.php");
                $ra1glauncher = false;
            } else if ($websitechangelog == true) {
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
    } catch (PDOException $error) {
        $failure = "<br>" . $error->getMessage();
    }
}
/** DELETE CHANGELOGS END **/

/** UPDATE CHANGELOGS -------> FUNGUJE **/
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        if (isset($_POST['btnUpdate'])) {
            $id = $_POST['idname'];
            $version = $_POST['version'];
            $date = $_POST['date'];
            $text = $_POST['changelogtext'];
            $ctgry = $_POST['category'];
            if ($ctgry === 'WEB')
            {
                $statement = $connection->prepare("UPDATE changelogsite SET date=:date, version=:version, text=:text WHERE id=:id");
                $success = "Website Changelog updated!";
            }
            if ($ctgry === 'RL')
            {
                $statement = $connection->prepare("UPDATE changelogrl SET date=:date, version=:version, text=:text WHERE id=:id");
                $success = "Launcher Changelog updated!";
            }
            if ($ctgry === 'PR')
            {
                $statement = $connection->prepare("UPDATE changelogpr SET date=:date, version=:version, text=:text WHERE id=:id");
                $success = "Game Changelog updated!";
            }
            $statement->bindParam(':id', $id, PDO::PARAM_INT);
            $statement->bindValue(':date', $date);
            $statement->bindValue(':version', $version);
            $statement->bindValue(':text', $text);
            $statement->execute();
            $websitechangelog = false;
            $peeporun = false;
            $ra1glauncher = false;
            //var_dump($statement->debugDumpParams());
            header("refresh:2;url=index.php");
        }
    } catch (PDOException $error) {
        $failure = "<br>" . $error->getMessage();
        $websitechangelog = false;
        $peeporun = false;
        $ra1glauncher = false;
    }
}
/** UPDATE CHANGELOGS END **/

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

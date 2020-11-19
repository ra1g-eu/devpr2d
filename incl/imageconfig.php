<?php
include_once("config.php");
$connection = new PDO($dsn, $username, $password, $options);
$updating = false;
$success = "";
$failure = "";

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    try {
        if (isset($_GET['imageupdate'])) {
            $id = $_GET['imageupdate'];
            $sql = "SELECT * FROM imagegallery WHERE idimage = :idimage";
            $statement = $connection->prepare($sql);
            $statement->bindValue(':idimage', $id);
            $statement->execute();
            $imgloaded = $statement->fetch(PDO::FETCH_ASSOC);
            $updating = true;
        }
    } catch (PDOException $error) {
        $failure = "<br>" . $error->getMessage();
    }
}


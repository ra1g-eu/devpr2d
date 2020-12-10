<?php
require __DIR__ . '/../incl/config.php';
$connection = new PDO($dsn, $username, $password, $options);
function getUsers($conn)
{
    $sql = "SELECT userid, username, role FROM users";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function getUsersCount($conn)
{
    $sql = "SELECT COUNT(userid) as usrcount FROM users";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function getArticleCount($conn)
{
    $sql = "SELECT COUNT(news_id) as newscount FROM news";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function getImagesCount($conn)
{
    $sql = "SELECT COUNT(idimage) as imagescount FROM imagegallery";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getUsersById($id, $conn)
{
    $sql = "SELECT userid, username, role FROM users WHERE userid=:userid";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':userid', $id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getMenu($conn)
{
    $request = $conn->prepare("SELECT idmenu, meno, file_path, icon, menuorder FROM menu");
    return $request->execute() ? $request->fetchAll(PDO::FETCH_ASSOC) : false;
}

function getMenuById($id, $conn)
{
    $sql = "SELECT idmenu, meno, file_path, icon, menuorder FROM menu WHERE idmenu=:idmenu";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':idmenu', $id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getOldReleases($conn)
{
    $sql = "SELECT * FROM releases WHERE islatest='no'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function getLatestReleases($conn)
{
    $sql = "SELECT * FROM releases WHERE islatest='yes'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function getOldGameReleases($conn)
{
    $sql = "SELECT * FROM releases WHERE islatest='no' AND name like '%peepo%'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function getResourcesRa1g($conn){
    $sql = "SELECT * FROM resourcespage";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


<?php
require __DIR__ . '/../incl/config.php';
$connection = new PDO($dsn, $username, $password, $options);
function getUsers($conn)
{
    $request = $conn->prepare(" SELECT id, username, role FROM users ORDER BY id");
    return $request->execute() ? $request->fetchAll(PDO::FETCH_ASSOC) : false;
}
function getMenu($conn)
{
    $request = $conn->prepare(" SELECT idmenu, meno, file_path, icon, menuorder FROM menu ORDER BY menuorder");
    return $request->execute() ? $request->fetchAll(PDO::FETCH_ASSOC) : false;
}
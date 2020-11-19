<?php
require 'config.php';
$connection = new PDO($dsn, $username, $password, $options);
if(isset($_POST['username'])){
    $username =$_POST['username'];
        $sql = "SELECT count(*) as usrcnt FROM users WHERE username=:username";
        $stmt = $connection->prepare($sql);
        $stmt->bindValue(':username', $username, PDO::PARAM_STR);
        $stmt->execute();
        $count = $stmt->fetchColumn();
    $response = "Available";
    if($count > 0){
        $response = "Not available";
    }
    echo $response;
    exit;
}
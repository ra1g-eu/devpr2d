<?php
require 'config.php';
$connection = new PDO($dsn, $username, $password, $options);
if(isset($_POST['usernamereg'])){
    $username =$_POST['usernamereg'];
        $sql = "SELECT count(*) as usrcnt FROM users WHERE username=:usernamereg";
        $stmt = $connection->prepare($sql);
        $stmt->bindValue(':usernamereg', $username, PDO::PARAM_STR);
        $stmt->execute();
        $count = $stmt->fetchColumn();
    $response = "<span id='status' class='badge bg-success text-center text-capitalize'>Username is available</span>";
    if($count > 0){
        $response = "<span id='status' class='badge bg-danger text-center text-capitalize'>Username is not available</span>";
    }
    echo $response;
    exit;
}
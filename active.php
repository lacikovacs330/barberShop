<?php

require "includes/functions.php";

$code = "";

$connection = connectDatabase($dsn, $pdoOptions);

$token = $_GET['token'];

if (!empty($token)){

    $sql = "UPDATE users SET status = 1  WHERE token = :token";
    $stmt = $connection->prepare($sql);
    $stmt->bindParam(':token', $token, PDO::PARAM_STR);
    $stmt->execute();

    if ($stmt->rowCount() == 1) {
        redirection('login.php?r=6');
    }
    else {
        redirection('login.php?r=11');
    }
}
else {
    redirection('login.php?r=0');
}
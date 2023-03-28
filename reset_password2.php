<?php

session_start();

include "includes/config.php";
include "includes/db_config.php";

$conn = connectDatabase($dsn, $pdoOptions);

/*
 * $sql = "UPDATE users SET status = 1  WHERE token = :token";
    $stmt = $connection->prepare($sql);
    $stmt->bindParam(':token', $token, PDO::PARAM_STR);
    $stmt->execute();
 */



if (isset($_POST["sb-change"]) and isset($_POST["password"]) and !empty($_POST["password"]) and isset($_POST["password2"]) and !empty($_POST["password2"]))
{

    $pass = $_POST["password"];
    $pass2 = $_POST["password2"];
    $password_hash = password_hash($pass, PASSWORD_BCRYPT);


    $email2 = $_SESSION["email2"];

    if ($pass != $pass2)
    {
        header("Location:reset_password.php?error=5");
    }
    else
    {
        $sql = "UPDATE users SET password = '$password_hash'  WHERE email = :email";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $email2, PDO::PARAM_STR);
        $stmt->execute();

        header("Location:login.php?r=7");

    }


}
else
{
    header("Location:reset_password.php?error=1");
}

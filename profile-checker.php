<?php
include "includes/config.php";
include "includes/db_config.php";
session_start();

$conn = connectDatabase($dsn, $pdoOptions);


if (isset($_POST["success-sb"]))
{
    if (isset($_POST["uname"]) and !empty($_POST["uname"]))
    {
        $uname = $_POST["uname"];
        $id = $_SESSION["id_user"];

        $sql = "UPDATE users SET username = '$uname'  WHERE id_user = :id_user";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id_user', $id, PDO::PARAM_STR);
        $stmt->execute();
        header("Location:profile.php?p=7");
    }
    else
    {
        header("Location:profile.php?p=8");
    }

    if (isset($_POST["password"]) and !empty($_POST["password"]) and isset($_POST["password2"]) and !empty($_POST["password2"]))
    {
        $password = $_POST["password"];
        $id = $_SESSION["id_user"];
        $hashed_pass = password_hash($password, PASSWORD_BCRYPT);

        if ($password != $_POST["password2"])
        {
            header("Location:profile.php?p=6");
        }
        else
        {
            if (!password_verify($password, $_SESSION["password1"]))
            {
                $sql = "UPDATE users SET password = '$hashed_pass'  WHERE id_user = :id_user";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':id_user', $id, PDO::PARAM_STR);
                $stmt->execute();
                header("Location:profile.php?p=7");
            }
            else
            {
                header("Location:profile.php?p=10");
            }
        }
    }


}
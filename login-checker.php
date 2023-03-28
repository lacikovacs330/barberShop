<?php
session_start();

include "includes/config.php";
include "includes/db_config.php";

$conn = connectDatabase($dsn, $pdoOptions);



if (isset($_POST["sb-login"]) and isset($_POST["usname"]) and !empty($_POST["usname"]) and isset($_POST["password"]) and !empty($_POST["password"]))
{
    $username = $_POST["usname"];
    $password = $_POST["password"];
    $stmt = $conn->query("SELECT * FROM users WHERE username = '$username' ");
    if ($row = $stmt->fetch()) {
        $role = $row["role"];
        $_SESSION["role"] = $role;
        $usname = $row["username"];
        $id_user = $row["id_user"];
        $_SESSION["un"] = $usname;
        $_SESSION["id_user"] = $id_user;
        $pass = $row["password"];
        $_SESSION["password1"] = $pass;
        $token = $row["token"];
        $status = $row["status"];

        if (password_verify($password, $pass))
        {
            if ($status === 0)
            {
                header("Location:login.php?error=5");
            }
            else
            {
            header("Location:index.php");
            }
        }
        else
        {
            header("Location:login.php?error=1");
        }
    }
    else
    {
        header("Location:login.php?error=1");
    }
}
else
{
    header("Location:login.php?error=1");
}

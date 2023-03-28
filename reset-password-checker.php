<?php
include "includes/functions.php";

$conn = connectDatabase($dsn, $pdoOptions);

if (isset($_POST["sb-reset"]) and isset($_POST["email"]) and  !empty($_POST["email"]))
{
    $email = $_POST["email"];

    $stmt = $conn->query("SELECT * FROM users WHERE email = '$email'");
    if ($row = $stmt->fetch()) {
        if ($email == isset($row["email"]))
        {
            ResetPassword($email, "Jelszo valtas");
            header("Location:reset-password.php");
        }
    }
    else
    {
        header("Location:password.php?error=2");
    }

}
else
{
    header("Location:password.php?error=1");
}

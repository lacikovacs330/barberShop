<?php

session_start();

include "includes/functions.php";

$conn = connectDatabase($dsn, $pdoOptions);

if (isset($_POST["add"]) and isset($_POST["username"]) and !empty($_POST["username"]) and isset($_POST["fname"]) and !empty($_POST["fname"]) and isset($_POST["lname"]) and !empty($_POST["lname"]) and isset($_POST["pass"]) and !empty($_POST["pass"]) and isset($_POST["email"]) and !empty($_POST["email"]) and isset($_POST["image"]) and !empty($_POST["image"]))
{
    $username = $_POST["username"];
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $pass = $_POST["pass"];
    $pass_hash = password_hash($pass, PASSWORD_BCRYPT);
    $email = $_POST["email"];
    $image = $_POST["image"];
    $token = bin2hex(random_bytes(16));


    $pdoQuery = $conn->prepare("INSERT INTO users (username,firstname,lastname,password,email,token,status,role) VALUES (?,?,?,?,?,?,?,?)");
    $pdoQuery->execute([$username,$fname,$lname,$pass_hash,$email,$token,'0','worker']);

    $stmt = $conn->query("SELECT * FROM users WHERE username = '$username' ");
    if ($row = $stmt->fetch()) {
        $id = $row["id_user"];

            $stmt = $conn->query("SELECT * FROM salons WHERE id_user = '$_SESSION[id_user]'");
            if ($row = $stmt->fetch()) {
                $id_salon = $row["id_salon"];
                $_SESSION["id_salon"] = $id_salon;

                $pdoQuery = $conn->prepare("INSERT INTO workers (id_salon,id_user,image,firstname,lastname) VALUES (?,?,?,?,?)");
                $pdoQuery->execute([$id_salon,$id,$image,$fname,$lname]);

                sendMail($token, $email, "Register");
                header("Location:salon_info.php?ok=1");
                
        }
    }
    else
    {
        header("Location:salon_info.php?error=1");
    }
}
else
{
    header("Location:salon_info.php?error=1");
}
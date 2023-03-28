<?php
session_start();

include "includes/functions.php";

$conn = connectDatabase($dsn, $pdoOptions);

if (isset($_POST["add"]) and isset($_POST["username"]) and !empty($_POST["username"]) and isset($_POST["fname"]) and !empty($_POST["fname"]) and isset($_POST["lname"]) and !empty($_POST["lname"]) and isset($_POST["pass"]) and !empty($_POST["pass"]) and isset($_POST["email"]) and !empty($_POST["email"]) and isset($_POST["salon"]) and !empty($_POST["salon"]) and isset($_POST["image"]) and !empty($_POST["image"]) and isset($_POST["description"]) and !empty($_POST["description"]))
{
    $ownername = $_POST["username"];
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $pass = $_POST["pass"];
    $pass_hash = password_hash($pass, PASSWORD_BCRYPT);
    $email = $_POST["email"];
    $salon = $_POST["salon"];
    $image = $_POST["image"];
    $token = bin2hex(random_bytes(16));
    $desc = $_POST["description"];

    $pdoQuery = $conn->prepare("INSERT INTO users (username,firstname,lastname,password,email,token,status,role) VALUES (?,?,?,?,?,?,?,?)");
    $pdoQuery->execute([$ownername,$fname,$lname,$pass_hash,$email,$token,'0','owner']);

    $stmt = $conn->query("SELECT * FROM users WHERE username = '$ownername' ");
    if ($row = $stmt->fetch()) {
        $id = $row["id_user"];
        sendMail($token, $email, "Register");

        $pdoQuery = $conn->prepare("INSERT INTO salons (id_user,name,image,description,status,ban) VALUES (?,?,?,?,?,?)");
        $pdoQuery->execute([$id,$salon,$image,$desc,0,0]);

        header("Location:add_salon.php?ok=1");
    }

}
else
{
    header("Location:add_salon.php?error=1");
}

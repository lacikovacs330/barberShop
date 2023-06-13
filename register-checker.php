<?php

include "includes/functions.php";

$conn = connectDatabase($dsn, $pdoOptions);

if (isset($_POST["sub"]) and isset($_POST["usname"]) and !empty($_POST["usname"]) and isset($_POST["fname"]) and !empty($_POST["fname"]) and isset($_POST["lname"]) and !empty($_POST["lname"]) and isset($_POST["pass1"]) and !empty($_POST["pass1"]) and isset($_POST["pass2"]) and !empty($_POST["pass2"]) and isset($_POST["email"]) and !empty($_POST["email"]))
{
    $username = $_POST["usname"];
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $email = $_POST["email"];
    $password1 = $_POST["pass1"];
    $password2 = $_POST["pass2"];
    $token = bin2hex(random_bytes(16));
    $hashed_pass = password_hash($password1, PASSWORD_BCRYPT);

    $sthandler = $conn->prepare("SELECT username FROM users WHERE username = :name");
    $sthandler->bindParam(':name', $username);
    $sthandler->execute();
    if($sthandler->rowCount() > 0){
        header("Location:register.php?error=4");
    }
    else
    {
        if ($password1 != $password2)
        {
            header("Location:register.php?error=2");
        }
        else
        {
            $stmt = $conn->prepare("SELECT * FROM users WHERE email=?");
            $stmt->execute([$email]);
            $user = $stmt->fetch();
            if ($user)
            {
                header("Location:register.php?error=7");
            }
            else
            {
                $pdoQuery = $conn->prepare("INSERT INTO users (username,firstname,lastname,password,email,token,status,role) VALUES 				(?,?,?,?,?,?,?,?)");
                $pdoQuery->execute([$username,$fname,$lname,$hashed_pass,$email,$token,'0','user']);
                sendMail($token, $email, "Register");
                header("Location:login.php?r=5");
            }
        }
    }
}
else
{
    header("Location:register.php?error=1");
}

<?php
session_start();

include "includes/functions.php";

$conn = connectDatabase($dsn, $pdoOptions);

if (isset($_POST["add"]) and isset($_POST["username"]) and !empty($_POST["username"]) and isset($_POST["fname"]) and !empty($_POST["fname"]) and isset($_POST["lname"]) and !empty($_POST["lname"]) and isset($_POST["pass"]) and !empty($_POST["pass"]) and isset($_POST["email"]) and !empty($_POST["email"]) and isset($_POST["salon"]) and !empty($_POST["salon"]) and isset($_FILES["image"]["name"]) and !empty($_FILES["image"]["name"]) and isset($_POST["description"]) and !empty($_POST["description"]))
{
    $ownername = $_POST["username"];
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $pass = $_POST["pass"];
    $pass_hash = password_hash($pass, PASSWORD_BCRYPT);
    $email = $_POST["email"];
    $salon = $_POST["salon"];
    $image = $_FILES["image"]["tmp_name"];
    $token = bin2hex(random_bytes(16));
    $desc = $_POST["description"];

    $sthandler = $conn->prepare("SELECT username FROM users WHERE username = :name");
    $sthandler->bindParam(':name', $ownername);
    $sthandler->execute();
    if($sthandler->rowCount() > 0){
        header("Location:add_salon.php?error=2");
    }
    else
    {
        $stmt = $conn->prepare("SELECT * FROM users WHERE email=?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();
        if ($user)
        {
            header("Location:add_salon.php?error=3");
        }
        else
        {
            $stmt = $conn->prepare("SELECT * FROM salons WHERE name=?");
            $stmt->execute([$salon]);
            $user = $stmt->fetch();
            if ($user)
            {
                header("Location:add_salon.php?error=4");
            }
            else
            {
                $stmt = $conn->prepare("SELECT * FROM salons WHERE image=?");
                $stmt->execute([$image]);
                $user = $stmt->fetch();
                if ($user)
                {
                    header("Location:add_salon.php?error=5");
                }
                else
                {
                    $pdoQuery = $conn->prepare("INSERT INTO users (username,firstname,lastname,password,email,token,status,role) VALUES (?,?,?,?,?,?,?,?)");
                    $pdoQuery->execute([$ownername,$fname,$lname,$pass_hash,$email,$token,'0','owner']);

                    $stmt = $conn->query("SELECT * FROM users WHERE username = '$ownername' ");
                    if ($row = $stmt->fetch()) {
                        $id = $row["id_user"];				
				
				sendMail($token, $email, "Register");

				$targetPath = "img/";
				$targetFile = $targetPath . basename($_FILES['image']['name']);
				move_uploaded_file($_FILES['image']['tmp_name'], $targetFile);


				$pdoQuery = $conn->prepare("INSERT INTO salons (id_user, name, image, description, status, ban) VALUES 						(?, ?, ?, ?, ?, ?)");
				$pdoQuery->execute([$id, $salon, basename($_FILES['image']['name']), $desc, 0, 0]);



	
		
                        header("Location:add_salon.php?ok=1");
                    }
                }
            }
        }
    }

}
else
{
    header("Location:add_salon.php?error=1");
}

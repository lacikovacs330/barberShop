<?php
session_start();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <style>
        body{
            width: 100%;
            height: 500px;
            justify-content: center;
            margin: 0;
            background-image: url("img/vintage-border-salon-tools-wooden-table-jobs-career-concept.jpg");
            background-size: contain;
            background-repeat: repeat;
            background-size: 100%;

        }
    </style>
</head>
<body>
<div class="login-system">
    <div class="login-title">
        <a><b>Bejelentkezés</b></a>
    </div><br>
    <hr>
    <div class="login-inputs">
        <form action="login-checker.php" method="post">
            <label for="fname">Felhasználónév</label>
            <input type="text" id="usname" name="usname" placeholder="Felhasználónév">

            <label for="lname">Jelszó</label>
            <input type="password" id="password" name="password" placeholder="Jelszó">

            <a>Nincs fiókod? Regisztrálj <a href="register.php">itt</a>!</a><br>

            <a href="password.php">Elfelejtett jelszó</a>
            <?php

            if (isset($_GET["error"]) && $_GET["error"] == 1)
            {
                echo "<div class='error1'><a>Hiba van! Töltsön ki minden mezőt!</a></div>";
            }

            if (isset($_GET["error"]) && $_GET["error"] == 5)
            {
                echo "<div class='error1'><a>Aktiválja a fiókját!</a></div>";
            }

		if (isset($_GET["r"]) && $_GET["r"] == 5)
            {
                echo "<div class='ok1'><a>Aktiválja a fiókját!</a></div>";
            }

            if (isset($_GET["r"]) && $_GET["r"] == 6)
            {
                echo "<div class='ok1'><a>Aktiválta fiókját!</a></div>";
            }

            if (isset($_GET["r"]) && $_GET["r"] == 7)
            {
                echo "<div class='ok1'><a>Jelszó megváltoztatva!</a></div>";
            }

            ?>

            <input type="submit" value="Bejelentkezés" id="sb-login" name="sb-login">
        </form>
    </div>
</div>
</body>
</html>


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
        <a><b>Elfelejtett jelszó</b></a>
    </div><br>
    <hr>
    <div class="login-inputs">
        <form action="reset-password-checker.php" method="post">
            <label for="fname">E-mail</label>
            <input type="email" id="email" name="email" placeholder="E-mail...">

            <?php

            if (isset($_GET["error"]) && $_GET["error"] == 1)
            {
            echo "<div class='error1'><a>Hiba van! Töltsön ki minden mezőt!</a></div>";
            }

            if (isset($_GET["error"]) && $_GET["error"] == 2)
            {
                echo "<div class='error1'><a>Nincs ilyen e-mail!</a></div>";
            }

            ?>

            <input type="submit" value="Tovább" id="sb-reset" name="sb-reset">
        </form>
    </div>
</div>
</body>
</html>


<?php
include "includes/nav.php";

$conn = connectDatabase($dsn, $pdoOptions);

$stmt = $conn->prepare("Select * from users WHERE id_user = '$_SESSION[id_user]'");
$stmt->execute();
$rows = $stmt->fetchAll();
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

        @media only screen and (max-width: 1040px) {
            body{
                background-repeat: repeat;
            }
        }

        @media only screen and (max-width: 605px) {
            .appointments-system{
                width: 50%;
            }
        }
    </style>
</head>
<body>
<div class="appointments-system">
    <div class="login-title">
        <a><b>Időpont foglalás</b></a>
    </div><br>
    <hr class="appointments-hr">
    <div class="appointments-inputs">
       <form action="reserv.php" method="post">
             <label for="email">Időpont</label>
            <input type="text" id="hour" name="hour" readonly value="<?php echo $_POST["asd"]; ?>">
            <?php $_SESSION["asd3"] = $_POST["asd"]; ?>
            <label for="email">Dátum</label>
            <input type="text" id="day" name="day" readonly value="<?php echo $_POST["day"]; ?>">
            <?php $_SESSION["day3"] = $_POST["day"]; ?>
            <label for="email">Ár</label>
            <input type="text" id="price" name="price" readonly value="<?php echo $_SESSION["price1"]; ?>">
            <label for="email">Időtartam</label>
            <input type="text" id="time" name="time" readonly value="<?php echo $_SESSION["duration1"]; ?>">
            <label for="username">Szolgáltatás neve:</label>
            <input type="text" id="s_name" name="s_name" readonly value="<?php echo $_SESSION["service_name1"]; ?>">
            <label for="username">Felhasználónév</label>
            <input type="text" id="username" name="username" readonly value="<?php echo $_SESSION["un"] ?>";>
            <label for="email">E-mail</label>
            <input type="text" id="email" name="email" placeholder="E-mail">


            <input hidden="hidden" type="text" id="id_w" name="id_w" readonly value="<?php echo $_SESSION["id_user1"]; ?>">
            <input hidden="hidden" type="text" id="id_s" name="id_s" readonly value="<?php echo $_SESSION["id_salon1"]; ?>">
            <input hidden="text" type="text" id="id_u" name="id_u" readonly value="<?php echo $_SESSION["id_user1"]; ?>">

            <?php
            if (isset($_GET["r"]) && $_GET["r"] == 6)
            {
            echo "<div class='ok1'><a>Lefoglalva!</a></div>";
            }
            ?>
            <input type="submit" id="reserv-sb" name="reserv-sb" value="Foglalás">
        </form>
    </div>
</div>
</body>
</html>



<?php
include "includes/footer.php";
?>

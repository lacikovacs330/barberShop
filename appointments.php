<?php
include "includes/nav.php";

if (isset($_GET["time"])){
    $time = $_GET["time"];
}
else
{
    header("Location:index.php");
}

if (isset($_GET["day"])){
    $id = $_GET["day"];
}
else
{
    header("Location:index.php");
}

if (isset($_GET["price"])){
    $id = $_GET["price"];
}
else
{
    header("Location:index.php");
}

if (isset($_GET["duration"])){
    $duration = $_GET["duration"];
}
else
{
    header("Location:index.php");
}

if (isset($_SESSION["un"])){
}
else
{
    header("Location:index.php");
}

if (isset($_GET["id_worker_user"])){
    $id = $_GET["id_worker_user"];
}
else
{
    header("Location:index.php");
}

if (isset($_GET["id_salon"])){
    $id = $_GET["id_salon"];
}
else
{
    header("Location:index.php");
}

if (isset($_GET["id_user"])){
    $id = $_GET["id_user"];
}
else
{
    header("Location:index.php");
}

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
        }

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
            <input type="text" id="hour" name="hour" readonly value="<?php echo $time; ?>">
            <label for="email">Nap</label>
            <input type="text" id="day" name="day" readonly value="<?php echo $_GET["day"]; ?>">
            <label for="email">Ár</label>
            <input type="text" id="price" name="price" readonly value="<?php echo $_GET["price"]; ?>">
            <label for="email">Időtartam</label>
            <input type="text" id="time" name="time" readonly value="<?php echo $_GET["duration"]; ?>">
            <label for="username">Felhasználónév</label>
            <input type="text" id="username" name="username" readonly value="<?php echo $_SESSION["un"]; ?>";>
            <label for="email">E-mail</label>
            <input type="text" id="email" name="email" placeholder="E-mail">


            <input hidden="hidden" type="text" id="id_w" name="id_w" readonly value="<?php echo $_GET["id_worker_user"]; ?>">
            <input hidden="hidden" type="text" id="id_s" name="id_s" readonly value="<?php echo $_GET["id_salon"]; ?>">
            <input hidden="hidden" type="text" id="id_u" name="id_u" readonly value="<?php echo $_GET["id_user"]; ?>">

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

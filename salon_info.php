<?php

include "includes/nav.php";

$d = date("Y-m-d");

$conn = connectDatabase($dsn, $pdoOptions);


if (isset($_GET["id"])){
    $id = $_GET["id"];
}
else
{
    header("Location:salons.php");
}

$sql = "SELECT * FROM workers WHERE id_salon = '$id'";
$stmt = $conn->prepare($sql);
$stmt->execute();

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
    </head>
    <body>
    <h1 style="justify-content: center; text-align: center">Munkás hozzáadása</h1>
    <form action="salon_info_checker.php" method="post">
    <div class="add-salon">
        <div class="form-group row" style="justify-content: center; width: 100%">
            <div class="col-sm-7">
                <label for="exampleFormControlSelect1">Munkás felhasználónév</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Felhasználónév...">
                <br><br><br>
                <label for="exampleFormControlSelect1">Vezetéknév</label>
                <input type="text" class="form-control" id="fname" name="fname" placeholder="Vezetéknév..."><br><br><br>
                <label for="exampleFormControlSelect1">Keresztnév</label>
                <input type="text" class="form-control" id="lname" name="lname" placeholder="Keresztnév..."><br><br><br>
                <label for="exampleFormControlSelect1">Jelszó</label>
                <input type="password" class="form-control" id="pass" name="pass" placeholder="Jelszó..."><br><br><br>
                <label for="exampleFormControlFile1">E-mail</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="E-mail..."><br><br><br>
                <label for="exampleFormControlFile1">Munkás kép</label>
                <input type="file" class="form-control-file" id="image" name="image"><br><br><br>

                <?php
                if (isset($_GET["error"]) and $_GET["error"] == 1)
                {
                    echo "<div class='error1'><a>Töltsön ki minden mezőt!</a></div>";
                }

                if (isset($_GET["ok"]) and $_GET["ok"] == 1)
                {
                    echo "<div class='ok1' style='margin-top: 30px;'><a>Hozzáadva! Erősitse meg az emailt!</a></div>";
                }
                ?>
                <input type="submit" value="Hozzáadás" id="add" name="add">
    </form>
    <hr>
    <h1 style="justify-content: center; text-align: center">Munkaidő</h1><br>
    <form action="worker_hours.php" method="post">
        <select style="width: 100%; text-align: center;" name="workers" id="workers">
        <?php
        if ($stmt->rowCount() > 0) {
            foreach ($results as $row) {
                $fullname = $row["firstname"];
               $id_user = $row["id_user"];
               $_SESSION["idke"] = $id_user;
                ?>

        <?php echo "<option>$fullname</option>"?>
    <?php }?>
        <?php }?>
        </select><br><br>
    <label for="exampleFormControlFile1">Munkanap</label><br>
    <input type="date" id="days" name="days" style="width: 100%; text-align: center;"><br><br><br>

    <label for="exampleFormControlFile1">Munkaidő</label><br>
    <div class="time" style="justify-content: center; text-align: center">
        <input type="time" style="width: 40%; justify-content: center; text-align: center" name="time1" id="time1"><a>-</a><input type="time" style="width: 40%; justify-content: center; text-align: center" name="time2" id="time2">
    </div>
     <input type="submit" value="Hozzáadás" id="add_w" name="add_w">
    </form>
            </div>
        </div>
    </body>
    </html>


<?php
include "includes/footer.php";
?>
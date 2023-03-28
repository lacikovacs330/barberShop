<?php
include "includes/nav.php";

$conn = connectDatabase($dsn, $pdoOptions);

$sql = "SELECT * FROM users";
$stmt = $conn->prepare($sql);
$stmt->execute();

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);


$sql = "SELECT * FROM users WHERE role = 'user'";
$stmt = $conn->prepare($sql);
$stmt->execute();

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

$sql2 = "SELECT * FROM salons";
$stmt2 = $conn->prepare($sql2);
$stmt2->execute();

$results2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<style>

.add-salon .table
{
    width: 80%;
    text-align: center;
    justify-content: center;
    margin: 2rem auto;
}

@media only screen and (max-width: 700px) {


    th{
        font-size: 10px;
    }

    td{
        font-size: 10px;
        padding: 0 !important;
    }

    form td{
        width: 50%;
        font-size: 10px;
    }

    table.table{
        margin: 0;
    }

    th{
        padding: 0 !important;
    }

    input{
        margin: 0 !important;
    }

    .add-salon{
        text-align: center;
        justify-content: center;
        align-items: center;
    }
}

</style>

<body>

<form action="add-salon.php" method="post">
    <div class="owner-salon">
        <h1 style="justify-content: center">Tulajdonos hozzáadása</h1>
    </div>
    <hr>

    <div class="add-salon">
        <div class="form-group row" style="justify-content: center;">
            <div class="col-sm-7">
                <label for="exampleFormControlSelect1">Tulajdonos felhasználónév</label>
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
                <label for="exampleFormControlFile1">Szalon név</label>
                <input type="text" class="form-control" id="salon" name="salon" placeholder="Szalon név..."><br><br><br>
                <label for="exampleFormControlFile1">Szalon kép</label>
                <input type="file" class="form-control-file" id="image" name="image"><br><br><br>
                <label for="exampleFormControlTextarea1">Szalon leirása</label>
                <textarea class="form-control" id="description" rows="3" name="description"></textarea><br>


                <?php
                if (isset($_GET["error"]) and $_GET["error"] = 1)
                {
                    echo "<div class='error1'><a>Töltsön ki minden mezőt!</a></div>";
                }

                if (isset($_GET["ok"]) and $_GET["ok"] = 1)
                {
                    echo "<div class='ok1'><a>Hozzáadva! Erősitse meg az emailt!</a></div>";
                }
                ?>


                <input type="submit" value="Hozzáadás" id="add" name="add">
            </div>
        </div>
    </div>
</form>
    <div class="owner-salon">
        <h1 style="justify-content: center">Bannolás</h1>
    </div>
    <hr>

    <div class="add-salon">
        <table class="table">
            <thead class="thead" style="background-color: #9E8A78;">
            <tr>
                <th scope="col">Felhasználónév</th>
                <th scope="col">Vezetéknév</th>
                <th scope="col">Keresztnév</th>
                <th scope="col">E-mail</th>
                <th scope="col"></th>

            </tr>
            </thead>
            <tbody>
            <?php
            if ($stmt->rowCount() > 0) {
            foreach ($results as $row) {
                ?>
                <tr>
                    <td class="banns"><?php echo $row["username"]?></td>
                    <td class="banns"><?php echo $row["firstname"]?></td>
                    <td class="banns"><?php echo $row["lastname"]?></td>
                    <td class="banns"><?php echo $row["email"]?></td>
                <?php

                if ($row["status"] == 1) {
                    echo '<td><form action="ban.php?id_user=' . $row["id_user"] . '" method="post"><input type="submit" style="width: 70%; background-color: #ff0000; border: 0; border-radius: 5px; padding: 8px" value="Bannolás" name="ban"></form></td>';
                }
                else
                {
                    echo '<td><form action="ban.php?id_user=' . $row["id_user"] . '" method="post"><input type="submit" style="width: 70%; background-color: #ffff00; border: 0; border-radius: 5px; padding: 8px" value="Unban" name="unban"></form></td>';
                }
                ?>
            <?php } ?>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>






<div class="owner-salon">
    <h1 style="justify-content: center">Szalonadatok</h1>
</div>
<hr>

<div class="add-salon">
    <table class="table" style="width: 80%; text-align: center; justify-content: center; margin: 2rem auto;">
        <thead class="thead" style="background-color: #9E8A78;">
        <tr>
            <th scope="col">Szalon neve</th>
            <th scope="col">Szalon leirása</th>
            <th scope="col"></th>

        </tr>
        </thead>
        <tbody>
        <?php
        if ($stmt2->rowCount() > 0) {
            foreach ($results2 as $row2) {
                ?>
                <tr>
                <td><?php echo $row2["name"]?></td>
                <td><?php echo $row2["description"]?></td>
                <?php

                if ($row2["ban"] == 1) {
                    echo '<td><form action="ban.php?id_salon=' . $row2["id_salon"] . '" method="post"><input type="submit" style="width: 70%; background-color: #ffff00; border: 0; border-radius: 5px; padding: 8px" value="Unban" name="unban_salon"></form></td>';
                }
                else
                {
                    echo '<td><form action="ban.php?id_salon=' . $row2["id_salon"] . '" method="post"><input type="submit" style="width: 70%; background-color: #ff0000; border: 0; border-radius: 5px; padding: 8px" value="Bannolás" name="ban_salon"></form></td>';
                }
                ?>
            <?php } ?>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
</body>
</html>

<?php
include "includes/footer.php";
?>

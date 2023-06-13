<?php
include "includes/nav.php";

$conn = connectDatabase($dsn, $pdoOptions);

if (isset($_SESSION["id_user"]))
{
    $sql = "SELECT * FROM users WHERE id_user = '$_SESSION[id_user]'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($stmt->rowCount() > 0) {
        foreach ($results as $row) {
            if ($row["role"]!="admin")
            {
                header("Location:index.php");
            }
        }
    }
}
else
{
    header("Location:index.php");
}


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


$sql7 = "SELECT * FROM users ORDER BY id_user ASC";
$stmt7 = $conn->prepare($sql7);
$stmt7->execute();
$results7 = $stmt7->fetchAll(PDO::FETCH_ASSOC);


$sql8 = "SELECT * FROM users ORDER BY id_user ASC";
$stmt8 = $conn->prepare($sql8);
$stmt8->execute();
$results8 = $stmt8->fetchAll(PDO::FETCH_ASSOC);
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



    th{
        padding: 0 !important;
    }

    input{
        margin: 0 !important;
    }

}

</style>

<body>

<form action="add-salon.php" method="post" enctype="multipart/form-data">
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
                if (isset($_GET["error"]) and $_GET["error"] == 1)
                {
                    echo "<div class='error1'><a>Töltsön ki minden mezőt!</a></div>";
                }

                if (isset($_GET["error"]) and $_GET["error"] == 2)
                {
                    echo "<div class='error1'><a>Foglalt felhasználónév</a></div>";
                }

                if (isset($_GET["error"]) and $_GET["error"] == 3)
                {
                    echo "<div class='error1'><a>Foglalt email</a></div>";
                }

                if (isset($_GET["error"]) and $_GET["error"] == 4)
                {
                    echo "<div class='error1'><a>Foglalt szalon név</a></div>";
                }

                if (isset($_GET["error"]) and $_GET["error"] == 5)
                {
                    echo "<div class='error1'><a>Foglalt kép</a></div>";
                }

                if (isset($_GET["ok"]) and $_GET["ok"] == 1)
                {
                    echo "<div class='ok1'><a>Hozzáadva! Erősitse meg az emailt!</a></div>";
                }

                ?>


                <input type="submit" value="Hozzáadás" id="add" name="add">
            </div>
        </div>
    </div>
</form>



</body>
</html>

<?php
include "includes/footer.php";
?>

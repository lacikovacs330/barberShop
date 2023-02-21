<?php

include "includes/nav.php";

$conn = connectDatabase($dsn, $pdoOptions);

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
<body>

<hr>
<h1 style="justify-content: center; text-align: center">Szolgáltatás hozzáadása</h1>
<form action="add_services_checker.php" method="post">
    <script src="js/script.js"></script>
<div class="add-salon">
    <div class="row pt-3 gifts" style="width: 100%; margin: 0; justify-content: center; text-align: center">
        <div class="inputs" style="width: 100%; justify-content: center">
            <input type="text" class="form-control" id="asd" name="asd" style="width: 50%" placeholder="Szolgáltatás...">
            <input type="text" class="form-control" id="asd1" name="asd1" style="width: 50%" placeholder="Ár...">
            <input type="text" class="form-control" id="asd2" name="asd2" style="width: 50%" placeholder="Időtartam...">
        </div>
    </div>
    <div class="center-button" style="justify-content: center; width: 100%; text-align: center">

        <?php
        if (isset($_GET["error"]) and $_GET["error"] == 1)
        {
            echo "<div class='error1' style='width: 50%; margin: 1rem auto;'><a>Töltsön ki minden mezőt!</a></div>";
        }

        if (isset($_GET["ok"]) and $_GET["ok"] == 1)
        {
            echo "<div class='ok1' style='width: 50%; margin: 1rem auto;'><a>Hozzáadva!</a></div>";
        }
        ?>

       <input type="submit" value="Hozzáadás" id="add" name="add" style="width: 20%; justify-content: center">
    </div>


    <h1 style="justify-content: center; text-align: center">Saját szolgáltatásaim</h1>
</form>
    <hr>

    <?php
    $sql = "SELECT * FROM services WHERE id_user = '$_SESSION[id_user]'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo ' <table class="table" style="width: 50%; margin: 2rem auto;">
  <thead>
    <tr>
      <th scope="col" style="width: 40%">Név</th>
      <th scope="col">Ár</th>
      <th scope="col">Időtartam</th>
    </tr>
  </thead>';

    if ($stmt->rowCount() > 0) {
        foreach ($results as $row) {

        $_SESSION["servicename"] = $row["service_name"];

            echo '<table class="table"  style="width: 50%; margin: 2rem auto;">
  <tbody>
    <tr>
      <td style="width: 40%; padding: 0; vertical-align: center;">' . $row["service_name"] . '</td>
      <td style="width: 20%; padding: 0; vertical-align: center;">' . $row["price"] . " .Ft" . '</td>
      <td style="width: 20%; padding: 0; vertical-align: center;">' . $row["duration"] . " perc" . '</td>
      <td><form action="delete_service.php?service='.$row["id_service"].'" method="post"><input type="submit" style="width: 100%; background-color: #ff0000; border: 0; border-radius: 5px; padding: 8px" value="Törlés" name="delete"></form></td>
    </tr>
  </tbody>
</table>';
        }
    }
    ?>
<?php
if (isset($_GET["ok"]) and $_GET["ok"] == 2)
{
    echo "<div class='ok1' style='width: 50%; margin: 1rem auto;'><a>Törölve!</a></div>";
}
?>
</div>
</body>
</html>
<?php
include "includes/footer.php";
?>

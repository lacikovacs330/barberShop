<?php
include 'includes/nav.php';
$conn = connectDatabase($dsn, $pdoOptions);

$id_salon = $_POST["id_salon"];
$id_hour = $_POST["id_hour"];
$day = $_POST["day"];
$from_hour = $_POST["from_hour"];
$to_hour = $_POST["to_hour"];

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
<div class="register-system">
    <div class="login-title">
        <a><b>Foglalás megváltoztatása</b></a>
    </div><br>
    <hr class="register-hr">
    <div class="register-inputs">
        <?php echo '<form action="modify_time2.php?id_hour=' . $id_hour . '&day=' . $day . '&from_hour='.$from_hour.'&to_hour='.$to_hour.'&salon_id='.$id_salon.'" method="post">' ?>

        <label>Dátum</label>
        <input type="date" id="date" name="date" placeholder="Dátum..." style="width: 100%; text-align: center" format="YYYY-MM-DD">

        <label>Mettől</label><br>
        <input type="time" id="time4" name="time4" placeholder="Időpont..." style="width: 100%; text-align: center"><br><br>

        <label>Meddig</label><br>
        <input type="time" id="time5" name="time5" placeholder="Időpont..." style="width: 100%; text-align: center"><br><br>

        <input type="submit" value="Megváltoztatás" name="sub100" id="sub100">
        </form>
    </div>
</div>
</body>
</html>


<?php
include 'includes/footer.php';
?>


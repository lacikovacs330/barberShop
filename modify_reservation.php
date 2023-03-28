<?php
include 'includes/nav.php';
$conn = connectDatabase($dsn, $pdoOptions);

$reservation = $_POST["id_reservation"];
$salon = $_POST["id"];
$duration = $_POST["duration"];
$price = $_POST["price"];
$service_name = $_POST["service_name"];
$date = $_POST["date"];
$time = $_POST["time"];


$sql = "SELECT * FROM workers WHERE id_salon = '$salon'";
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
<div class="register-system">
    <div class="login-title">
        <a><b>Foglalás megváltoztatása</b></a>
    </div><br>
    <hr class="register-hr">
    <div class="register-inputs">
        <?php echo '<form action="modify_reservation2.php?reservation=' . $reservation . '&salon=' . $salon . '&duration='.$duration.'&price='.$price.'&service_name='.$service_name.'&date='.$date.'&time='.$time.'" method="post">' ?>
        <label>Név</label>
        <input type="text" id="s_name2" name="s_name2" placeholder="Szolgáltatás neve...">

        <label>Ár</label>
        <input type="text" id="price2" name="price2" placeholder="Ár...">

        <label>Dátum</label>
        <input type="date" id="date2" name="date2" placeholder="Dátum..." style="width: 100%; text-align: center">

        <label>Időpont</label><br>
        <input type="time" id="time2" name="time2" placeholder="Időpont..." style="width: 100%; text-align: center"><br><br>

        <label>Időtartam</label>
        <input type="text" id="duration2" name="duration2" placeholder="Időtartam...">

        <input type="submit" value="Megváltoztatás" name="sub" id="sub">
        </form>
    </div>
</div>
</body>
</html>


<?php
include 'includes/footer.php';
?>


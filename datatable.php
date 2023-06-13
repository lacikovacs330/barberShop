<?php
include "includes/config.php";
include "includes/db_config.php";
session_start();

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


$sql8 = "SELECT * FROM users ORDER BY id_user ASC";
$stmt8 = $conn->prepare($sql8);
$stmt8->execute();
$results8 = $stmt8->fetchAll(PDO::FETCH_ASSOC);

$sql2 = "SELECT * FROM salons ORDER BY id_salon ASC";
$stmt2 = $conn->prepare($sql2);
$stmt2->execute();
$results2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);

$sql9 = "SELECT * FROM logs";
$stmt9 = $conn->prepare($sql9);
$stmt9->execute();
$results9 = $stmt9->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html>
<head>
    <title>DataTable</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
</head>
<body>
<div class="nav" style="width: 100%; height: 80px; background-color:#808080; display: flex;">
    <div class="hrefs1" style="width: 50%; height: 40px; justify-content: center; text-align: left; margin-top: 25px; margin-left: 15px">
        <a href="index.php" style="color: #000000; cursor:pointer;">Vissza</a>
    </div>
    <div class="title1" style="width: 50%; height: 40px; justify-content: center; text-align: center;">
        <h1>Admin felület</h1>
    </div>
</div>
<br /><br />
<div class="container">
    <h3 align="center">Felhasználók</h3>
    <br />
    <div class="table-responsive">
        <table id="employee_data" class="table table-striped table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Status</th>
                <th>Role</th>
                <th>Action</th>
            </tr>
            </thead>
            <?php
            if ($stmt8->rowCount() > 0) {
                foreach ($results8 as $row8) {
                    echo '<tr>';
                    echo '<td>' . $row8["id_user"] . '</td>';
                    echo '<td>' . $row8["username"] . '</td>';
                    echo '<td>' . $row8["email"] . '</td>';
                    echo '<td>' . $row8["status"] . '</td>';
                    echo '<td>' . $row8["role"] . '</td>';
                    echo '<td>';
                    if ($row8["status"] == 0) {
                        echo '<a href="edit_user.php?id=' . $row8["id_user"] . '&status=1">Visszaállítás</a>';
                    } else {
                        echo '<a href="edit_user.php?id=' . $row8["id_user"] . '&status=0">Bannolás</a>';
                    }
                    echo '</td>';
                    echo '</tr>';
                }
            }
            ?>
        </table>
    </div>
</div>


<div class="container">
    <h3 align="center">Szalonok</h3>
    <br />
    <div class="table-responsive">
        <table id="employee_data1" class="table table-striped table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Név</th>
                <th>Leirás</th>
                <th>Status</th>
                <th>Ban</th>
                <th>Action</th>
            </tr>
            </thead>
            <?php
            if ($stmt2->rowCount() > 0) {
                foreach ($results2 as $row2) {
                    echo '<tr>';
                    echo '<td>' . $row2["id_salon"] . '</td>';
                    echo '<td>' . $row2["name"] . '</td>';
                    echo '<td>' . $row2["description"] . '</td>';
                    echo '<td>' . $row2["status"] . '</td>';
                    echo '<td>' . $row2["ban"] . '</td>';
                    echo '<td>';
                    if ($row2["ban"] == 0) {
                        echo '<a href="edit_salon.php?id=' . $row2["id_user"] . '&ban=1">Bannolás</a>';
                    } else {
                        echo '<a href="edit_salon.php?id=' . $row2["id_user"] . '&ban=0">Visszaállitás</a>';
                    }
                    echo '</td>';
                    echo '</tr>';
                }
            }
            ?>
        </table>
    </div>
</div>

<div class="container">
    <h3 align="center">Mobile Detect</h3>
    <br />
    <div class="table-responsive">
        <table id="employee_data2" class="table table-striped table-bordered">
            <thead>
            <tr>
		    <th>ID</th>
                <th>ID_USER</th>
                <th>Device Type</th>
                <th>HTTP ACCEPT</th>
                <th>HTTP_USER_AGENT</th>
                <th>IP ADDRESS</th>
		    <th>Country Code</th>
		    <th>Date</th>	
            </tr>
            </thead>
            <?php
            if ($stmt9->rowCount() > 0) {
                foreach ($results9 as $row9) {
                    echo '<tr>';
		        echo '<td>' . $row9["id"] . '</td>';		
                    echo '<td>' . $row9["id_user"] . '</td>';
                    echo '<td>' . $row9["device_type"] . '</td>';
                    echo '<td>' . $row9["http_accept"] . '</td>';
                    echo '<td>' . $row9["http_user_agent"] . '</td>';
                    echo '<td>' . $row9["ip_address"] . '</td>';
			  echo '<td>' . $row9["country_code"] . '</td>';
                    echo '<td>' . $row9["date"] . '</td>';
                    echo '</tr>';
                }
            }
            ?>
        </table>
    </div>
</div>




</body>
</html>
<script>
    $(document).ready(function(){
        $('#employee_data').DataTable();
    });

    $(document).ready(function(){
        $('#employee_data1').DataTable();
    });

     $(document).ready(function(){
        $('#employee_data2').DataTable();
    });
</script>

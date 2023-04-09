<?php
include "includes/functions.php";
$conn = connectDatabase($dsn, $pdoOptions);
session_start();

if (isset($_SESSION["id_user"]))
{
    $sql = "SELECT * FROM users WHERE id_user = '$_SESSION[id_user]'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($stmt->rowCount() > 0) {
        foreach ($results as $row) {
            if ($row["role"]!="worker")
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

$sql = "SELECT service_name,id_reservation,date,time,username FROM reservation WHERE id_worker_user ='$_SESSION[id_user]'";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll();

$events = array();
foreach($result as $row) {
    $event = array();
    $event['id'] = $row['id_reservation'];
    $event['title'] = $row['service_name']. " - " . $row['time'] . " - " . $row["username"];
    $event['start'] = $row['date'];
    $event['time'] = $row['time'];
    $events[] = $event;

}
$json_events = json_encode($events);

?>

<head>
    <link href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css' rel='stylesheet' />
    <script src='https://code.jquery.com/jquery-3.3.1.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js'></script>
    <link href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css' rel='stylesheet' />
    <link href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar-scrollbar/1.0.7/fullcalendar-scrollbar.min.css' rel='stylesheet' />
    <script src='https://code.jquery.com/jquery-3.3.1.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar-scrollbar/1.0.7/fullcalendar-scrollbar.min.js'></script>
</head>
<body>
<a href="index.php">Kezdőoldal</a>
<div id='calendar'>

</div>
</body>
<script>
    $(document).ready(function() {
        $('#calendar').fullCalendar({
            events: <?php echo json_encode($events); ?>,
            scrollTime: '08:00:00', //
            plugins: ['scrollTime', 'scrollbar']
        });
    });
</script>
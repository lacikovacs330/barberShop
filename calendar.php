<head>
    <link href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css' rel='stylesheet' />
    <script src='https://code.jquery.com/jquery-3.3.1.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js'></script>
</head>

<div id='calendar'></div>

<script>
    $(document).ready(function() {
        $('#calendar').fullCalendar({
            events: 'calendar.php'
        });
    });
</script>
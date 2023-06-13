<?php
require "includes/config.php";
require "includes/db_config.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$conn = connectDatabase($dsn, $pdoOptions);

$realtime = date("H:i:s", strtotime(" + 2 hour"));
$realdate = date("Y-m-d");
echo $realdate;
echo $realtime;

$stmt = $conn->prepare("Select * from reservation");
$stmt->execute();
$rows = $stmt->fetchAll();

if ($stmt->rowCount() > 0) {
    foreach($rows as $row) {
        $email = $row["email"];
        $date = $row["date"];
        $time = $row["time"];

        require 'vendor/autoload.php';
        $mail = new PHPMailer(true);

        $realdate1 = strtotime($realdate);
        $date1 = strtotime($date);

        $time1 = strtotime($time);
        $time1 = $time1 - (30 * 60);
        $date2 = date("H:i:s", $time1);

        $newDate = date('H:i:s', strtotime($date2. ' +1 minutes'));

        if ($newDate >= $realtime and $date2 <= $realtime and $date1 == $realdate1){
		 try {
                //Server settings
                $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = 'mail.misura.stud.vts.su.ac.rs';                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = 'misura';                     //SMTP username
                $mail->Password   = 'CsSClJ8k4cDYlIr';                               //SMTP password
                $mail->SMTPSecure = 'tls';
                $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`


                //Recipients
                $mail->setFrom('misura@misura.stud.vts.su.ac.rs', 'Misura');
                $mail->addAddress($email, 'User');     //Add a recipient

                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = "Reminder";
                $mail->Body    = "A foglalásod 30 perc múlva lejár!";

                $mail->send();
                echo 'Message has been sent';
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        }
    }
}

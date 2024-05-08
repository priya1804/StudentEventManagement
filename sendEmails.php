<?php
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;

function sendMailForEventReg($studentsEmailArray, $eventId){

    // Create a new PHPMailer instance
    $mail = new PHPMailer();

    // Set mailer to use SMTP
    $mail->isSMTP();
    
    // SMTP configuration
    $mail->Host = 'smtp.gmail.com'; // Specify main and backup SMTP servers
    $mail->SMTPAuth = true; // Enable SMTP authentication
    $mail->Username = 'studenteventmanagement2024@gmail.com'; // SMTP username
    $mail->Password = 'nkxiwqiklyebwdgk'; // SMTP password
    $mail->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587; // TCP port to connect to
    
    // Sender information
    $mail->setFrom('studenteventmanagement2024@gmail.com', 'Priya Shukla');
    foreach($studentsEmailArray AS $studentEmail){
        $mail->addAddress($studentEmail);

        // Email subject and body
        $mail->Subject = 'A new event has been scheduled. Register fast!!!';
        $mail->Body = 'A new event has been scheduled by organizer name go and register for it soon:
            <a href= "http://localhost/StudentEventManagement/student/registerforevent.php?event_id='.$eventId.'&email='.$studentEmail.'"> </a>';
        
        if (!$mail->send()) {
           continue;
        } else {
            echo 'Email sent successfully to all recipients';
        }
    }
    
}

?>
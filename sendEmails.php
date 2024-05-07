<?php
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;

function sendMailForEventReg($studentsEmailArray){

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
    $mail->setFrom('priyashukla18@gmail.com', 'Priya Shukla');
    
    // Load recipient data (e.g., from a database)
    $recipients = ['priyashukla@gmail.com'];
    
    // Concatenate recipient email addresses and add to the "To" field
    $toAddresses = implode(', ', $recipients);
    $mail->addAddress($toAddresses);
    
    // Email subject and body
    $mail->Subject = 'A new event has been scheduled. Register fast!!!';
    $mail->Body = 'A new event has been scheduled by organizer name details are below: <br><br>
    Date: <br>
    Venue: <br>
    Time: <br> <br>
    Request you to kindly provide your input if you are going to attend above event by giving input on link.
    <br><br>
    Thanks & Regards,
    <br>
    Marwadi University';
    
    // Send email
    if (!$mail->send()) {
        echo 'Sending email for errors: ' . $mail->ErrorInfo;
    } else {
        echo 'Email sent successfully to all recipients';
    }
}

?>
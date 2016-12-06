<?php

require 'vendor/autoload.php';
//Create a new PHPMailer instance
$mail = new PHPMailer();
//Tell PHPMailer to use SMTP
$mail->isSMTP();
$mail->SMTPDebug = 2;

$mail->Debugoutput = 'html';
//Set the hostname of the mail server
$mail->Host = 'smtp.gmail.com';
// use
// $mail->Host = gethostbyname('smtp.gmail.com');
// if your network does not support SMTP over IPv6
//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = 587;
//Set the encryption system to use - ssl (deprecated) or tls
$mail->SMTPSecure = 'tls';
//Whether to use SMTP authentication
$mail->SMTPAuth = true;
//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = "coders.lab.ldz@gmail.com";
//Password to use for SMTP authentication
$mail->Password = "coderslab";
//Set who the message is to be sent from
$mail->setFrom('coders.lab.ldz@gmail.com', 'Coder');
//Set an alternative reply-to address
$mail->addReplyTo('coders.lab.ldz@gmail.com', 'Coder');
//Set who the message is to be sent to
$mail->addAddress('orlowski@ifelse.pl', 'Orlowski');
//Set the subject line
$mail->Subject = 'PHPMailer GMail SMTP test';


$mail->Body = "Some sample text";

//send the message, check for errors
if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message sent!";
}